# Flux Help Sheet

__Sources__

[Scotch.io](https://scotch.io/tutorials/getting-to-know-flux-the-react-js-architecture)

## FLUX-1: What is Flux?

Flux is an architecture that Facebook uses internally when working with React. It is not a framework or a library. It is simply a new kind of architecture that complements React and the concept of Unidirectional Data Flow.

That said, Facebook does provide a repo that includes a Dispatcher library. The dispatcher is a sort of global pub/sub handler that broadcasts payloads to registered callbacks.

__3 Components__

1. Actions – Helper methods that facilitate passing data to the Dispatcher
2. Dispatcher – Receives actions and broadcasts payloads to registered callbacks
3. Stores – Containers for application state & logic that have callbacks registered to the dispatcher
4. Controller Views – React Components that grab the state from Stores and pass it down via props to child components

Flux helps to solve some of the difficulty we run into with unidirectional data flow when it comes to changing Application State that is higher up the virtual DOM than the Components that alter that State themselves.

Controllers do exist in a Flux application, but they are controller-views.

Action creators — dispatcher helper methods — are used to support a semantic API that describes all changes that are possible in the application. It can be useful to think of them as a fourth part of the Flux update cycle.

__The graphical process__

<img src="https://cask.scotch.io/2014/10/V70cSEC.png" />

__How does the API relate to this?__

When you are working with data that is coming from (or going to) the outside, I’ve found that using Actions to introduce the data into the Flux Flow, and subsequently Stores, is the most painless way to go about it.

***

## FLUX-2: The Dispatcher
