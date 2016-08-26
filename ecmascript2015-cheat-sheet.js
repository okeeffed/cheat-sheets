// Arrow functions

**
** Basic Syntax
**

(param1, param2, …, paramN) => { statements }
(param1, param2, …, paramN) => expression
         // equivalent to:  => { return expression; }

// Parentheses are optional when there's only one parameter:
(singleParam) => { statements }
singleParam => { statements }

// A function with no parameters requires parentheses:
() => { statements }

**
** Adv Syntax
**

// Parenthesize the body to return an object literal expression:
params => ({foo: bar})

// Rest parameters and default parameters are supported
(param1, param2, ...rest) => { statements }
(param1 = defaultValue1, param2, …, paramN = defaultValueN) => { statements }

// Destructuring within the parameter list is also supported
var f = ([a, b] = [1, 2], {x: c} = {x: a + b}) => a + b + c;
f();  // 6

*
* 	Rest parameters
*

- rest must be the last parameter

function myFunction(name, ...params) {
	console.log(name, params);
}

myFunction('Andrew', 1, 2, 3);

// output Andrew [1, 2, 3]

*
*   Spread parameters
*

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

*
* 	Destructuring
*

Relatively simple concept

Lets you extract values from arrays or objects

let toybox = { item1: 'car', item2: 'ball', item3: 'frisbee' };

let { item1, item2 } = toybox;

console.log(item1);

// logs item1 value

let { item3: disc} = toybox;

console.log(disc);

// logs item3 value

let widgets = ['wid1','wid2','wid3','wid4','wid5'];

// using the spread operator
let [a,b,c, ...d] = widgets;


*
* 	Object Property Shorthand
*

function submit(name, comments, rating = 5) {
	let data = { name, comments, rating };

	for (let key in data) {
		console.log(key + ':', data[key]);
	}

	// ... do ajax request
}

submit('English', 'Great course!');

// without a default name, the key because the parameter for the object
// works with all data types

*
* 	for...of
*

For iterating over a data set

// previous for (let ... )
// ES5 gave us for each
// you can use break in for...of loop

let myNumbers = [1,2,3,4,5,6];

for (let number of myNumbers) {
	...
}

// still use for...in for iterating over object data

*
* Set
*

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
