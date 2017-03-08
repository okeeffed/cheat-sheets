# RxJS

## 1.0 A Brief Recap of Programming Paradigms 

**Procedural Program**

- The ideas that programs are a sense of functions
- Goes from top to bottom
- Relies heavily on global state, but any line can change the global state
- C being a procedural language
- "Imperative" execution
- Easy to write, difficult to maintain
- Prone to difficult bugs

**Object Oriented**

- Based around a Primitive: object
- Objects have well defined interfaces
- Localised behaviour
- Objects control state
- Composition
- Code is still imperative - pro AND con! 
	- Still telling the computer EXACTLY what to do.
- Can be more verbose

**Declarative**

- Describing what you want to happen, but not telling the computer how to do it 
- Eg. SQL, Regex, HTML
- Data is self-describing 
- As powerful as the interpreter allows 
- As limiting as the interpreter allows 
	- You want build a game in SQL etc.

**Functional**

- What we want to happen but not how
- Little state 
- Few side effects 
- Easy to reason about 
- Composition 
- Expressive 
- Works great with OO 
- Basis in higher math 
- Cons to think differently 
- Not always the best choice
- No loops, no control logic
	- Just telling it what we want to happen

**Reactive**

- Primitive: Observable 
- Instead of describing data in terms of other data, we describe it in terms of streams of events 
	- From this, we create a pipeline such that we certain data changes, a lot is processed and changed 
	- Example: spreadsheets!
- Composition
- Expressive 
- Data flows unidirectionally 
- Tough to think differently 
- Subscriptions help change the data

```javascript
const cellC2$ = cellA2$.combineLatest(cellB2$)
					.map(cells => cells[0] + cells[1]);

cellC2$.subscribe(value => {
	console.log(value);
});
```

## 1.1: Core Reactive Concepts

**Core Concept 1: Pull model vs Push model**

- any data sitting there that you "ask" for at some point
	- example refresh button 
	- manual button trigger
	- time interval
- observable (stream) which is a reactive data source - produces items over a period of time that will either error, complete, or never complete until a page closes
	- not telling the stream when to get data, it has inbuilt logic on how to get data
	- we may transform this data 
	- the display of the data is actually part of the description

An an example for a `pull` based code, we can think of a window.setInterval() that fires every 5000 seconds.

An example of a push would be to have a function fire and then the return continutes to filter, flatMap, map and subscribe.

**Core Concept 2: Everything is a database**

- mouse movements 
- current user 
- web requests 
- input boxes 

## 1.2: Comparing the Autocomplete function using JS vs RxJS

In the comparison where the `$title.on('keyup', () => {})` runs with a promise returned. The query can run into race conditions.

Also note that every single result also fires.

The issues:
```
// Fix up and down arrow
// Stop always querying 
// Getting race condition
```

**Bad ways**
- generally `if last query == currentTitle return`
- using setTimeout to reduce number of queries
- Race condition still happening, but bad attempts may be increasing the timeout
	- Could also use a current id compared to next query id and then returning before the callback occurs
- A lot of state across the module being changed

**The Rx way**
```javascript
// npm install rxjs-es for es6
import $ from 'jquery';
import Rx from 'rxjs/Rx';

const $title = $('#title');
const $results = $('#results');

const keyUps$ = Rx.Observable.fromEvent($title, "keyup");
const queries$ = keyUps$
	.map(e => e.target.value)
	.distinctUntilChanged()
	.debounceTime(250)
	.switchMap(getItems);	// similar to merge, but if new query comes in, discard the old data
	//.mergeMap(getItems);	// alias for flatMap

queries$.subscribe(query => {
	// get rid of the promise will stop race condition
	$results.empty();
	$results.append(items.map( r => $(`<li />`).text(r)));
})

<!-- queries$.subscribe(query => {
	console.log(e); // prints out event
	getItems(query)
		.then(items => {
			$results.empty();
			$results.append(items.map( r => $(`<li />`).text(r)));
		});
}) -->
```

An even better way.

```javascript
import $ from 'jquery';
import Rx from 'rxjs/Rx';

const $title = $('#title');
const $results = $('#results');

Rx.Observable.fromEvent($title, "keyup")
	.map(e => e.target.value)
	.distinctUntilChanged()
	.debounceTime(500)
	.switchMap(getItems)
	.subscribe(items => {
		$results.empty();
		$results.append(items.map(r => $(`<li />`).text(r)));
	});
```

- All the Rx has no external state, whereas the other code does.
- Rx doesn't have to wait for us to tell it when to do it.

***

## 3: The Core of Reactive Extensions

## 3.1: Obervables, Operators and Subscriptions 

- Observable: Something that can be observed which produces values 
- Operator: It's an operation that modifies the data being pushed in from the observable
	- They don't produce values in and of themselves, but move them through the pipeline.
- Subscriptions: Piece of code that will do something with the values returned by the operators

Note, you can model anything in a reactive context by thinking a little bit differently.

**Web API Request Example**

- Reactive can still complete, or it can error out and retry.

## 3.2 Creating Observables 

```javascript
import Rx from 'rxjs/Rx';

# promise will always execute - not lazy
const promise = new Promise((resolve, reject) => {
	console.log("In promise");
	resolve("hey");
});

promise.then(item => console.log(item));

# this doesn't give any output!
# observables are lazy!
# won't run without a subscription
const simple$ = new Rx.Observable(observer => {
	console.log("Generating observable");
	setTimeout(() => {
		observer.next("An items!");
		setTimeout(() => {
			observer.next("Another item!");
			observer.complete();
		}, 1000);
	}, 1000);
});

# creating a subscription
# first arg is the next function
# second arg is error 
# third arg is complete
simple$.subscribe(
	item => console.log(`one.next ${item}`),
	error => console.log(`one.error ${item}`),
	() => console.log("one.complete")
);

# Generating observable 
# one.next An item!
# one.next Another item! 
# one.complete

setTimeout(() => {
	simple$.subscribe({
		next: item => console.log(`two.next ${item}`),
		error: error => console.log(`two.error ${item}`),
		complete: () => console.log("two.complete")
	});
}, 3000)
```

- Re-subscribing to an observable allows you to run that generator again

```
function createInterval(time) {
	return new Rx.Observable(observer => {
		let index = 0;
		let interval = setInterval(() => {
			observer.next(index++);
		}, time);

		return () => {
			// will run when we unsubscribe
			clearnInterval(interval);
		};
	});
}

function createSubscriber(tag) {
	return {
		next(item) { console.log(`${tag}.next ${item}`); },
		error(error) { console.log(`${tag}.error ${error.stack || error }`); },
		complete() { console.log(`${tag}.complete`); }
	};
}

function take(observable, amount) {
	return new Rx.Observable(observer => {

	});
}

// this is the core of subscriptions
function take(sourceObservable, amount) {
	return new Rx.Observable(observer => {
		let count = 0;
		const subscription = sourceObservable.subscribe({
			next(item) { 
				observer.next(item);
				if (++count >= amount) {
					observer.complete();
				}
			},
			error(error) { observer.error(error); },
			complete() { observer.complete(); }
		});

		return () => subscription.unsubscribe();
	});
}

const everySecond_ = createInterval(1000);
const firstFiveSeconds = take(everySecond_, 5);
const subscription = everySecond_.subscribe(createSubscriber("one"));
setTimeout(() => {
	subscription.unsubscribe();
}, 3500);
```

This subscription will console.log out forever and ever and ever...
	- unless, we dispose of a description

How do operators come into play?

We could run something like `const subscription = everySecond_.take(3)subscribe(createSubscriber("one"));`

The steps for it are that it listens for a source and emits a transformation!

