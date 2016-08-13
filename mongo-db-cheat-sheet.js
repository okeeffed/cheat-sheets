/*
*
*		MONGO INSTALL
*
*/

npm install mongoose --save

// to run

mongod // starts the daemon
mongo // check out the documents

/*
*
*		MONGO SHELL
*
*/

show dbs — // display the databases
use bookworm — // specify the database you're going to work with
show collections — // shows the document collections for the selected database
db.users.find() — // display all the documents in the users collection
db.users.find().pretty() — // nicer format for output documents within the shell
db.users.drop() — // remove the users collection from the current database

/*
*
*		MONGO SAMPLE USAGE
*
*/

// models > user.js

var mongoose = require('mongoose');

var UserSchema = new mongoose.Schema({
  email: {
    type: String,
    required: true,
    trim: true,
    unique: true,
  },
  name: {
    type: String,
    required: true,
    trim: true,
  },
  favoriteBook: {
    type: String,
    required: true,
    trim: true
  },
  password: {
    type: String,
    required: true
  }
});

var User = mongoose.model('User', UserSchema);
module.exports = User;

// in app.js

var User = require('../models/user');
