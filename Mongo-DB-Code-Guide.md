# Mongo Cheat Sheet

## MONGO-1: Mongo Install

```
npm install mongoose --save

// to run

mongod // starts the daemon
mongo // check out the documents
```

## MONGO-2: Mongo Shell

```
show dbs — // display the databases
use bookworm — // specify the database you're going to work with
show collections — // shows the document collections for the selected database
db.users.find() — // display all the documents in the users collection
db.users.find().pretty() — // nicer format for output documents within the shell
db.users.drop() — // remove the users collection from the current database
```

## MONGO-3: Mongo Sample Usage

```javascript
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
```

## MONGO-4: Building an Example Schema in the `mock` folder

```
// mock/example.js

import mongoose from 'mongoose';

const schema = new mongoose.Schema({
  question: String,
  answer: String,
  completed: Boolean
});

export const model = mongoose.model('Layout', schema);
```

## MONGO-5: Accessing the Schema results

```
// in a route file
var express = require('express');
var router = express.Router();

import {ExampleModel} from '../models/example';

/* GET users listing. */
router.get('/', (req, res) => {
  console.log(ExampleModel);
  ExampleModel.find({}, "test string", (err, results) => {
    if (err) {
      return res.status(500).json({message: err.message});  
    }
    res.json({ results: results });
  });
  // res.json({ todos: "todos" });
    // res.send('respond with a resource');
});

module.exports = router;
```