# Advanced React and Redux

<!-- TOC -->

*   [Advanced React and Redux](#advanced-react-and-redux)
    *   [1. Testing](#1-testing)
        *   [Test Reporting](#test-reporting)
    *   [3. Higher Order Components](#3-higher-order-components)
        *   [Require Auth HOC](#require-auth-hoc)
        *   [Nesting Higher Order Components](#nesting-higher-order-components)
    *   [3. Middlewares](#3-middlewares)
    *   [4. Authentication](#4-authentication)
        *   [Cookies vs Tokens](#cookies-vs-tokens)
        *   [Scalable Architecture](#scalable-architecture)
        *   [Server Setup](#server-setup)
        *   [Express Middleware](#express-middleware)
        *   [Seeing the MongoDB Database](#seeing-the-mongodb-database)
        *   [Authentication Controller](#authentication-controller)
        *   [JWT Overview](#jwt-overview)
        *   [Passport](#passport)
        *   [Using Strategies with Passport](#using-strategies-with-passport)
        *   [Using Postman](#using-postman)
    *   [Client Side (React App)](#client-side-react-app)
        *   [Dealing with CORS errors with a request (CORS in a nutshell)](#dealing-with-cors-errors-with-a-request-cors-in-a-nutshell)
        *   [Local storage on the client and JWT](#local-storage-on-the-client-and-jwt)
        *   [Form vaidation](#form-vaidation)
        *   [Signup Action Creator](#signup-action-creator)
        *   [Checking auth at the start of the application](#checking-auth-at-the-start-of-the-application)
        *   [Making Authenticated API Requests](#making-authenticated-api-requests)

<!-- /TOC -->

## 1. Testing

Jumping into examples are normally more useful as you are learning.

In the `testing` folder you will see a whole bunch of configuration for `test_helper.js`.

### Test Reporting

## 3. Higher Order Components

What are they? Chances are you've already been using them.

`HOC + Component = Component + Additional functionality & Data`

This gives us back an `enchanced/composed` componenet. These are heavily used in library like `React-Redux`.

**Connect and Provider**

```javascript
import { connect } from 'react-redux';

class App extends Component {
	...
}

function mapStateToProps(state) {
	return { posts: state.props };
}

// connect is the HOC that wraps mapStateToProps
export default connect(mapStateToProps)(App);
```

How about the Provider?

```javascript
// in index.js or whatever ReactDOM we're using
ReactDOM.render(
    <Provider store={createStoreWithMiddleware(reducers)}>
        <App />
    </Provider>,
    document.querySelector('.container')
);
```

The `Provider` is a HOC to the `Redux Store`. Whenever the `Redux Store` changing, the `Provider` notices and broadcasts down to any connected component (using the `connect` function).

### Require Auth HOC

How can we use a HOC to help with authentication?

```javascript
import React from 'react';

export default () => {
    return (
        <div>
            Super Special Secret Recipe
            <ul>
                <li class="example">1 Cup Sugar</li>
                <li class="example">1 Cup Salt</li>
                <li class="example">Another piece of stuff</li>
            </ul>
        </div>
    );
};
```

If we pass this basic component to the router, we can wrap the component using a HOC.

You need to create `actions` and `reducers` for the correct Auth action and reducer.

```javascript
// src > actions > index.js
// doesn't include the reducer code
import { CHANGE_AUTH } from './types';

export function authenticate(isLoggedIn) {
    return {
        type: CHANGE_AUTH,
        payload: isLoggedIn
    };
}
```

**Building the Higher Order Component**

```javascript
// src > components > requireAuth.js

import React, { Component } from 'react';

export default function(ComposedComponent) {
    class Authentication extends Component {
        render() {
            return <ComposedComponent {...this.props} />;
        }
    }

    return Authentication;
}
```

_What's going on here?_

In some other location, we want to use this HOC.

eg. another render method

```
import Authentication
import Resources // the component to wrap

const ComposedComponent = Authentication(Resources);

...

render() {
	<ComposedComponent resources={resourceList} />
}

// OR MORE USEFULLY IN THE REACT ROUTER

<Route path="/" component={Authentication(Resources)} />
```

### Nesting Higher Order Components

Building the above component with Redux and the `connect` HOC.

```javascript
// src > components > requireAuth.js

import React, { Component } from 'react';
import { connect } from 'react-redux';

export default function(ComposedComponent) {
    class Authentication extends Component {
        // to get data ahead of time
        // this is part of "Class Level Properties"
        // console.log(this.context) will show nav properties!
        static contextTypes = {
            router: React.PropTypes.object
        };

        render() {
            return <ComposedComponent {...this.props} />;
        }
    }

    function mapStateToProps(state) {
        return { authenticated: state.authenticated };
    }

    return connect(mapStateToProps)(Authentication);
}
```

`static` will create a "Class Level Property" and this gives other instances access to `Authentication.contextTypes`.

## 3. Middlewares

In the React-Redux cycle, the action is sent to the middleware before it forwards that onto the reducers.

Middleware has the opportunity to log, stop, modify or not touch an action.

```javascript
export default function({dispatch}) {
	return next => action => {
		console.log(action);

		next(action);
	}
}

// vanilla es5
export default function({dispatch}) {
	return function(next) {
		return function(action) {
			console.log(action);

			next(action);
		}
	}
}
```

Now with this `async`, we can apply it to the main file where `createStoreWithMiddleware` lives through `applyMiddleware(Example)(createStore)`.

It's important that we just target the actions that we want - send the others on using the `next()` function.

```javascript
export default function({ dispatch }) {
    return (next) => (action) => {
        if (!action.payload || !action.payload.then) {
            return next(action);
        }

        // if there is a promise
        action.payload.then((response) => {
            // knock off and replace response
            const newAction = { ...action, payload: response };
            dispatch(newAction);
        });
    };
}
```

So why do a new dispatch instead of using next? It's to do with the chain that we have. We want to ensure it goes back through the entire chain again. We want the middleware to be oblivious to what is happening.

If we want to add more middleware into the mix, we just add them as further parameters into the `applyMiddleware` function.

## 4. Authentication

Not a lot of great end-to-end tutorials already. Most skip some important steps.

Best React backend? There is no best backend. All they care about is being served JSON.

Work on the relationship of have a `Username/Password` combination and being authenticated by the server. After being authenticated, we want them to be able to make post requests without reidentifying. The server must give the client back something for this part.

In conclusion, we just want `Here is my cookie OR token for a protected resource`.

### Cookies vs Tokens

**Cookies**

*   Automatically included on all requests
*   Unique to each domain
*   Cannot be sent to different domains

Headers - `cookie: {}`
Body - JSON

The point of cookies is to bring `state` to something `stateless`

**Token**

*   Have to manually wire up
*   Can be sent to any domain

Headers - `authorization: jioeajteioa`
Body - JSON

Being able to send this to any domain we wish is a benefit with a token.

### Scalable Architecture

So we've decided to go with tokens, which is also aligned with how the industry is trending.

If we served `index.html` and `bundle.js` from a Content Server, we can make that server work with no auth req'd.

*   Very easy to redistribute

If we had our API server on another server, we would use a token because cookies would not be able to access the domain with the cookie. It also means we could keep a single location for both mobile and web application.

This set up also means that we can had different developers working on different projects.

That way, scaling also makes it easier! If we need to load balance the API servers because we are using more than just one device, then this allows us to also be more effective in scaling out an API.

### Server Setup

Time to start writing some code.

`mkdir server && cd server`

An example `package.json` will look like so

```javascript
{
  "name": "server",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "dev": "nodemon index.js"
  },
  "author": "",
  "license": "ISC",
  "dependencies": {
    "bcrypt-nodejs": "0.0.3",
    "body-parser": "^1.15.0",
    "cors": "^2.7.1",
    "express": "^4.13.4",
    "jwt-simple": "^0.5.0",
    "mongoose": "^4.4.7",
    "morgan": "^1.7.0",
    "nodemon": "^1.9.1",
    "passport": "^0.3.2",
    "passport-jwt": "^2.0.0",
    "passport-local": "^1.0.0"
  }
}
```

Refer to Github to see more info on each of these packages.

Touch `index.js` and that will be the entry point for the server.

```javascript
// Main starting point of the application
const express = require('express');
const http = require('http');
const bodyParser = require('body-parser');
const morgan = require('morgan');
const app = express();
const router = require('./router');
const mongoose = require('mongoose');
const cors = require('cors');

// DB Setup
mongoose.connect('mongodb://localhost:auth/auth');

// App Setup
app.use(morgan('combined'));
app.use(cors());
app.use(bodyParser.json({ type: '*/*' }));
router(app);

// Server Setup
const port = process.env.PORT || 3090;
const server = http.createServer(app);
server.listen(port);
console.log('Server listening on:', port);
```

### Express Middleware

The following lines are part of the middleware:

```javascript
// App Setup
app.use(morgan('combined'));
app.use(cors());
app.use(bodyParser.json({ type: '*/*' }));
router(app);
```

*   Morgan is a logging framework - quite good for giving the type of requests!
*   Cors allows you the server to use Cross Origin.
*   bodyParser will parse incoming requests. At the moment, it's just for JSON but you may need to change this if you are expecting a file etc.

### Seeing the MongoDB Database

Worthwhile downloading `Robomongo` if you are keen to visually see a GUI with MongoDB.

### Authentication Controller

In the server, we can create some controllers eg. `controllers/authentication.js`.

Each controller will be responsible for handling a type of response.

In `router.js`, we can use the functions exported from the controller to create routes that will deal with post routes.

### JWT Overview

There are two phases for the lifecycle.

1.  When signing in

`User ID` + `Secret String` = `JSON Web Token`

In the future, the user can now use this token for future requests.

2.  Authenticated calls after signin

`JSON Web Token` + `Secret String` = `User ID`

If the "secret string" is incorrect, then this will not result in the User ID. Must keep the secret 100% secret!

**Building the JTW**

We can use the library `jtw-simple`. In the `config.js` file at the root of the app, we can hold the application secrets and config. Ensure these files are `.gitigore`'d.

```javascript
const jwt = require('jwt-simple');
const config = require('../config');

function tokenForUser(user) {
    const timestamp = new Date().getTime();
    // convention will have sub for subject, iat for issued at time
    return jwt.encode({ sub: user.id, iat: timestamp }, config.secret);
}
```

### Passport

So once they've signed up, how do we exchange and give them a token? We need to handle the login case. We also need to make sure they're authenticated when they try accessing a protected resource.

For example, if we have a `Posts` or `Comments` controller, we need to check if they've been loggin in and if they have a valid token.

To do it, we can use `passport.js` - it's normally used for cookie based auth but we can use it with JWT tokens. First, install `passport` and `passport-jwt`.

Then, we can build `service/passport.js` file.

```javascript
const passport = require('passport');
const User = require('../models/user');
const config = require('../config');
const JwtStrategy = require('passport-jwt').Strategy;
const ExtractJwt = require('passport-jwt').ExtractJwt;
const LocalStrategy = require('passport-local');

// Create local strategy
const localOptions = { usernameField: 'email' };
const localLogin = new LocalStrategy(localOptions, function(
    email,
    password,
    done
) {
    // Verify this email and password, call done with the user
    // if it is the correct email and password
    // otherwise, call done with false
    User.findOne({ email: email }, function(err, user) {
        if (err) {
            return done(err);
        }
        if (!user) {
            return done(null, false);
        }

        // compare passwords - is `password` equal to user.password?
        user.comparePassword(password, function(err, isMatch) {
            if (err) {
                return done(err);
            }
            if (!isMatch) {
                return done(null, false);
            }

            return done(null, user);
        });
    });
});

// Setup options for JWT Strategy
const jwtOptions = {
    jwtFromRequest: ExtractJwt.fromHeader('authorization'),
    secretOrKey: config.secret
};

// Create JWT strategy
const jwtLogin = new JwtStrategy(jwtOptions, function(payload, done) {
    // See if the user ID in the payload exists in our database
    // If it does, call 'done' with that other
    // otherwise, call done without a user object
    User.findById(payload.sub, function(err, user) {
        if (err) {
            return done(err, false);
        }

        if (user) {
            done(null, user);
        } else {
            done(null, false);
        }
    });
});

// Tell passport to use this strategy
passport.use(jwtLogin);
passport.use(localLogin);
```

Passport is more of an ecosystem of strategies. A strategy is a method for authenticating a user.

In the Jwt Strategy, the payload comes from the `sub` and `iat` we created.

### Using Strategies with Passport

Reminder: Stategies are a plugin of sorts that works with Passport.

For the `jwtOptions`, there is a little bit of action going. If we look at the `payload` parameter for jwtLogin, we know it somehow gets these options as an argument, but the token can be sitting anywhere, so how do we know? We pass `jwtFromRequest` to let them know where to look eg `jwtFromRequest: ExtractJwt.fromHeader('authorization')`.

We then let them know that the we wish to use the option `secretOrKey` which will be `config.secret` in this case `secretOrKey: config.secret`.

As a final step, we tell passport to use the straight with the `.use()` method.

We also need to build a very particular route to use passport. In the router file, first import the `passportService` from `services/passport` and require the passport lib into routes as well.

The, we can create an authentication `const requireAuth = passport.authenticate('jwt', { session: false });` - session false is because we do not want to use a cookie.

```javascript
const Authentication = require('./controllers/authentication');
const passportService = require('./services/passport');
const passport = require('passport');

const requireAuth = passport.authenticate('jwt', { session: false });
const requireSignin = passport.authenticate('local', { session: false });

module.exports = function(app) {
    // here we wish to actually use require auth as middleware
    // before processing
    app.get('/', requireAuth, function(req, res) {
        res.send({ message: 'Super secret code is ABC123' });
    });
    app.post('/signin', requireSignin, Authentication.signin);
    app.post('/signup', Authentication.signup);
};
```

Using `Postman`, we can then make a `signup` attempt, grab the token and then try make a get request to `/`. If we add a header `authorization` and add in the token we get, we can see that we will get success. Changing this token slightly will give you an unauthorized response.

In contrast, if we want to run something like a signin, we would start by installing the `passport-local` "plugin" for passport.

We then create a local strategy. We need to specifically tell the local strategy where to look. If we're using email then we would write something like `const localOptions = { usernameField: 'email' };`.

**Local Strategy vs JWT Strategy**

Why there difference? Signing up requires signing in and returning a token.

If they are signing in however, we verify that the username and password are correct and then we give them a token.

Then, in the future, when they wish to make a request, we verify the token and give them access to whatever the resouce they want is.

**Bcrypt and Signing in**

If we then need to use the schema defined `comparePassword` method.

### Using Postman

Whenever you are willing to test the server using postman, startup the `mongod` daemon (if using mongo) and `nodemon index.js` on the server file, and then you can make GET and POST requests to the localhost port.

If signing up, add a body of JSON to the data.

## Client Side (React App)

In a form handler, we use an Action Creator.

Usually, there has been a singular flow for an action, however we are now sitting in a situation where you may have to handle what happens when signing in has a rejection.

If correct, return the JWT token, else show an error message.

What we can do is use `Redux Thunk` to help achieve the behaviour of dealing with a good or bad request. Redux thunk allows us to return a function from an `Action` instead of just an object, and we can pass a `dispatch` parameter and what we can then do is any async function etc. and then allowing arbitrary access to the dispatch at anytime we want - that way we can pass a whole ton of logic of what we want to do.

For the action creator itself, we then want to pass a constant of the server URL to make the post request - this can be done using `axios`!

### Dealing with CORS errors with a request (CORS in a nutshell)

How to deal with a CORS No Access-Control-Allow-Origin - it's essentially a security protocol.

In an example of how it works, a AJAX request from `google.com` to `google.com` with the same domain, subdomain and port matching means that the request is okay, but trying to do it from `google.com` to `github.com` as an example won't match and the request is denied unless the server allows it to happen.

This wasn't an issue with `Postman` because enforcing CORS will need either the `Host` or `Origin` header which is trivially easy to fake.

So, how do we deal with this? What we actually do is to change our server to handle all subdomains - this is a common approach for all API servers. The idea is that you want anyone from anywhere to be able to access your server.

We can use `cors` on the server to help with this. We will just use `app.use(cors());`.

### Local storage on the client and JWT

The idea with the JWT token is to save that and be able to use it. Having the JWT in local storage, it also means that it is persistent and available again for a user once they come back.

### Form vaidation

`redux-validation` can really help us out here!

With a form, create a function `validate()` that will take the `formProps` and return any errors.

```javascript
function validate(formProps) {
    const errors = {};

    console.log(formProps); // this would be linked up to the email, password and passwordConfirm

    // do this for each field
    if (!formProps.email) {
        errors.email = 'Please enter an email';
    }

    if (formProps.password !== formProps.passwordConfirm) {
        errors.password = 'Passwords must match';
    }

    return errors;
}
```

You can then set `{password.touched && password.error && <div className="error">{password.error}</div>}` for the error to show on the component.

### Signup Action Creator

For the form component, create an action handler for `onSubmit` with `<form onSubmit={handleSubmit(this.handleFormSubmit.bind(this))}`.

In order to protect routes from being accessed without authentication, we use Higher Order Components in order to wrap other components.

### Checking auth at the start of the application

With we use redux and `createStoreWithMiddleware(reducers)`, we can start applying some intricate details.

```javascript
// create a store ahead of time
const store = createStoreWithMiddleware(reducers);
const token = localStorage.getItem('token');
// if we have a token, consider the user to be signed in
if (token) {
    // we need to update application state - the dispatch method
    // any action can be sent off in the dispatch
    store.dispatch({
        // make sure you import AUTH_USER first
        type: AUTH_USER
    });
}
```

### Making Authenticated API Requests

How do we make sure a User can make an authenticated request after signing in?

With a `Redux Thunk` dispatch function, we can make a authenticated request.

With Axios, we can make an auth request like so:

```javascript
export function fetchMessage() {
    return function(dispatch) {
        axios
            .get(ROOT_URL, {
                headers: { authorization: localStorage.getItem('token') }
            })
            .then((response) => {
                console.log(response);
                dispatch({
                    type: TYPE,
                    payload: response.data.message
                });
            });
    };
}
```

This can also be done with `Redux Promise` in such a clean way:

```javascript
export function fetchMessage() {
    const request = axios.get(ROOT_URL, {
        headers: { authorization: localStorage.getItem('token') }
    });

    return {
        type: TYPE,
        payload: response.data.message
    };
}
```
