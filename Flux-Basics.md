# Flux Help Sheet

<!-- TOC -->

*   [Flux Help Sheet](#flux-help-sheet)
    *   [FLUX-1: What is Flux?](#flux-1-what-is-flux)
    *   [FLUX-2: The Dispatcher](#flux-2-the-dispatcher)
    *   [FLUX-3: Stores](#flux-3-stores)
    *   [FLUX-4: Action Creators & Actions](#flux-4-action-creators--actions)
    *   [FLUX-5: Putting it together](#flux-5-putting-it-together)

<!-- /TOC -->

**Sources**

What is Flux? from [Scotch.io](https://scotch.io/tutorials/getting-to-know-flux-the-react-js-architecture)

Declaring Singletons in ES6 from [Medium](https://medium.com/@softwarecf/flux-stores-and-es6-9b453dbf9db#.4yo043nti)

## FLUX-1: What is Flux?

Flux is an architecture that Facebook uses internally when working with React. It is not a framework or a library. It is simply a new kind of architecture that complements React and the concept of Unidirectional Data Flow.

That said, Facebook does provide a repo that includes a Dispatcher library. The dispatcher is a sort of global pub/sub handler that broadcasts payloads to registered callbacks.

**4 Components**

**1. Actions** – Helper methods that facilitate passing data to the Dispatcher
**2. Dispatcher** – Receives actions and broadcasts payloads to registered callbacks
**3. Stores** – Containers for application state & logic that have callbacks registered to the dispatcher
**4. Controller Views** – React Components that grab the state from Stores and pass it down via props to child components

Flux helps to solve some of the difficulty we run into with unidirectional data flow when it comes to changing Application State that is higher up the virtual DOM than the Components that alter that State themselves.

Controllers do exist in a Flux application, but they are controller-views.

Action creators — dispatcher helper methods — are used to support a semantic API that describes all changes that are possible in the application. It can be useful to think of them as a fourth part of the Flux update cycle.

**The graphical process**

<img src="https://cask.scotch.io/2014/10/V70cSEC.png" />

**How does the API relate to this?**

When you are working with data that is coming from (or going to) the outside, I’ve found that using Actions to introduce the data into the Flux Flow, and subsequently Stores, is the most painless way to go about it.

---

## FLUX-2: The Dispatcher

**What is it?**

The Dispatcher is basically the manager of this entire process. It is the central hub for your application. The dispatcher receives actions and dispatches the actions and data to registered callbacks.

The dispatcher broadcasts the payload to ALL of its registered callbacks, and includes functionality that allows you to invoke the callbacks in a specific order, even waiting for updates before proceeding. There is only ever one dispatcher, and it acts as the central hub within your application. It is not exactly a pub/sub.

**Example Dispatcher**

```javascript
var Dispatcher = require('flux').Dispatcher;
var AppDispatcher = new Dispatcher();

AppDispatcher.handleViewAction = function(action) {
    this.dispatch({
        source: 'VIEW_ACTION',
        action: action
    });
};

module.exports = AppDispatcher;
```

In the above example, we create an instance of our Dispatcher and create a `handleViewAction` method. This abstraction is helpful if you are looking to distinguish between view triggered actions v.s. server/API triggered actions.

Our method calls the dispatch method, which will broadcast the `action` payload to all of its registered callbacks. This action can then be acted upon within Stores, and will result in a state update.

The diagram below illustrates this process:

<img src="https://cask.scotch.io/2014/10/hKbN2q6.png" />

**Dependencies**

One of the coolest parts of the provided Dispatcher module is the ability to define dependencies and marshall the callbacks on our Stores. So if one part of your application is dependent upon another part being updated first, in order to render properly, the Dispatcher’s `waitFor` method will be mighty useful.

In order to utilize this feature, we need to store the return value of the Dispatcher’s registration method on our Store as `dispatcherIndex`, as shown below:

```javascript
ShoeStore.dispatcherIndex = AppDispatcher.register(function(payload) {});
```

Then in our Store, when handling a dispatched action, we can use the Dispatcher’s `waitFor` method to ensure our ShoeStore has been updated:

```javascript
case 'BUY_SHOES':
  AppDispatcher.waitFor([
    ShoeStore.dispatcherIndex
  ], function() {
    CheckoutStore.purchaseShoes(ShoeStore.getSelectedShoes());
  });
  break;
```

## FLUX-3: Stores

In Flux, Stores manage application state for a particular domain within your application. From a high level, this basically means that per app section, stores manage the data, data retrieval methods and dispatcher callbacks.

Lets take a look at a basic Store:

```javascript
var AppDispatcher = require('../dispatcher/AppDispatcher');
var ShoeConstants = require('../constants/ShoeConstants');
var EventEmitter = require('events').EventEmitter;
var merge = require('react/lib/merge');

// Internal object of shoes
var _shoes = {};

// Method to load shoes from action data
function loadShoes(data) {
    _shoes = data.shoes;
}

// Merge our store with Node's Event Emitter
var ShoeStore = merge(EventEmitter.prototype, {
    // Returns all shoes
    getShoes: function() {
        return _shoes;
    },

    emitChange: function() {
        this.emit('change');
    },

    addChangeListener: function(callback) {
        this.on('change', callback);
    },

    removeChangeListener: function(callback) {
        this.removeListener('change', callback);
    }
});

// Register dispatcher callback
AppDispatcher.register(function(payload) {
    var action = payload.action;
    var text;
    // Define what to do for certain actions
    switch (action.actionType) {
        case ShoeConstants.LOAD_SHOES:
            // Call internal method based upon dispatched action
            loadShoes(action.data);
            break;

        default:
            return true;
    }

    // If action was acted upon, emit change event
    ShoeStore.emitChange();

    return true;
});

module.exports = ShoeStore;
```

**The most important thing from above** is extending our store with NodeJS's EventEmitter.

This allows our stores to listen/broadcast events. This allows our Views/Components to update based upon those events. Because our Controller View listens to our Stores, leveraging this to emit change events will let our Controller View know that our application state has changed and its time to retrieve the state to keep things fresh.

This is what ES6 notation looks like. We instead can extend EventEmitter.

```javascript
import EventEmitter from 'events';

var CHANGE_EVENT = 'change';

class Store extends EventEmitter {
    constructor() {
        super();
    }

    emitChange() {
        this.emit(CHANGE_EVENT);
    }

    addChangeListener(callback) {
        this.on(CHANGE_EVENT, callback);
    }

    removeChangeListener(callback) {
        this.removeListener(CHANGE_EVENT, callback);
    }
}

Store.dispatchToken = null;

export default Store;
```

We also registered a callback with our AppDispatcher using its register method. This means that our Store is now listening to AppDispatcher broadcasts. Our switch statement determines whether, for a given broadcast, if there are any relevant actions to take. If a relevant action is taken, a change event is emitted, and views that are listening for this event update their states.

<img src="https://cask.scotch.io/2014/10/rHwGUog.png" />

Our public method getShoes is used by our Controller View to retrieve all of the shoes in our \_shoes object and use that data in our components state. While this is a simple example, complicated logic can be put here instead of our views and helps keep things tidy.

---

## FLUX-4: Action Creators & Actions

Action Creators are collections of methods that are called within views (or anywhere else for that matter) to send actions to the Dispatcher. **Actions are the actual payloads** that are delivered via the dispatcher.

The way Facebook uses them, action type constants are used to define what action should take place, and are sent along with action data. Inside of registered callbacks, these actions can now be handled according to their action type, and methods can be called with action data as the arguments.

Lets check out a constants definition:

```javascript
// ES5

var keyMirror = require('react/lib/keyMirror');

module.exports = keyMirror({
  LOAD_SHOES: null
});

// ES6

import keyMirror from 'react';

export keyMirror({
		LOAD_SHOES: null
	});
```

Above we use React’s `keyMirror` library to mirror our keys so that our value matches our key definition.

Just by looking at this file, we can tell that our app loads shoes. The use of constants helps keep things organized, and helps give a high level view of what the app actually does.

Now lets take a look at the corresponding Action Creator definition:

```javascript
// ES 5

var AppDispatcher = require('../dispatcher/AppDispatcher');
var ShoeStoreConstants = require('../constants/ShoeStoreConstants');

var ShoeStoreActions = {

  loadShoes: function(data) {
    AppDispatcher.handleAction({
      actionType: ShoeStoreConstants.LOAD_SHOES,
      data: data
    })
  }

};

module.exports = ShoeStoreActions;

// ES6

import AppDispatcher from '../dispatcher/AppDispatcher';
import ShoeStoreConstants from '../constants/ShoeStoreConstants';

class ShoeStoreActions {
	public function loadShoes(data) {
		AppDispatcher.handleAction({
	      actionType: ShoeStoreConstants.LOAD_SHOES,
	      data: data
	    });

		return;
	}
}
```

In our example above, we created a method on our `ShoeStoreActions` object that calls our dispatcher with the data we provided. We can now import this actions file into our view or API, and call `ShoeStoreActions.loadShoes(ourData)` to send our payload to the Dispatcher, which will broadcast it. Then the ShoeStore will “hear” that event and call a method thats loads up some shoes!

<img src="https://cask.scotch.io/2014/10/4tBnC0e.png" />

```javascript
/** @jsx React.DOM */

var React = require('react');
var ShoesStore = require('../stores/ShoeStore');

// Method to retrieve application state from store
function getAppState() {
    return {
        shoes: ShoeStore.getShoes()
    };
}

// Create our component class
var ShoeStoreApp = React.createClass({
    // Use getAppState method to set initial state
    getInitialState: function() {
        return getAppState();
    },

    // Listen for changes
    componentDidMount: function() {
        ShoeStore.addChangeListener(this._onChange);
    },

    // Unbind change listener
    componentWillUnmount: function() {
        ShoesStore.removeChangeListener(this._onChange);
    },

    render: function() {
        return <ShoeStore shoes={this.state.shoes} />;
    },

    // Update view state when change event is received
    _onChange: function() {
        this.setState(getAppState());
    }
});

module.exports = ShoeStoreApp;
```

In the example above, we listen for change events using addChangeListener, and update our application state when the event is received.

Our application state data is held in our Stores, so we use the public methods on the Stores to retrieve that data and then set our application state.

---

## FLUX-5: Putting it together

Now that we have gone through each individual part of the Flux architecture, we should have a much better idea of how this architecture actually works. Remember our graphical representation of this process from before? Lets have a look at a bit more granular view of this, now that we understand the function of each part of the flow.

<img src="https://cask.scotch.io/2014/10/duZH2Sz.png" />
