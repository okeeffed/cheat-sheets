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
const localLogin = new LocalStrategy(localOptions, function(email, password, done) {
  // Verify this email and password, call done with the user
  // if it is the correct email and password
  // otherwise, call done with false
  User.findOne({ email: email }, function(err, user) {
    if (err) { return done(err); }
    if (!user) { return done(null, false); }

    // compare passwords - is `password` equal to user.password?
    user.comparePassword(password, function(err, isMatch) {
      if (err) { return done(err); }
      if (!isMatch) { return done(null, false); }

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
    if (err) { return done(err, false); }

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
}
```

Using `Postman`, we can then make a `signup` attempt, grab the token and then try make a get request to `/`. If we add a header `authorization` and add in the token we get, we can see that we will get success. Changing this token slightly will give you an unauthorized response.

In contrast, if we want to run something like a signin, we would start by installing the `passport-local` "plugin" for passport.

We then create a local strategy. We need to specifically tell the local strategy where to look. If we're using email then we would write something like `const localOptions = { usernameField: 'email' };`

