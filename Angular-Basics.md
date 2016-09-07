# ANGULAR BASICS

## JSANG-1: Getting Started with Angular

#### ---- JSANG-1.1: Intro to Angular

Angular is known for rapid dev cycles and one page apps that are responsive.

_Why Angular?_

- Declarative -> tell it what to do
- You can do a lot more with less code
- You can keep the app well organised even as they grow
- Great support community

What is it and how does it work?

Browser - referred to as client.

Angular apps lives 100% on the client. When the user makes a request, the entire app comes back. Made up entirely in JavaScript. Unlike things like Django and Express...

Makes additional calls via Ajax, but only for the data. Most of the time, it is JSON.

Angular is referred to as a Client Side Application Framework.
App can even send data back to the server.

Other examples: Backbone, Ember.

#### ---- JSANG-1.2: Nuts and Bolts of Angular

_Four main concepts:_
1. Templates/Views
- hold most of the html and what structure the application.
2. Directives
- <directives> manipulate data (can create custom)
3. Controllers
- controls interaction and data
4. Scope
- scope allows us to manipulate data and make changes
- multiple scopes
- each of the other elements can have their own scope.

eg.
myApplicationTemplate.html
<my-awesome-directive></my-awesome-directive>
- directive will change once the page loads depending on what we've told the directive.
- directive has an associated controller -> can add CSS etc.
- directive and controller can share a scope

QUESTIONS

1. Angular applications cannot make additional requests to the server, after the initial application loads in the client.

A: False

#### ---- JSANG-1.3: Setting up your first Angular App

CDN for Angular: <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

Otherwise, download from Angular website.

First thing to do is use angular module method.

```javascript
// in app.js
angular.module("todoListApp", []); //array defines the dependencies

// in index.html
<body ng-app="todoListApp"> //tells angular where to bootstrap
```

#### ---- JSANG-1.4: Your first custom directive

in the Angular set up so far...

(from top level)
index.html
scripts (directory)
	- scripts/app.js
styles
	- styles/main.css
	- styles/hello-world.js

vendor
	- vendor/angular.js

```javscript
// in vendor/hello-world.js

angular.module('todoListApp') //no second param, since no new module. It will then look for it.
.directive('helloWorld', function() {
	return {
		template: "This is the hello world directive!";
	};
});

// now can include <hello-world></hello-world> //changes from camelcase to lowercase tags

// template is then injected into the tags!

How to do as attributes of tags?

Change the tag into a div:
<div hello-world></div>

// in vendor/hello-world.js

angular.module('todoListApp') //no second param, since no new module. It will then look for it.
.directive('helloWorld', function() {
	return {
		template: "This is the hello world directive!";
		restrict: "E" //only use as an element or only as an element attribute -> elements being the <hello-world></hello-world>
	};
});
```

***

## JSANG-2: Controllers and Scope

#### ---- JSANG-2.1: Creating a Controller

The glue that hold the apps together

To create the controller, we use the controller method in app.js

//scripts/app.js

```javascript
angular.module("todoListApp", [])
.controller("mainCtrl", function($scope) {
	//to us controller, you need to inject with ng-controller in html
	$scope.helloWorld = function() {
		console.log("Hello there! This is the Hello World Controller function in the mainCtrl!");
	};
});

//in index.html
<div ng-controller="mainCtrl" class="list">
	... //all within the scope
	<a href="" ng-click="helloWorld()">Save</a> //fires the ctrl function
	...
</div>
```

"Injecting a controller": Use the controller here.

#### ---- JSANG-2.2: Tools to make you an Angular Pro

2 Angular Chrome Plugins

ng-inspector
AngularJS Batarang

#### ---- JSANG-2.3: Understanding Scope

Scope works with prototypical inheritance
- best practise not to use $rootScope

After creating hello world in both hello world ctrl and coolctrl...
helloWorld() now is defined by the closest scope! Ctrl only inherits if it is not defined within itself.

Only flows from parent to child.
Sibling controllers do not have access to other scopes.

***

## JSANG-3: Using Angular's Built In Directives

#### ---- JSANG-3.1: Adding Data to Your App Using ng-model

Helps a lot out of the box.

Data-binding is the key concept of this video.

Data-binding is where applications data and variables come together.
- The data is continually updated in the scope.
- 2-way Data Binding

Example: The data field.

Using the ng-model directive.

//in index.html
<input ng-model="todo" ... >

Once we start typing, the todo variable is initialised. Changes dynamically.

This is the two-way data binding at work.

<input ng-model="todo.name" ... >

Checkbox...
<input ng-model="todo.completed" ... > //becomes true when checked/unchecked

