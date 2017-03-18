# Angular 2 Basics

You can not just use Angular for web apps, but also iOS and Java using Native kit.

## Why Angular?

- it's Modular 
	- in previous versions, you needed the entire Angular framework loaded
- uses TypeScript, it uses static typing
- Google has hundreds of internal applications using Angular 
- large community of developers 

Angular JS refers to version 1, whereas Angular refers to version 2.

## The Parts and Pieces of an Angular Application

**How does it work?**

- App requires one `root` component
- The app requires services, components and 3rd party modules
	- Services can be internal or part of 3rd party modules

- `Services`: used to perform things like long running calcs or running web requests.
- `Components`: Broken down components/elements 
- `NgModule`: This is like a container for the application
	- `Ng` is the namespace Angular adopted

You can use `Typescript`, `Javascript` or `Dart` with Angular2.

## Typescript 

Angular is the first large framework to adopt `Typescript`. The idea is to keep you in the editor.

We can use Typescript to help enforce static typing.

`Intellisense` is also used as helping autocompletion intelligence when coding and certain styles of coding allow for this.

Eg. code:

```javascript 
// example 1 

class Greeter{
	greet(name: string) {
		console.log(name);
	}
}

const greeter = new Greeter();

greeter.greet('Jim');

// example 2

function rollCall(students: any[], max?: number) {
	max = max || students.length;
	const attendance = students.slice(undefined, max);
	console.log(attendence);
}
```

## The First Angular Application

As you build out your `index.html` file you set a `<app-root>` component as the target for Angular2 entry point.

Within `src/app` create `app.module.ts` as the root module.

```javascript
/* in app.modules.ts */

// note the @ is to do with npm supporting namespace modules
// this allows code to be shared between packages 
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

// create the AppModule 
// export for use in main.ts 
// add the decorator to post-process it
// the decorator is used by angular to compose the app 
// in the most efficient way possible
@NgModule({
	// using BrowserModule lets Angular know this is 
	// for web use
	imports: [BrowserModule]
})
export class AppModule {
	
}

/* in main.ts */
import './styles/main.css';
import { platformBrowser } from '@angular/platform-browser-dynamic';
```












