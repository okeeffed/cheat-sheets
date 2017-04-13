# Advanced React and Redux

## 1. Testing

Jumping into examples are normally more useful as you are learning.

In the `testing` folder you will see a whole bunch of configuration for `test_helper.js`.

### Test Reporting

## 4. Authentication

Not a lot of great end-to-end tutorials already. Most skip some important steps.

Best React backend? There is no best backend. All they care about is being served JSON.

Work on the relationship of have a `Username/Password` combination and being authenticated by the server. After being authenticated, we want them to be able to make post requests without reidentifying. The server must give the client back something for this part.

In conclusion, we just want `Here is my cookie OR token for a protected resource`.

### Cookies vs Tokens

**Cookies**

- Automatically included on all requests 
- Unique to each domain 
- Cannot be sent to different domains 

Headers - `cookie: {}`
Body - JSON 

The point of cookies is to bring `state` to something `stateless`

**Token**

- Have to manually wire up
- Can be sent to any domain 

Headers - `authorization: jioeajteioa`
Body - JSON

Being able to send this to any domain we wish is a benefit with a token.

### Scalable Architecture 

So we've decided to go with tokens, which is also aligned with how the industry is trending.

If we served `index.html` and `bundle.js` from a Content Server, we can make that server work with no auth req'd.
- Very easy to redistribute 

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

- Morgan is a logging framework - quite good for giving the type of requests!
- Cors allows you the server to use Cross Origin.
- bodyParser will parse incoming requests. At the moment, it's just for JSON but you may need to change this if you are expecting a file etc.

### Seeing the MongoDB Database 

Worthwhile downloading `Robomongo` if you are keen to visually see a GUI with MongoDB.

### Authentication Controller

In the server, we can create some controllers eg. `controllers/authentication.js`.

Each controller will be responsible for handling a type of response.

In `router.js`, we can use the functions exported from the controller to create routes that will deal with post routes.

### JWT Overview

There are two phases for the lifecycle.

1. When signing in 

`User ID` + `Secret String` = `JSON Web Token`

In the future, the user can now use this token for future requests.

2. Authenticated calls after signin 

`JSON Web Token` + `Secret String` = `User ID`

If the "secret string" is incorrect, then this will not result in the User ID. Must keep the secret 100% secret!

**Building the JTW**

We can use the library `jtw-simple`. In the `config.js` file at the root of the app, we can hold the application secrets and config. Ensure these files are `.gitigore`'d.

```
const jwt = require('jwt-simple');
const config = require('../config');

function tokenForUser(user) {
	const timestamp = new Date().getTime();
	// convention will have sub for subject, iat for issued at time
	return jwt.encode({ sub: user.id, iat: timestamp }, config.secret);
}
```

### Passport 