# Animations in React

# REACTAN-1: Installation

React Transistions can be done use the `ReactCSSTransitionGroup`.

Since React uses the virtual DOM, we don't get a chance to directly apply a CSS transition like you normally would with jQuery or JS.

To install: `yarn add react-addons-css-transition-group`

In the JS file:

```
// within some component
...
import ReactCSSTransitionGroup from 'react-addons-css-transition-group';
...

class Transition extends Component {
	
	...

	render() {
		return {
			<ReactCSSTransitionGroup>
				{ list }
			</ReactCSSTransitionGroup>
		}
	}
}
```

By default, <ReactCSSTransitionGroup> renders as a `span`, but we can give it a `component` property to change it! E.g. `<ReactCSSTransitionGroup component="ul">`

To access the property for animations, we need to set a property of `transitionName`.

E.g. `<ReactCSSTransitionGroup component="ul" transitionName="slide">`

There are a couple of other noteworthy properties:

```
<ReactCSSTransitionGroup
	component="ul"
	transitionName="slide"
	transitionEnterTimeout={500} // this is for the duration of the transition in ms
	transitionLeaveTimeout={500} // transition for leaving the DOM
	>
	{ list }
</ReactCSSTransitionGroup>
```

# REACTAN-2: Using CSS to now run the Transitions and Transforms