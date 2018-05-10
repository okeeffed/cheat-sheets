# Animations in React

<!-- TOC -->

*   [Animations in React](#animations-in-react)
*   [REACTAN-1: Installation](#reactan-1-installation)
*   [REACTAN-2: Using CSS to now run the Transitions and Transforms](#reactan-2-using-css-to-now-run-the-transitions-and-transforms)

<!-- /TOC -->

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
	transitionAppear={true} // transition for the ReactCSSTransitionGroup component
	transitionAppearTimeout={500} // time for is
	>
	{ list }
</ReactCSSTransitionGroup>
```

# REACTAN-2: Using CSS to now run the Transitions and Transforms

```
// in the css file

/* start enter state */
.slide-enter {
	transform: translateX(-100%);
}

/* end enter state */
.slide-enter.slide-enter-active {
	transform: translateX(0);
	transition: transform 0.5s ease-out;
}

/* start leave state */
.slide-leave {
	transform: translateX(0);
}

/* end leave state */
.slide-leave.slide-leave-active {
	transform: translateX(-100%);
	opacity: 0;
	transition: 0.5s ease-in;
}

/* initial mounting */
.slide-appear {
	opacity: 0;
}

.slide-appear.slide-appear-active {
	opacity: 1;
	transition: opacity 0.5s ease-in;
}
```
