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

function rollCall(students: any[], max) {
	max = max || students.length;
}


```
