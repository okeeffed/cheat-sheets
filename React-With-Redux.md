# React with Redux

## REDUX-1: Modelling Application State

Inherently difficult in terms of the concept.

Redux is just the start of a bunch of different technologies. You need to understand the core concepts of it.

__What is Redux?__

Consider the structure of an application on the view layer and the data layer.

Where does Redux come into this? Redux is like the data, while React is the views. A state container is essentially the data.

This doesn't look too different to the others, but here we put all the data into a single collection. This is different to other Frameworks. Redux centralises all the data in the "state". Redux state is Application state as opposed to Component state.

Think of a +/- button state that displays the current count.

If we think about this, the data contained is the current count, while the views are the current count value and the +/- buttons.

Redux is going to keep track of the counter. It tells the components how and what they should render.

__Modelling an App__

Designing the state is the critical part of Redux.

Let's model Tinder!

In data, we need to model a few things.

1. The swiping screen. The list of the users not reviewed, and the view of the current user.
2. The conversation screen. List of all current convos.
3. The actual conversation screen itself.
4. List of all the users in general.

Controller Views

1. Image Card
2. Like/Dislike buttons
3. ConversationList
4. TextItem (individual message)
5. TextList (list of chat messages)
