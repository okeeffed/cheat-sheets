# RxJS

<!-- TOC -->

*   [RxJS](#rxjs)
    *   [1.0 A Brief Recap of Programming Paradigms](#10-a-brief-recap-of-programming-paradigms)
    *   [1.1: Core Reactive Concepts](#11-core-reactive-concepts)
    *   [1.2: Comparing the Autocomplete function using JS vs RxJS](#12-comparing-the-autocomplete-function-using-js-vs-rxjs)
    *   [3: The Core of Reactive Extensions](#3-the-core-of-reactive-extensions)
    *   [3.1: Obervables, Operators and Subscriptions](#31-obervables-operators-and-subscriptions)
    *   [3.2 Creating Observables](#32-creating-observables)
    *   [3.3: Built in Observables](#33-built-in-observables)
    *   [3.4: Using RxJS with Node, jQuery and Promises](#34-using-rxjs-with-node-jquery-and-promises)
    *   [3.5: Subjects](#35-subjects)
    *   [3.6: RxJS Resources and Documentation](#36-rxjs-resources-and-documentation)
    *   [3.7: Sharing Observable Sequences](#37-sharing-observable-sequences)
    *   [4.0: Operators that everyone should know](#40-operators-that-everyone-should-know)
    *   [4.1: Do / Finally / StartWith / Filter](#41-do--finally--startwith--filter)
    *   [4.2: Merge / Concat](#42-merge--concat)
    *   [4.3: Map / MergeMap / SwitchMap](#43-map--mergemap--switchmap)
    *   [4.4: Reduce / Scan](#44-reduce--scan)
    *   [4.5: Buffer / ToArray](#45-buffer--toarray)
    *   [4.6: First / Last / Single / Skip / Take](#46-first--last--single--skip--take)
    *   [4.7: Zip / WithLatestFrom / CombineLatest](#47-zip--withlatestfrom--combinelatest)
    *   [4.8: Error Handling Catch and Retry](#48-error-handling-catch-and-retry)

<!-- /TOC -->

## 1.0 A Brief Recap of Programming Paradigms

**Procedural Program**

*   The ideas that programs are a sense of functions
*   Goes from top to bottom
*   Relies heavily on global state, but any line can change the global state
*   C being a procedural language
*   "Imperative" execution
*   Easy to write, difficult to maintain
*   Prone to difficult bugs

**Object Oriented**

*   Based around a Primitive: object
*   Objects have well defined interfaces
*   Localised behaviour
*   Objects control state
*   Composition
*   Code is still imperative - pro AND con! - Still telling the computer EXACTLY what to do.
*   Can be more verbose

**Declarative**

*   Describing what you want to happen, but not telling the computer how to do it
*   Eg. SQL, Regex, HTML
*   Data is self-describing
*   As powerful as the interpreter allows
*   As limiting as the interpreter allows - You want build a game in SQL etc.

**Functional**

*   What we want to happen but not how
*   Little state
*   Few side effects
*   Easy to reason about
*   Composition
*   Expressive
*   Works great with OO
*   Basis in higher math
*   Cons to think differently
*   Not always the best choice
*   No loops, no control logic - Just telling it what we want to happen

**Reactive**

*   Primitive: Observable
*   Instead of describing data in terms of other data, we describe it in terms of streams of events - From this, we create a pipeline such that we certain data changes, a lot is processed and changed - Example: spreadsheets!
*   Composition
*   Expressive
*   Data flows unidirectionally
*   Tough to think differently
*   Subscriptions help change the data

```javascript
const cellC2$ = cellA2$
    .combineLatest(cellB2$)
    .map((cells) => cells[0] + cells[1]);

cellC2$.subscribe((value) => {
    console.log(value);
});
```

## 1.1: Core Reactive Concepts

**Core Concept 1: Pull model vs Push model**

*   any data sitting there that you "ask" for at some point - example refresh button - manual button trigger - time interval
*   observable (stream) which is a reactive data source - produces items over a period of time that will either error, complete, or never complete until a page closes - not telling the stream when to get data, it has inbuilt logic on how to get data - we may transform this data - the display of the data is actually part of the description

An example for a `pull` based code, we can think of a `window.setInterval()` that fires every 5000 seconds.

An example of a push would be to have a function fire and then the return continues to `filter`, `flatMap`, `map` and `subscribe`.

**Core Concept 2: Everything is a database**

*   mouse movements
*   current user
*   web requests
*   input boxes

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

*   generally `if last query == currentTitle return`
*   using setTimeout to reduce number of queries
*   Race condition still happening, but bad attempts may be increasing the timeout - Could also use a current id compared to next query id and then returning before the callback occurs
*   A lot of state across the module being changed

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

Rx.Observable.fromEvent($title, 'keyup')
    .map((e) => e.target.value)
    .distinctUntilChanged()
    .debounceTime(500)
    .switchMap(getItems)
    .subscribe((items) => {
        $results.empty();
        $results.append(items.map((r) => $(`<li />`).text(r)));
    });
```

*   All the Rx has no external state, whereas the other code does.
*   Rx doesn't have to wait for us to tell it when to do it.

---

## 3: The Core of Reactive Extensions

## 3.1: Obervables, Operators and Subscriptions

*   Observable: Something that can be observed which produces values
*   Operator: It's an operation that modifies the data being pushed in from the observable - They don't produce values in and of themselves, but move them through the pipeline.
*   Subscriptions: Piece of code that will do something with the values returned by the operators

Note, you can model anything in a reactive context by thinking a little bit differently.

**Web API Request Example**

*   Reactive can still complete, or it can error out and retry.

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

*   Re-subscribing to an observable allows you to run that generator again

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

This subscription will console.log out forever and ever and ever... - unless, we dispose of a description

How do operators come into play?

We could run something like `const subscription = everySecond_.take(3)subscribe(createSubscriber("one"));`

The steps for it are that it listens for a source and emits a transformation!

## 3.3: Built in Observables

```javascript
import Rx from 'rxjs/Rx';


Rx.Observable.interval(500)
	.take(5)
	.subscribe(createSubscriber("interval"));

Rx.Observable.timer(1000, 500)
	.take(3)
	.subscribe(createSubscriber("timer");

// note, array doesn't work - use from
Rx.Observable.of("Hello world!", 42, "whoa")
	.subscribe(createSubscriber("of"));

Rx.Observable.from(["Hello world!", 42, "whoa"])
	.subscribe(createSubscriber("of"));

Rx.Observable.from(generate())
	.subscribe(createSubscriber("of"));


Rx.Observable.from("hello world!")
	.subscribe(createSubscriber("of"));

// it can also take in a generator function!

function* generate() {
	yield 1;
	yield 5;
	yield "HEY";
}

Rx.Observable.throw(new Error("Hey"))
	.subscribe(createSubscriber("error"));

// empty
Rx.Observable.empty()
	.subscribe(createSubscriber("empty"));

// defer
let sideEffect = 0;
const defer = Rx.Observable.defer(() => {
	sideEffect++;
	return Rx.Obserable.of(sideEffect);
});

defer.subscribe(createSubscriber("defer.one"));
defer.subscribe(createSubscriber("defer.two"));
defer.subscribe(createSubscriber("defer.three"));

Rx.Observable.never()
	.subscribe(createSubscriber("never"));

Rx.Observable.range(10, 30)
	.subscribe(createSubscriber("range"));
```

Benefits of the iterable `from`?

*   For every iterable, we could map every element.

## 3.4: Using RxJS with Node, jQuery and Promises

```javascript
Rx.Observable.fromEvent($title, 'keyup')
    .map((e) => e.target.value)
    .distinctUntilChanged()
    .debounceTime(500)
    .switchMap(getItems)
    .subscribe((items) => {
        $results.empty();
        $results.append(items.map((i) => $('<li />').text(i)));
    });
```

NOTE: Without the subscribe, it will never be subscribed to the dom!

If we have the `.take(10)` - it would complete after taking 10 and then furthermore unsubscribe and be great for performance!

`fromEvent` calls from `addEventListener`, so it can do powerful things like `keyup` for those that don't initially support it.

```javascript
import fs from 'fs';

fs.readdir('./src/server', (err, items) => {
    if (err) console.log(err);
    else {
        console.log(items);
    }
});

// alternative
const readdir = Rx.Observable.bindNodeCallBack(fs.readdir);

readdir('./src/server')
    // mergeMap creates iterable converted from array
    .mergeMap((files) => Rx.Observable.from(files))
    .map((file) => `MANIPULATED ${file}`)
    .subscribe(createSubscriber('readdir'));

// promises

function getItem() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve('Hello');
        }, 1000);
    });
}

Rx.Observable.fromPromise(getItem()).subscribe(createSubscriber('promise'));
```

## 3.5: Subjects

Subjects are another Rx primitive. They are both an observable and a observer! Used to bridge non-reactive code with reactive code.

Behaviour, replay subjects etc.

_Warning_: you should only really consider them as a last resort when bridging non-reactive and reactive code.

```javascript
const simple = new Rx.Subject();

simple.subscribe(createSubscriber('simple'));

simple.next('Hello');
simple.next('World');
simple.complete();

const interval = Rx.Observable.interval(1000).take(5);
const intervalSubject = new Rx.Subject();
intervalSubject.subscribe(interval);

intervalSubject.subscribe(createSubscriber('sub1'));
intervalSubject.subscribe(createSubscriber('sub2'));
intervalSubject.subscribe(createSubscriber('sub3'));

// subscribes after three seconds
setTimeout(() => {
    intervalSubject.subscribe(createSubscriber('LOOK AT ME'));
}, 3000);
```

Before, we had to invoke a function that call `next` and `complete`.

In the above example, intervalSubject is acting as a proxy to another observable.

```javascript
// needs init state parameter
const currentUser = new Rx.BehaviorSubject({ isLoggedIn: false });
const isLoggedIn = currentUser.map((u) => u.isLoggedIn);

currentUser.next({ isLoggedIn: false });
isLoggedIn.subscribe(createSubscriber('isLoggedIn'));

setTimeout(() => {
    currentUser.next({ isLoggedIn: true, name: 'nelson' });
}, 3000);

setTimeout(() => {
    isLogged.subscribe(createSubscription('delayed'));
}, 1500);
```

How do you remember multiple states?

```javascript
const replay = new Rx.ReplaySubject(3);
replay.next(1);
replay.next(2);

replay.subscribe(createSubscriber("one"));

replay.next(3);
replay.next(4);
replay.next(5);

// this subscription only gets the previous three items
replay.subscribe(createSubscriber("two"));

replay.next(6);

// what you see
one.next 1
one.next 2
one.next 3  
one.next 4  
one.next 5  
two.next 3
two.next 4
two.next 5
one.next 6
two.next 6
```

**Async Subjects**

```
const apiCall = new Rx.AsyncSubject();
apiCall.next(1);

apiCall.subscribe(createSubscriber("one"));
apiCall.next(2);

// only will emit the final item before it is complete
apiCall.complete();

// if you subscribe to it again, that final value will be emitted
setTimeout(() => {
	apiCall.subscribe(createSubscriber("two"));
}, 2000);

// output
one.next 2
one.complete
two.next 2
two.complete
```

**Subject Summary**

*   if you can get around it, don't use subjects unless you have to
*   you should use an observable workflow where possible

## 3.6: RxJS Resources and Documentation

Sources:

*   [RxJS Github](https://github.com/ReactiveX/rxjs)
*   [RxMarbles](http://rxmarbles.com/)
*   [RxVision Playground](http://jaredforsyth.com/rxvision/examples/playground/)

## 3.7: Sharing Observable Sequences

*   Hot Observable: It will produce events regardless of if you're listening - eg.`fromEvent($title, 'keyup')`
*   Cold Obserable: Starts once you subscribe - Interval Observables are actually cold observables

```javascript
// this example shows when both start from the beginning eg cold
import Rx from 'rxjs/Rx';

const interval = Rx.Observable.interval(1000).take(10);

setTimeout(() => {
    interval.subscribe(createSubscriber('one'));
}, 1200);

setTimeout(() => {
    interval.subscribe(createSubscriber('two'));
}, 3200);

// HOT
// connectable observable
import Rx from 'rxjs/Rx';

const interval = Rx.Observable.interval(1000)
    .take(10)
    .publish();

interval.connect();

setTimeout(() => {
    interval.subscribe(createSubscriber('one'));
}, 1200);

setTimeout(() => {
    interval.subscribe(createSubscriber('two'));
}, 3200);

// if you connect after a set interval, then it begins executing and sharing the underlying observable
```

**Why would you want a hot variable?**

```javascript
// here subscribe console.log runs twice
const socket = { on: () => {} };
const chatMessage = new Rx.Observable((observable) => {
    console.log('subscribed');
    socket.on('chat:message', (message) => observer.next(message));
});

chatMessage.subscribe(createSubscriber('one'));
chatMessage.subscribe(createSubscriber('two'));

// without it

const socket = { on: () => {} };
const chatMessage = new Rx.Observable((observable) => {
    console.log('subscribed');
    socket.on('chat:message', (message) => observer.next(message));
}).publish();

chatMessage.connect();

chatMessage.subscribe(createSubscriber('one'));
chatMessage.subscribe(createSubscriber('two'));

// using publishLast()
const simple = new Rx.Observable((observer) => {
    observer.next('one');
    observer.next('two');
    observer.complete();
});

// always returns the last value
const published = simple.publishLast();

// even if we subscribe before connect, both will get the last value
published.subscribe(createSubscriber('one'));
published.connect();
published.subscribe(creaSubscriber('two'));

// using publishReplay()
const simple = new Rx.Observable((observer) => {
    observer.next('one');
    observer.next('two');
    observer.next('three');

    return () => console.log('Disposed');
});

// always returns the last value
const published = simple.publishReplay(2);

// even if we subscribe before connect, both will get the last value
// to dispose without running complete, we need to disconnect by unsubscribing
const sub1 = published.subscribe(createSubscriber('one'));
const connection = published.connect();
const sub2 = published.subscribe(creaSubscriber('two'));

sub1.unsubscribe();
sub2.unsubscribe();

connection.unsubscribe();
```

Refcount is a way to automatically handle the connection and the unsubscription of a connection observable.

It will connect to the first subscription and then disconnected on the last unsubscribe.

```
// using refCount()
const simple = new Rx.Observable(observer => {
	observer.next("one");
	observer.next("two");
	observer.next("three");

	return () => console.log("Disposed");
});

// always returns the last value
const published = simple.publishReplay(2).refCount();

// even if we subscribe before connect, both will get the last value
// to dispose without running complete, we need to disconnect by unsubscribing
const sub1 = published.subscribe(createSubscriber("one"));
const sub2 = published.subscribe(creaSubscriber("two"));

sub1.unsubscribe();
sub2.unsubscribe();
```

The `publish().refCount()` is done so often, that is has been turned in `share()`.

Taxing processes that you don't want to repeat but you want multiple things to hook into the result, then turn it into a hot subscription.

---

## 4.0: Operators that everyone should know

Now we will just talk about the different primary operators that you will work with.

## 4.1: Do / Finally / StartWith / Filter

```javascript
// do => get the next value and pass it back unchanged
// finally => only completes after the range has completed, runs right at the end of the final value
// filter => filters out given statement
// interval => call timeout
// startWith => set initial value

Rx.Observable.range(1, 10)
    .do((a) => console.log(`From do ${a}`))
    .map((a) => a * a)
    .subscribe(createSubscriber('simple'));

Rx.Observable.range(1, 10)
    .finally(() => console.log(`From finally`))
    .map((a) => a * 2)
    .subscribe(createSubscriber('finally'));

Rx.Observable.range(1, 10)
    .filter((a) => a < 5)
    .map((a) => a * 2)
    .subscribe(createSubscriber('filter'));

Rx.Observable.interval(1000)
    .startWith(-1)
    .subscribe(createSubscriber('interval'));
```

## 4.2: Merge / Concat

```javascript
// merge - merge many observables togethers
// concat - this concatenates observables to the end of another, can also take a list of Observables

Rx.Observable.interval(1000)
	.merge(Rx.Observable.interval(500))
	.take(5)
	.subscribe(createSubscriber("merge1"));

Rx.Observable.merge(
	Rx.Observable.interval(1000).map(i => `${i} seconds),
	Rx.Observable.interval(500).map(i => `${i} half seconds))
	.take(5)
	.subscribe(createSubscriber('merge2'));

// different events for merged observables
Rx.Observable.merge(
	socket.on$("login").map(user => processUser(user),
	socket.on$("logout").map(() => null));

Rx.Observable.range(1, 5)
	.concat(Rx.Observable.range(10,3))
	.subscribe(createSubscriber("concat1"));
```

## 4.3: Map / MergeMap / SwitchMap

```javascript
// map - a projection on every item that comes in
// mergeMap - select many, does projection and then has another thing that we will work on
// switchMap - similar to mergeMap but replaces with the latest value if another emission comes in

function arrayMap(arr, proj) {
    let returnArray = [];
    for (let i of arr) {
        returnArray.push(proj(item));
    }

    return returnArray;
}

arrayMap([1, 2, 3], (a) => a * a);

// imagine array of dicts
const albums = [{}, {}];

function arrayMergeMap(arr, proj) {
    let returnArray = [];
    for (let i of arr) {
        let projArray = proj(item);
        for (let j of projArray) {
            returnArray.push(proj(item));
        }
    }

    return returnArray;
}

const tracks = arrayMergeMap(albums, (album) => album.tracks);

Rx.Observable.range(1, 3)
    .mergeMap((i) =>
        Rx.Observable.timer(i * 1000).map(() => `After ${i} seconds`)
    )
    .subscribe(createSubscriber('mergeMap'));

Rx.Observable.fromPromise(getTracks())
    .mergeMap((tracks) => Rx.Observable.from(tracks))
    .subscribe(createSubscriber('tracks'));

function getTracks() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(['track 1', 'track 2', 'track 3']);
        }, 1000);
    });
}

// synchronous example
Rx.Observable.of('my query')
    .do(() => console.log('Querying'))
    .mergeMap((a) => query(a))
    .do(() => console.log('After querying'))
    .subscribe(createSubscriber('query'));

function query(value) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve('This is the resolved value');
        }, 1000);
    });
}

// switch map
```

## 4.4: Reduce / Scan

```javascript
// reducer (acc, value) and works on value - doesn't emit until the completion
// scan - processes and emits as it comes in
Rx.Observable.range(1, 10)
    .reduce((acc, value) => acc + value)
    .subscribe(createSubscriber('reduce'));

Rx.Observable.range(1, 10)
    .scan((acc, value) => acc + value)
    .subscribe(createSubscriber('scan'));
```

## 4.5: Buffer / ToArray

There have been some big changes to how `buffer` has been used.

Buffer takes in an observable.

toArray will convert results into an array. - still has a clean exit if the never() is implemented!

```javascript
Rx.Observable.range(1, 100)
	.bufferCount(25)
	.subscribe(createSubscriber("items");

// will take 25 items and pushing them into an array


Rx.Observable.interval(500)
	.bufferTime(2000)
	.subscribe(createSubscriber("bufferTime");

// same behaviour!
// emitting event causes buffer to flush
Rx.Observable.interval(500)
	.buffer(Rx.Observable.interval(2000))
	.subscribe(createSubscriber("buffer");

//
// toArray
//

Rx.Observable.range(1, 10)
	.toArray()
	.subscribe(createSubscriber("range"));
```

## 4.6: First / Last / Single / Skip / Take

```javascript
const simple = new Rx.Observable((observer) => {
    console.log('Generating sequence');
    observer.next(1);
    observer.next(2);
    observer.next(3);
    observer.next(4);
    observer.complete();
});

simple.first().subscribe(createSubscriber('first'));

simple.last().subscribe(createSubscriber('last'));

// displays 1 & 4
// if nothing is in there, there are EmptyError(s) thrown

// single.error thrown is more than one error thrown
simple.single().subscribe(createSubscriber('single'));

// take and skip won't throw errors
// take does the first however emissions
// skip will take the emissions after a number
simple.take(2).subscribe(createSubscriber('take'));

simple.skip(2).subscribe(createSubscriber('skip'));

// 3, 4
simple
    .skip(2)
    .take(2)
    .subscribe(createSubscriber('skip'));

// skipWhile / takeWhile
Rx.Observable.interval(500)
    .skipWhile((i) => i < 4)
    .takeWhile((i) => i < 10)
    .subscribe(createSubscriber('skipWhile/takeWhile'));

// what's until and take emissions until
Rx.Observable.interval(500)
    .skipUntil(Rx.Observable.timer(1000))
    .takeUntil(Rx.Observable.timer(4000))
    .subscribe(createSubscriber('skipUntil'));
```

## 4.7: Zip / WithLatestFrom / CombineLatest

How can we combine observables in different ways?

```javascript
function arrayZip(arr1, arr2, selectorFunc) {
    const count = Math.min(arr1.length, arr2.length);
    const results = [];

    for (let i = 0; i < count; i++) {
        const combined = selector(arr1[i], arr2[i]);
        results.push(combined);
    }

    return results;
}

const arr1 = [32, 2, 52, 43, 54];
const arr2 = [1, 0, 10, 4, 1, 4, 6, 2];
const results = arrayZip(arr1, arr2, (left, right) => left * right);

console.log(results);

// in RxJS
Rx.Observable.range(1.1)
    .zip(
        Rx.Observable.interval(500),
        (left, right) => `item: ${left}, at ${right * 500}`
    )
    .subscribe(createSubscriber('zip'));

// emits value when source emits
// can also pass (left, right) function like zip as second parameter
Rx.Observable.interval(1000)
    .withLatestFrom(Rx.Observable.interval(500))
    .subscribe(createSubscriber('withLatestFrom'));

// emit value if either do
Rx.Observable.interval(1000)
    .combineLatest(Rx.Observable.interval(500))
    .subscribe(createSubscriber('withLatestFrom'));
```

## 4.8: Error Handling Catch and Retry

If an error happens, an observer stops emitting and can prevent values from emitting at all. Error handling is very important!

`.catch(error => Rx.Observable.of(error))` can pass this down as an Observable.

`.retry()` we can pass in with a numeral to ensure that we either keep retrying or retry a certain number of times.
