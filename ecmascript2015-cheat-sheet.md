# Introducing ES2015

## 1. ES2015 Basics

6th Edition to ECMA Script

### Getting Started with ES2015

- biggest change up to JS since its inception
- JS built in 10 days
- Microsoft used Jscript
- ECMAScript and JavaScript are the same (ECMA named 1997)
- ECMAScript 5 (2009)
- Most browsers are using the latest
- Babel can be used to compile for those using older browsers

### Let and Const

- so far, we need to be on top of scope

```javascript
'use strict';

var hello = 'hello'

// ecma2015

A block can be either a loop, if statement or function

'use strict'

(function initLoop() {
	function doLoop(x) {
		console.log('loop: ', x);
	}

	for (var i=0; i < 10; i++) {
		doLoop(i + 1);
	}
})
```

...what can go wrong? Dirty Read

```javascript
'use strict'

(function initLoop() {
	function doLoop(x) {
		i=3;
		console.log('loop: ', x);
	}

	for (var i=0; i < 10; i++) {
		doLoop(i + 1);
	}
})

We can fix this with the let keyword

'use strict'

(function initLoop() {
	function doLoop(x) {
		// i=3; -> this won't be allowed
		console.log('loop: ', x);
	}

	for (let i=0; i < 10; i++) {
		doLoop(i + 1);
	}
})
```

** this will throw an error at us! **

### Duplicate values

```javascript
'use strict';

var student = { name: 'Ken' };
var student = { name: 'James' };

console.log(student);

// student become James

'use strict';

const student = { name: 'Ken' };
var student = { name: 'James' };

console.log(student);

// we will now get an exception (happens for let or const)

- you can have different const variables of the same name for different constants

**not allowed**

... {
	const student = 'test';
	... {
		student = 'test'
	}
}

**allowed**

... {
	let student = 'test';
	... {
		student = 'test'
	}
}
```

** Use let when you need to reassign, use const when you do not want the value to change. **

### Template Strings

** ES5 Strings **

let str = 'My favourite name is';

console.log(str, 5);

** ES2015 Strings **

// interpolation

const student = { name: 'James', followerCount: 34 }

${student.name}

` <this stuff is neatly formatted> `

### String search methods

new functions:

startsWith
endsWith
includes

console.log(strToSearch.startsWith('example-at-start'));
console.log(strToSearch.endsWith('example-at-end'));
console.log(strToSearch.includes('example-in-the-middle'));

** all take an optional parameter **

startsWith('example', 5); //start search from 5th index
endsWith('example', 21); //searches the first 21 characters

## 2. The Cooler Parts of ES2015

### Arrow Functions

- Bound to its parent scope

New syntax for writing functions
- referred to as Lamda functions in other languages

** ES5 **

```javascript
'use strict';

var Person = function (data) {
  for (var key in data) {
    this[key] = data[key];  
  }
  this.getKeys = function () {
    return Object.keys(this);
  }
}

var Alena = new Person({ name: 'Alena', role: 'Teacher' });

console.log('Alena\'s Keys:', Alena.getKeys()); // 'this' refers to 'Alena'

var getKeys = Alena.getKeys;

console.log(getKeys()); // 'this' refers to the node process

// throws error get getKeys()
```

** ES2015 **

```javascript
'use strict';

var Person = function (data) {
  for (var key in data) {
    this[key] = data[key];  
  }
  this.getKeys = () => {
    return Object.keys(this);
  }
}

var Alena = new Person({ name: 'Alena', role: 'Teacher' });

console.log('Alena\'s Keys:', Alena.getKeys()); // 'this' refers to 'Alena'

var getKeys = Alena.getKeys;

console.log(getKeys()); // 'this' refers to the node process

// this fixes it!
```

The lamda function binds the function to the instance of the person no matter where it was called

** Promises **

