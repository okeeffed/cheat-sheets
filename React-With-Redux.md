# React with Redux

<!-- TOC -->

*   [React with Redux](#react-with-redux)
    *   [REDUX-0: Crash Course](#redux-0-crash-course)
    *   [REDUX-1: Modelling Application State](#redux-1-modelling-application-state)
    *   [REDUX-2: Reducers](#redux-2-reducers) - [---- REDUX-2.1: What is a Reducer?](#-----redux-21-what-is-a-reducer) - [---- REDUX-2.2: Containers - Connecting Redux to React](#-----redux-22-containers---connecting-redux-to-react) - [---- REDUX-2.3: Implementation of a container class](#-----redux-23-implementation-of-a-container-class)
    *   [REDUX-3: Actions and Action Containers](#redux-3-actions-and-action-containers) - [---- REDUX-3.1: Binding Action Creators](#-----redux-31-binding-action-creators) - [---- REDUX-3.2: Creating an Action](#-----redux-32-creating-an-action) - [---- REDUX-3.3: Consuming Actions in Reducers](#-----redux-33-consuming-actions-in-reducers) - [---- REDUX-3.4: Conditional Rendering](#-----redux-34-conditional-rendering) - [---- REDUX-3.5: Redux intro review](#-----redux-35-redux-intro-review)

<!-- /TOC -->

## REDUX-0: Crash Course

**Key Imports**

```javascript
// used to extend the react Component class
import React, { Component } from 'react';

// used to connect the container/component class, mapStateToProps and
// the mapDispatchToProps functions
import { connect } from 'react-redux';

// used to pass the result to all the reducers
import { bindActionCreators } from 'redux';

// used to import the combineReducers function in reducers/index.js
import { combineReducers } from 'redux';
```

---

**The flow of how the Application Reacts in Redux**

<img src="https://d1din05d4116wx.cloudfront.net/react-with-redux/react-diagram-1.png" />

1.  An interaction calls the `Action Creator`
2.  The `Action Creator` returns an `Action` that is a plain JS Object
3.  The `Action` is automatically sent to all Reducers (through the combineReducers function)
4.  If the property contains a case for that `Action`, the relevant property on `State` set to the value returned by from the `Reducer`
5.  All `Reducers` process the `Action` and return the new `State`. The new `State` has been assembled. The `Containers` are notified of any changes to `State`. On notification, `Containers` will re-render with new props.

---

**src folders**

_actions_

Contains `index.js` which is about exporting functions that are used to update the state.

**_Example: actions/index.js_**

```javascript
export function selectBook(book) {
    return {
        type: 'BOOK_SELECTED',
        payload: book
    };
}
```

_components_

Contains all the "children" components that do not deal with `Application State`.

Also contains the main `app.js` file that renders the `containers` and `components`.

**_Example: components/app.js_**

```javascript
import React, { Component } from 'react';

import BookList from '../containers/book-list';
import BookDetail from '../containers/book-detail';

export default class App extends Component {
    render() {
        return (
            <div>
                <BookList />
                <BookDetail />
            </div>
        );
    }
}
```

_containers_

These are the "parent" components that are most significant to changing `Application State`.

In this example, we return a view that shows all the book titles and has an onClick action associated with it.

**_Example: containers/book-list.js_**

```javascript
import React, { Component } from 'react';
import { connect } from 'react-redux';

// let's import the action creator
import { selectBook } from '../actions/index';
import { bindActionCreators } from 'redux';

class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            return (
                <li
                    key={book.title}
                    onClick={() => this.props.selectBook(book)}
                    className="list-group-item"
                >
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}

function mapStateToProps(state) {
    // What is returned will show up as props
    // inside of BookList
    return {
        books: state.books
    };
}

// define our dispatch to props
// anything returned from this function will end up as props
// on the BookList container
function mapDispatchToProps(dispatch) {
    // Whenever selectBook is called, the result should be passed
    // to all of our reducers
    return bindActionCreators({ selectBook: selectBook }, dispatch);
}

// add the dispatch as the second argument!
// Promote bookList from component to container, so it needs to know
// about this new dispatch method, selectBook. Make it available
// as a prop
export default connect(mapStateToProps, mapDispatchToProps)(BookList);
```

_reducers_

Deal with the data and how the state is handled.

Contains index.js that combines all the reducers and the other reducer files.

**_Example: reducers/index.js_**

```javascript
import { combineReducers } from 'redux';
import BooksReducer from './reducer_books.js';
import ActiveBook from './reducer_active_book.js';

const rootReducer = combineReducers({
    books: BooksReducer,
    activeBook: ActiveBook
});

export default rootReducer;
```

**_Example: reducers/reducer_active_books.js_**

```javascript
export default function(state = null, action) {
    switch (action.type) {
        case 'BOOK_SELECTED':
            return action.payload;
    }

    return state;
}
```

## REDUX-1: Modelling Application State

Inherently difficult in terms of the concept.

Redux is just the start of a bunch of different technologies. You need to understand the core concepts of it.

**What is Redux?**

Consider the structure of an application on the view layer and the data layer.

Where does Redux come into this? Redux is like the data, while React is the views. A state container is essentially the data.

This doesn't look too different to the others, but here we put all the data into a single collection. This is different to other Frameworks. Redux centralises all the data in the "state". Redux state is Application state as opposed to Component state.

Think of a +/- button state that displays the current count.

If we think about this, the data contained is the current count, while the views are the current count value and the +/- buttons.

Redux is going to keep track of the counter. It tells the components how and what they should render.

**Modelling an App**

Designing the state is the critical part of Redux.

Let's model Tinder!

In data, we need to model a few things.

1.  The swiping screen. The list of the users not reviewed, and the view of the current user.
2.  The conversation screen. List of all current convos.
3.  The actual conversation screen itself.
4.  List of all the users in general.

Controller Views

1.  Image Card
2.  Like/Dislike buttons
3.  ConversationList
4.  TextItem (individual message)
5.  TextList (list of chat messages)

## REDUX-2: Reducers

`npm start` from the ReduxSimpleStarter

#### ---- REDUX-2.1: What is a Reducer?

A function that returns the state.

One reducer would be responsible for each function that returns an Application State.

For example, if we're looking at a list of books where one is currently selected, we are then looking to have two reducers.

The important thing is the value of the state.

Key of state, value of state. That's the pairing.

```
{
	// Books Reducer
	books: [
		{
			title: 'Harry Potter'
		},
		{
			title: 'JavaScript'
		}
	],

	// ActiveBook Reducer
	activeBook: {
		title: 'JavaScript: The Good Parts'
	}
}
```

We want a function to produce these types of states.

**In src/reducers/**, we'll create a reducer file "reducer_books.js"

```javascript
export default function() {
    return [
        { title: 'Book 1' },
        { title: 'Book 2' },
        { title: 'Book 3' },
        { title: 'Book 4' }
    ];
}
```

Step 1 - Create the reducer is now done. Now, Step 2 - we want to re-wire the reducer.

**reducers/index.js**

```javascript
import { combineReducers } from 'redux';

//import in the file
import BooksReducer from './reducer_books.js';

const rootReducer = combineReducers({
    // wire BooksReducer to books
    books: BooksReducer
});

export default rootReducer;
```

#### ---- REDUX-2.2: Containers - Connecting Redux to React

**In components/book-list.js**

```javascript
import React, { Component } from 'react';

export default class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            return (
                <li key={book.title} className="list-group-item">
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}
```

Combining React and Redux is done with a library called react-redux

To make use of that library, we define one of our components as a **container**.

To separate components and containers, we create a container directory.

Cut and move the file into the containers folder!

**Now in containers/book-list.js**

```javascript
import React, { Component } from 'react';

export default class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            return (
                <li key={book.title} className="list-group-item">
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}
```

How do we decide what becomes a container and what stays as a component? It varies. The most parent component that cares about a particular state should become a container.

The app component should be a "dumb component".

**Remember: Only the most parent component should become the container**

#### ---- REDUX-2.3: Implementation of a container class

**in app.js**

```javascript
import React, { Component } from 'react';

import BookList from '../containers/book-list';

export default class App extends Component {
    render() {
        return (
            <div>
                <BookList />
            </div>
        );
    }
}
```

Back in containers/book-list, ensure that you have imported react-redux.

The function mapStateToProps(state) {} will use the function map the state to the props.

The connect function is what will be used to connect all of this.

`connect(arg)(state)`

```javascript
import React, { Component } from 'react';

// importing connect
import { connect } from 'react-redux';

class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            return (
                <li key={book.title} className="list-group-item">
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}

// mapping the state to props
function mapStateToProps(state) {
    // What is returned will show up as props
    // inside of BookList
    return {
        books: state.books
    };
}

export default connect(mapStateToProps)(BookList);
```

Whenever the app state changes, our container will automatically re-render. The object in the state function will assigned as the prop.

**Containers and Reducers Review**

1.  We promoted a component to a container
2.  Redux serves to produce the state, React shows the state
3.  App state is produced by reducer functions

---

## REDUX-3: Actions and Action Containers

Currently, the books reducer ALWAYS brings back the same books. We don't want this. We want an "active" book.

Actions and Action Creators solve this.

Example: A user clicks on the Book List at Book #2

The event starts with an "action" eg. AJAX, clicks, hovers etc. This creates the action creator.

1.  The click calls the action creator

The function will return an object.

```javascript
function(
	return {
		type: BOOK_SELECTED
		// the book here is the payload
		book: { title: 'Book 2' }
	}
)
```

2.  Action creator returns an action

```javascript
{
    type: BOOK_SELECTED;
    book: {
        title: 'Book 2';
    }
}
```

3.  Action automatically send to all reducers

This is sent to all of our reducers.

Reducers don't have to react, so it just returns the currentState and there are no changes.

```javascript
// in the ActionBook Reducer

switch (action.type) {
	case BOOK_SELECTED
		return actionBook
	default
		// do nothing
		return currentState
}
```

4.  activeBook property on the state set to the value returned fom the active book reducer

```javascript
{
    activeBook: {
        title: 'JS ';
    }
    books: [
        {
            title: 'dark'
        },
        {
            title: 'JS'
        }
    ];
}
```

5.  All reducers processed the action and returned new state. New state has been assembled. Notify containers of the changes to state. On notification, containers will re-render with new props.

#### ---- REDUX-3.1: Binding Action Creators

**In actions/index.js**

*   Export the function to make use of the action creator in other parts of the function.

```javascript
export function selectBook(book) {
    console.log('A book has been selected: ', book.title);
}
```

**In containers/book-list.js**

We are going to bind this action to the component.

We call the function mapDispatchToProps with the return bindActionCreators() to say that we know we're going to call this at some stage and we want the result to flow through the `dispatch` function which will pass it to all of our Reducers.

```javascript
import React, { Component } from 'react';
import { connect } from 'react-redux';

// let's import the action creator
import { selectBook } from '../actions/index';
import { bindActionCreators } from 'redux';

class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            return (
                <li key={book.title} className="list-group-item">
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}

function mapStateToProps(state) {
    // What is returned will show up as props
    // inside of BookList
    return {
        books: state.books
    };
}

// define our dispatch to props
// anything returned from this function will end up as props
// on the BookList container
function mapDispatchToProps(dispatch) {
    // Whenever selectBook is called, the result should be passed
    // to all of our reducers
    return bindActionCreators({ selectBook: selectBook }, dispatch);
}

// add the dispatch as the second argument!
// Promote bookList from component to container, so it needs to know
// about this new dispatch method, selectBook. Make it available
// as a prop
export default connect(mapStateToProps, mapDispatchToProps)(BookList);
```

#### ---- REDUX-3.2: Creating an Action

**In containers/book-list.js**

Whenever a user clicks on a line item for a particular book, we want an action.

If we add a click handler, we can create this.

Use the console log to see the results from this!

```javascript
import React, { Component } from 'react';
import { connect } from 'react-redux';

// let's import the action creator
import { selectBook } from '../actions/index';
import { bindActionCreators } from 'redux';

class BookList extends Component {
    renderList() {
        return this.props.books.map((book) => {
            // ACTION - add in the onClick function
            return (
                <li
                    key={book.title}
                    onClick={() => this.props.selectBook(book)}
                    className="list-group-item"
                >
                    {book.title}
                </li>
            );
        });
    }

    render() {
        return <ul className="list-group col-sm-4">{this.renderList()}</ul>;
    }
}

function mapStateToProps(state) {
    // What is returned will show up as props
    // inside of BookList
    return {
        books: state.books
    };
}

// define our dispatch to props
// anything returned from this function will end up as props
// on the BookList container
function mapDispatchToProps(dispatch) {
    // Whenever selectBook is called, the result should be passed
    // to all of our reducers
    return bindActionCreators({ selectBook: selectBook }, dispatch);
}

// add the dispatch as the second argument!
// Promote bookList from component to container, so it needs to know
// about this new dispatch method, selectBook. Make it available
// as a prop
export default connect(mapStateToProps, mapDispatchToProps)(BookList);
```

**in actions/index.js**

Change the result from console.log to whatever you want!

```javascript
export function selectBook(book) {
    // selectBook is an action creator! Return an action.
    // this is an object with a property type
    return {
        type: 'BOOK_SELECTED',
        payload: book
    };
}
```

#### ---- REDUX-3.3: Consuming Actions in Reducers

The result of the action container is automatically being sent to our reducers because of the dispatch.

Let's now create a new reducer to show our active book!

For the switch case, you must ALWAYS return a value. Set state = null for if the state is undefined.

**after creating reducers/reducer_active_book.js**

```javascript
// State argument is not application state, just the state
// that this reducer is responsible for
export default function(state = null, action) {
    switch (action.type) {
        case 'BOOK_SELECTED':
            return action.payload;
    }

    return state;
}
```

**in reducers/index.js**

Let's now import the new reducer.

Remember, any key we pass into this comes back as a key to a global state.

```javascript
import { combineReducers } from 'redux';
import BooksReducer from './reducer_books.js';

// new reducer
import ActiveBook from './reducer_active_book';

const rootReducer = combineReducers({
    books: BooksReducer,
    activeBook: ActiveBook
});

export default rootReducer;
```

**Let's see how this now works**

Do we want a component or a container? The app doesn't really care about the active book. So, this book detail view/component should be a container.

**create containers/book-detail.js**

```javascript
import React, { Component } from 'react';

export default class BookDetail extends Component {
    render() {
        return <div>Book Details!</div>;
    }
}
```

**import this into components/app.js**

```javascript
import React, { Component } from 'react';

import BookList from '../containers/book-list';
import BookDetail from '../container/book-detail';

export default class App extends Component {
    render() {
        return (
            <div>
                <BookList />
                <BookDetail />
            </div>
        );
    }
}
```

Now we start connecting everything up!

```javascript
import React, { Component } from 'react';
import { connect } from 'react-redux';

class BookDetail extends Component {
	render() {
		return (
			<div>Book Details!</div>
		);
	}
}

function mapStateToProps(state) {
	return {
		// activeBook from our activeBook pierce of state
		// in reducers/index.js in the combineReducers
		book: state.activeBook;
	};
}

export default connect(mapStateToProps)(BookDetail);
```

#### ---- REDUX-3.4: Conditional Rendering

**in containers/book-detail.js**

```javascript
import React, { Component } from 'react';
import { connect } from 'react-redux';

class BookDetail extends Component {
	render() {
		if (!this.props.book) {
			return <div>Select a book to begin</div>
		}

		return (
			<div>
				<h3>Details for:</h3>
				<div>{this.props.book.titile}</div>
			</div>
		);
	}
}

function mapStateToProps(state) {
	return {
		// activeBook from our activeBook pierce of state
		// in reducers/index.js in the combineReducers
		book: state.activeBook;
	};
}

export default connect(mapStateToProps)(BookDetail);
```

An action comes through, but we don't know what that is yet. So when the app first boots up, it will always currently be `null`.

What we will do, is add an initial check in the BookDetail class. We can run a conditional check with `if (!this.props.book)` Then, we can render an initial view!

The idea is that the application is now malleable enough to start adding things like extra book details etc.

#### ---- REDUX-3.5: Redux intro review

Things to take away:

*   Redux is entirely responsible for the Application State - Component State is still separate from our Application state, so you could still use setState in the components. - Reducers form the application state. Everything gets combined together in the combineReducers function. - Reducers are in charge of changing the Application State over time using actions. All actions flow through all the reducers and they react depending on what has been set for them to react to.

*   Actions and action creators - Action creators are just functions that return an action - An action is just a plain JS object - Must have a type defined. Normally has payload as convention for what it is passing along.