Inside label...

<label ...>{{todo.name}}</label>

- todo.name = $scope.todo.name
- ng-model used on <input>

#### ---- JSANG-3.2: Using ng-click

ng-click="editing = !editing" //can be used with any elements as an attribute

ng-hide="editing" //in the appropriate element
ng-show="editing"


//index.html

```xml
<!doctype html>
<html lang="en">
<head>
  <title></title>
  <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
</head>
<body ng-app="todoListApp">

  <h1 ng-click="helloConsole()">My TODOs!</h1>

  <div class="list" ng-controller="mainCtrl">
    <input type="checkbox" ng-model="todo.completed">
    <label ng-hide="editing">{{todo.name}}</label>
    <input ng-show="editing" class="editing-label" type="text" ng-model="todo.name">
    <div class="actions">
      <a href="" ng-click="editing = !editing">Edit</a>
      <a href="" ng-click="helloConsole()">Save</a>
      <a href="" class="delete">Delete</a>
    </div>
   </div>

  <script src="vendor/angular.js"></script>
  <script src="scripts/app.js"></script>
</body>
</html>
```

#### ---- JSANG-3.3: Using ng-repeat to inject HTML for every data element

Paste array and check if within scope.

```xml
<div ng-repeat="todo in todos">
...
</div>
```

Each item makes each unique item from repeat.
The directives and controller data also repeats with new scopes.

#### ---- JSANG-3.4: Using ng-blur and ng-class

NG-BLUR
- ng-blur is fired during click actions.

in the input...

```xml
<input ng-blur="editing = false;" ng-show="editing" ng-model="todo.name" class="editing-label" type="text"/> //false because it only goes one way
```

NG-CLASS
- this is for the CSS to apply when scope it in editing mode

```javascript
ng-class="{'editing-item': editing}" //class is editing-item
```

#### ---- JSANG-3.5: NG-change to set Data State

//fires any time the value of the input changes

```javascript
ng-change="learningNgChange()" //scope function

// in the controller...
$scope.learningNgChange = function() {
	console.log("Input change");
};

//making the directive useful
ng-change="todo.edited = true"
```

***

__CHALLENGE__

```xml
<!doctype html>
<html lang="en">
<head>
  <title></title>
  <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
</head>
<body ng-app="todoListApp">

  <h1 ng-click="helloConsole()">My TODOs!</h1>

  <div class="list" ng-controller="mainCtrl">
    <div class="item" ng-class="{'editing-item': editing, 'edited': todo.edited}" ng-repeat="todo in todos">
      <input type="checkbox" ng-model="todo.completed">
      <label ng-hide="editing">{{todo.name}}</label>
      <input ng-show="editing" ng-blur="editing = false" class="editing-label" type="text" ng-change="todo.edited = true" ng-model="todo.name">
      <div class="actions">
        <a href="" ng-click="editing = !editing">Edit</a>
        <a href="" ng-click="helloConsole()">Save</a>
        <a href="" class="delete">Delete</a>
      </div>
    </div>
   </div>

  <script src="vendor/angular.js"></script>
  <script src="scripts/app.js"></script>
</body>
</html>
```

***

## JSANG-4: Services in Angular

#### ---- JSANG-4.1: What are services?

Services used for dependency injection.

Multiple controllers can use the service is declared as a dependency.

Useful for many things eg. REST API etc

```javascript
//in app.js

.service("dataService", function() {

	this.helloConsole = function() {
		console.log("Hello String!");
	}

});

//in the .controller func from above
- data service is now the second parameter

.controller("mainCtrl", function($scope, dataService) {

	$scope.helloConsole = dataService.helloConsole;

	... //info

});
```

#### ---- JSANG-4.2: Using Services to get data

Request fake data from a server.
- put a todo list in another file: mock/todos.json

```javascript
//in app.js

.controller("mainCtrl", function($scope, dataService) {

	... //info

	dataService.getTodos(function(response) {
		$scope.todos = response.data;
	});

});

.service("dataService", function($http) {

	this.helloConsole = function() {
		console.log("Hello String!");
	}

	//built ins are called providers

	this.getTodos = function(callback) {
		$http.get('mock/todos.json')
		.then(callback) //first arg takes url
	}

});
```

#### ---- JSANG-4.3: Using Services to save and delete data