```javascript
'use strict';

var Teacher = function (data) {
  this.name = data.name;
  this.greet = function (studentCnt) {
    let promise = new Promise(function (resolve, reject) {
      if (studentCnt === 0) {
        reject('Zero students in class');
      } else {
        resolve(`Hello to ${studentCnt} of my favorite students!`);
      }
    });
    return promise;
  }
}

var Classroom = function (data) {
  this.subject = data.name;
  this.teacher = data.teacher;
  this.students = [];
  this.addStudent = function (data) {
    this.students.push(data);
    this.greet();
  }
  this.greet = () => {
    this.teacher.greet(this.students.length).then(
      (function (classroom) {
        return function (greeting) {
          console.log(`${classroom.teacher.name} says: `, greeting);
        }
      })(this),
      function (err) {
        console.log(err);
      })
  }
}

var myTeacher = new Teacher({ name: 'James' });
var myClassroom = new Classroom({ name: 'The Future of JavaScript', teacher: myTeacher });

myClassroom.addStudent({ name: 'Dave' });
```

** ES 2015 Promises **

```javascript
'use strict';

var Teacher = function (data) {
  this.name = data.name;
  this.greet = function (studentCnt) {
    let promise = new Promise(function (resolve, reject) {
      if (studentCnt === 0) {
        reject('Zero students in class');
      } else {
        resolve(`Hello to ${studentCnt} of my favorite students!`);
      }
    });
    return promise;
  }
}

var Classroom = function (data) {
  this.subject = data.name;
  this.teacher = data.teacher;
  this.students = [];
  this.addStudent = function (data) {
    this.students.push(data);
    this.greet();
  }
  this.greet = () => {
    this.teacher.greet(this.students.length).then(
      greeting => console.log(`${this.classroom.teacher.name} says: `, greeting);
	  error => console.log(err);
  }
}

var myTeacher = new Teacher({ name: 'James' });
var myClassroom = new Classroom({ name: 'The Future of JavaScript', teacher: myTeacher });

myClassroom.addStudent({ name: 'Dave' });
```

### Default Parameters

Set default parameters for a function -> similar to other languages

** ES5 **

```javascript
'use strict'

function greet(name, timeOfDay) {
	name = name || 'Guil';
	timeofDay = timeOfDay || 'Day';
	...
}

greet();

** ES 2015 **

'use strict'

function greet(name = 'Guil', timeOfDay = 'Day') {
	...
}

greet(undefined, 'Afternoon');	// defaults are optional, need to undefine
```

### Rest Parameters and Spread Operator

** How to use the rest parameters **

- rest must be the last parameter

```javascript
function myFunction(name, ...params) {
	console.log(name, params);
}

myFunction('Andrew', 1, 2, 3);

// output Andrew [1, 2, 3]
```

** Spread parameters **

```javascript

const originalFlavors = ['Chocolate', 'Vanilla'];

const newFlavors = ['Strawberry', 'Mint Chocolate Chip'];

const inventory = ['Rocky Road', ...originalFlavors, 'Neopolitan', ...newFlavors];

console.log(inventory);

// spitting an array and them using them as arguments using the spread operator

function myFunction(name, iceCreamFlavor) {
	console.log('${name} really likes ${iceCreamFlavor} ice cream.')
}

let args = ['Gabe', 'Vanilla'];

myFunction(...args);	// sends as separate arguments
```

### Destructuring

Relatively simple concept

Let's you extract values from arrays or objects

```javascript

let toybox = { item1: 'car', item2: 'ball', item3: 'frisbee' };

let { item3: disc} = toybox;

console.log(disc);

// logs item3 value

let widgets = ['wid1','wid2','wid3','wid4','wid5'];

let [a,b,c, ...d] = widgets;
```

## 3. Objects and New Collection Types

### Object Property Shorthand

```javascript

function submit(name, comments, rating = 5) {
	let data = { name, comments, rating };

	for (let key in data) {
		console.log(key + ':', data[key]);
	}

	// ... do ajax request
}

submit('English', 'Great course!');

// without a default name, the key because the parameter for the object
// works with all forms
```

### for...of

For iterating over a data set

```javascript
// previous for (let ... )
// ES5 gave us for each

let myNumbers = [1,2,3,4,5,6];

for (let number of myNumbers) {
	...
	if (example) {
		break; // you can break!
	}
}

// still use for...in for iterating over regular objects
```

### Set

