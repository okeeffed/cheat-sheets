# npm help sheet

## install npm dependencies

```
npm install
```

## USEFUL NPM DEPENDENCIES

#### MONGOOSE - database helper for MongoDB

```
npm install --save mongoose

mongod // starts the daemon
mongo // check out the documents
```


```javascript
var User = mongoose.model('User', UserSchema);
module.exports = User;

// in app.js
var User = require('../models/user');
```

#### BCRYPT - used for hashing and salting

```
npm install --save bcrypt
```

```javascript
// in User.js
var bcrypt = require('bcrypt');
UserSchema.pre('save', function(next) {
	var user = this;
	bcrypt.hash(user.password, 10, function(err, hash) {
		if (err) {
			return next(err);
		}
		user.password = hash;
		next();
	})
});

UserSchema.statics.authenticate = function(email, password, callback) {
	User.findOne({ email: email })
		.exec(function (error, user) {
			if (error) {
				return callback(error);
			} else if (!user) {
				var err = new Error('User not found.');
				err.status = 401;
				return callback(err);
			}
			bcrypt.compare(password, user.password, function (error, result) {
				if (result === true) {
					return callback(null, user);
				} else {
					return callback();
				}
			});
		});
}

// Example in app.js for Express

router.post('/login', function(req, res, next) {
	if (req.body.email && req.body.password) {
		User.authenticate(req.body.email, req.body.password, function (error, user) {
			if (error || !user) {
				var err = new Error('Wrong email or password.');
				err.status = 401;
				return next(err);
			} else {
				req.session.userId = user._id;
				return res.redirect('/profile');
			}
		});
	} else {
		var err = new Error('Email and password are required.');
		err.status = 401;
		return next(err);
	}
});
```


#### EXPRESS SESSION - save sessions to use throughout the website

```
npm install express-session --save
```

```javascript
// in app.js

var session = require('express-session');

// use sessions for tracking logins - check more in the readme
app.use(session({
	secret: 'treehouse loves you',
	resave: true,
	saveUninitialized: false
}));

// not useful when in production. check https://github.com/expressjs/session#compatible-session-stores
```

#### CONNECT-MONGO - used for quick middleware access to Mongo

connect-mongo is a middleware already written for us!

```
npm install connect-mongo --save
```

```javascript
require MongoStore = require('connect-mongo')(session);

// in app.js

app.use(session({
	secret: 'treehouse loves you',
	resave: true,
	saveUninitialized: false
	store: new MongoStore({
		mongooseConnection: db
	})
}));
```
