# Intro to Flux

3 Components:

1. Dispatcher
2. Stores
3. Views

Controllers do exist in a Flux application, but they are controller-views.

Action creators — dispatcher helper methods — are used to support a semantic API that describes all changes that are possible in the application. It can be useful to think of them as a fourth part of the Flux update cycle.

** The Flow **

```
Action -> Dispatcher -> Store -> View 
```