```javascript
let classroom = new Set(); // unique collection of values

let stevenJ = { name: 'Steven', age: 22 },
	sarah = { name: 'Sarah', age: 23 },
	stevenS = { name: 'Steve', age: 22 }

classroom.add(stevenJ);
classroom.add(sarah);
classroom.add(stevenS);

if (classroom.has(stevenJ)) console.log('stevenJ is in the classroom');	//true
if (classroom.has(sarah)) console.log('sarah is in the classroom');	//true
if (classroom.has(stevenS)) console.log('sarah is in the classroom'); //true

BUT IF stevenS = stevenJ

let stevenJ = { name: 'Steven', age: 22 },
	sarah = { name: 'Sarah', age: 23 },
	stevenS = stevenJ;

classroom.add(stevenJ);
classroom.add(sarah);
classroom.add(stevenS);

if (classroom.has(stevenJ)) console.log('stevenJ is in the classroom');	//true
if (classroom.has(sarah)) console.log('sarah is in the classroom');	//true
if (classroom.has(stevenS)) console.log('sarah is in the classroom'); //true

console.log(classroom.size()); //3

classroom.delete(stevenJ)

console.log(classroom.size()); //2

// Create array of students from the classroom set

let arrayOfStrudents = Array.from(classroom);
console.log(arrayOfStudents);

// Create set from set

let alumni = new Set(arrayOfStudents);
```

### Map

```javascript
'use strict'

let classroom = new Map();

let stevenJ = { name: 'Steven', age: 22 },
    sarah = { name: 'Sarah', age: 23 },
    stevenS = { name: 'Steven', age: 22 };

classroom.set('stevenJ', stevenJ);
classroom.set('sarah',sarah);
classroom.set('stevenS', stevenS);

console.log(classroom.size);

if (classroom.has('stevenJ')) console.log('stevenJ is in the classroom');
if (classroom.has('sarah')) console.log('sarah is in the classroom');
if (classroom.has('stevenS')) console.log('stevenS is in the classroom');

console.log('sarah:', classroom.get('sarah'));

classroom.delete('sarah');
classroom.clear();        //deletes all

for (let student of classroom) {
  console.log('${student[0]} : ${student[1].name} is ${student[1].age} years old');
}
```

## 4. Classes

### Structure of a Class

A class is a blueprint for those that share similar properties or methods

```javascript
// old way

let Student = function(data) {
  this.name = data.name;
  this.age = data.age
}

// new way

class Student {
  constructor({ name, age, interestLevel = 5 } = {}) {
    this.name = name;
    this.age = age;
    this.interestLevel = interestLevel;
    this.grades = new Map();
  }
}

let sarah = new Student('Sarah', 11);

console.log(Array.from(sarah.grades));
```

### Subclasses

- classes can inherit from other classes
- var hoisting
- destructuring is one way to set default values for class properties

```javascript
bla = 2
var bla;
// ...

// is implicitly understood as:

var bla;
bla = 2;
```

```javascript
class Person {
  dance() {
    const dances = [
      'waltz',
      'tango',
      'mambo'
    ];

    console.log(${this.name} is doing the ${dances[Math.floor(Math.random()*dances.length)]}!);
  }
  constructor({ name, age, eyeColor = 'brown' } = {}) {
    this.name = name;
    this.age = age;
    this.eyeColor = eyeColor;
  }
}

class Student extends Person {

  dance(traditional) {
    if (traditional) {
      super.dance();
      return;
    }

    const dances = [
      'lyrical',
      'tap',
      'jazz'
    ];

    console.log(${this.name} is doing the ${dances[Math.floor(Math.random()*dances.length)]}!);
  }

  constructor({ name, age, interestLevel = 5 } = {} ) {
    super({ name, age });
    this.name = name;
    this.age = age;
    this.interestLevel = interestLevel;
    this.grades = new Map;
  }
}

let stevenJ = new Student({name: 'Steven', age: 22, interestLevel: 3 });
stevenJ.dance();
```

## Static Methods

```javascript
class Bird {
  static changeColor(color) {
    this.color = color;
  }
  constructor({ color = 'red' } = {}) {
    this.color = color;
  }
}

let redBird = new Bird;
console.log(redBird.color);
redBird.changeColor('blue');
console.log(redBird.color); // would call an error!

// what we could do

Bird.changeColor.call(redBird, 'blue');
console.log(redBird.color);

/* the other option is to change the changeColor function to accept (bird, color) and then change this.color to bird.color
*/
```

## Getter and Setter methods in a class

```javascript
class Bird {
  changeColor(color) {
    this.color = color;
  }

  set color(color) {
    this.color = color;
  }

  get color() {
    return this.color;
  }

  constructor({ color = 'red' } = {}) {
    this.color = color;
  }
}
```