```javascript
//in app.js

.controller("mainCtrl", function($scope, dataService) {

	... //info

	dataService.getTodos(function(response) {
		$scope.todos = response.data;
	});

	$scope.deleteTodo = function(todo, $index) {
		dataService.deleteTodo(todo);
		//then add to html using ng-click="deleteTodo(todo, $index)"
		$scope.todos.splice($index, 1);
	}

	$scope.saveTodo = function(todo) {
		dataService.saveTodo(todo);
		//use ng-click="saveTodo(todo)"
	}

});

.service("dataService", function($http) {

	this.helloConsole = function() {
		console.log("Hello String!");
	}

	//built ins are called providers

	this.getTodos = function(callback) {
		$http.get('mock/todos.json')
		.then(callback) //first arg takes url
	}

	this.deleteTodo = function(todo) {
		console.log("Todo Deleted");
		//simulate communicated with database
		//other logic
	};

	this.saveTodo = function(todo) {
		console.log("Todo saved");
		//other logic
	};

});
```

#### ---- JSANG-4.4: Creating new data in the UI and Saving with a Service

```xml
//in index/html

<div class="add">
	<a href="">Add a New Task</a>
</div>
```

```javascript
//in app.js

.controller("mainCtrl", function($scope, dataService) {

	... //info

	$scope.addTodo = function() {
		var.todo = {name: "This is a new todo."};
		$scope.todos.push(todo);
	};

	dataService.getTodos(function(response) {
		$scope.todos = response.data;
	});

	$scope.deleteTodo = function(todo, $index) {
		dataService.deleteTodo(todo);
		//then add to html using ng-click="deleteTodo(todo, $index)"
		$scope.todos.splice($index, 1);
	}

	$scope.saveTodo = function(todo) {
		dataService.saveTodo(todo);
		//use ng-click="saveTodo(todo)"
	}

});

.service("dataService", function($http) {

	this.helloConsole = function() {
		console.log("Hello String!");
	}

	//built ins are called providers

	this.getTodos = function(callback) {
		$http.get('mock/todos.json')
		.then(callback) //first arg takes url
	}

	this.deleteTodo = function(todo) {
		console.log("Todo Deleted");
		//simulate communicated with database
		//other logic
	};

	this.saveTodo = function(todo) {
		console.log("Todo saved");
		//other logic
	};

});

CHALLENGE

Create a service which logs a callback.

angular.module('foobar', [])
.service("myService", function() {
  this.testingMyService = function() {
     console.log("This is my service!");
  }
});
```

***

## JSANG-5: Improving Our Todo App

#### ---- JSANG-5.1: Scaffolding our App

- small application so far
- more controllers and services

For managing, we scaffold:
- for small apps, all controllers, directories and services in different folders

```javascript
main.js //controllers folder -> main controller

'use strict'; //interpreted in strict mode

//add in .controller

angular.module("todoListApp") //don't provide dependencies parameter this time
.controller(...)

Make sure you load the scripts!

//repeat process for data service
//data.js

'use strict';

angular.module("todoListApp")
.service(...)
```

App.js may appear empty
- other things can be configured and set up here

#### ---- JSANG-5.2: Using Filters for ng-repeats

ng-repeat saves a ton of time, but we need complete UI states etc.

```
Adds complete class when todo.completed = true
ng-class="{..., "complete": todo.completed}

//to move to the bottom

ng-repeat="todo in todos | orderBy: 'completed'" //sets or using the pipe

ng-repeat="todo in todos | orderBy: 'completed' : true"
ng-init="todo.completed = false" //only used with ng-repeat
```

Need to also make sure that in the controller, we have unshift instead of push for the array.

#### ---- JSANG-5.3: Custom directive for todos

Remove todos and create custom directive <todos></todos>
- name file the same as directive

Create templates/todos.html

Create scripts/directives/todos.js

```javascript
angular.module("todoListApp")
.directive('todos' function() {
	return {
		templateUrl: 'templates/todos.html',
		controller: 'mainCtrl' //can define the controller too,
		replace: true
	}
});
```

To get rid of directive tags, use the replace key.

#### ---- JSANG-5.4: Finalising the App

- adding a save all function
- ng-click and start editing

for the save in main.js...

```javascript
.controller(... function() {

	...

	$scope.saveTodos = function() {
		var filteredTodos = $scope.todos.filter(function(todo) {
			if (todo.edited) {
				return todo;
			};
		})
		dataService.saveTodos(filteredTodos);
	}

})
```

QUESTIONS

1. In the object a directive returns, _________ loads an html file as a directive template.

A: 'templateUrl'

2. The Array's _________ method returns a subset of the array based on logic in the callback. For example, `['foo', 'bar', 'yes', 'no'].someMethod(callback)`.

A: filter

3. In the object that a directive returns, the _________ key defines a controller to be used.

A: 'controller'

4. The first parameter of angular's `directive` method is __________.

A: The name of the directive
