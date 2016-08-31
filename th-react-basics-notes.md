# TH React Basics Notes

## First Steps in React

#### Why React

React is a library for creating UIs.

Two huge benefits:

1. It's declarative
2. It's component based

**Components**

UI Composed of divs, spans, inputs and others.

React allows us to build our own components and use them as built in HTML elements.

Tested once, reused everywhere.

**Declarative**

This means our program describes what we are doing.

JS is normally imperative, whereas something like HTML is declarative.

Normally, we would have a data model with JS and then the view made up with HTML. This is hard to keep in sync.

Example, if the second item in the data model is removed, then we would also need to remove a second list item in HTML.

React makes an efficient and fast way to "remove a DOM and reload". This is done by using a *Virtual DOM*

#### State and the Virtual DOM

We describe the application entirely in the .js files.

The JS representation of the DOM is referred to as the Virtual DOM. This is cheap and fast to use.

Interacting with the DOM is a lot slower than manipulating JavaScript.

When we write our React markup code, React takes on the responsibility of rendering the real DOM element on the Virtual DOM we define.

It's smart to remember the previous and current DOM and makes the minimum changes needed.

#### Understanding JSX

DOM Elements have:
1. The name eg. div, span
2. A list of attribtues -> key, value pairs eg href="value"
3. It may or may not have children

To describe an <a> tag, we use all three:

```javascript
React.createElement('a', {
	href: "https://abc.com"
}, "abc");
```

However, it is not convenient to do this call. This is where JSX comes in.

So the above is equivalent to...

```javascript
const myLink = (<a href="https://abc.com">abc</a>);
```

The compiler that we change JSX to what we need is Babel.

#### First Application

app.css
app.jsx
index.html

**index.html**
```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="./app.css" />
  </head>

  <body>
    <div id="container">Loading...</div>
    <script src="./vendor/react.js"></script>
    <script src="./vendor/react-dom.js"></script>
    <script src="./vendor/babel-browser.min.js"></script>
    <script type="text/babel" src="./app.jsx"></script>
  </body>
</html>
```
**app.jsx**
```javascript
function Application() {
	return(
		<div>
			<h1>Hello from React</h1>
			<p>I was rendered from the Application component</p>
		</div>
	);
}

ReactDOM.render(<h1>Hello</h1>, document.getElementById('container'));
```

Really, we want to create a component to render instead of individual components.

Components need to start with a capital as convention.

A react component must only return one DOM element.

**app.jsx**
```javascript
function Application() {
	return(
		<div>
			<h1>Hello from React</h1>
			<p>I was rendered from the Application component</p>
		</div>
	);
}

ReactDOM.render(<Application />, document.getElementById('container'));
```

#### React Developer Tools

It is a lot easier to debug with the React DevTools extension.

Download React Developer Tools. Available on both Chrome and Firefox.

This represents the virtual DOM.

React also highlights what is being inspected if you click on the React tab after highlighting the section you are looking for.

## Thinking in Components

#### Mocking up an App

It's best to mock up the application in JSX.

That way, we can apply some styles now.

- className in JSX is used to define a class
- in React JSX, it is customary to use double quotes
- if you need to evaluate a numeral, use {} instead of ""
- in the following example, we could copy and past the "player" div to have multiple players, however as you could image, this will be anti-DRY practise. We will eventually create another component for this!
- right now, the following code is static

```javascript
function Application() {
	return(
		<div className="scoreboard">
			<div className="header">
				<h1>Scoreboard</h1>
			</div>

			<div className="players">
				<div className="player">
					<div className="player-name">
						Dennis
					</div>
					<div className="player-score">
						<div className="counter">
							<button className="counter-action decrement"> - </button>
							<div className="counter-score"> 31 </div>
							<button className="counter-action increment"> + </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	)
}
```

#### Properties

The application so far is pretty useless. We can use properties to customise our components. We can then use the attribute syntax which is used to create the virtual DOM.

- we can allow our function to take an argument which will come from our reactDom.render function.
- props is the convention for argument named used
- anything with {} will be evaluated as plain old JavaScript 	
	- it MUST be an expression that brings back a value
	- at the moment, this means no conditional logic (if/else), we can see how to do this later!

```javascript
function Application(props) {
	return(
		<div className="scoreboard">
			<div className="header">
				<h1>{props.title}</h1>
			</div>

			<div className="players">
				<div className="player">
					<div className="player-name">
						Dennis
					</div>
					<div className="player-score">
						<div className="counter">
							<button className="counter-action decrement"> - </button>
							<div className="counter-score"> 31 </div>
							<button className="counter-action increment"> + </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	)
}

ReactDOM.render(<Application title="My Scoreboard"/>, document.getElementById('container'));
```

#### PropTypes and DefaultProps

PropTypes is an object that contains all the keys our object can take and a special type definition.
- if you place a numeral instead of a string, it will render, but it will cause a React error because PropTypes "title" is looking for a string
- we can use .isRequired to make a PropType property required
- we can set default values with .defaultProps if we want
- you can find a list of propTypes in the docs
	- propTypes aren't required, but can add more clarity
	- a defaultProps value is essentially redundant if propTypes has that same value as required, but it is left in this next code block for clarity (will be removed)

```javascript
function Application(props) {
	return(
		<div className="scoreboard">
			<div className="header">
				<h1>{props.title}</h1>
			</div>

			<div className="players">
				<div className="player">
					<div className="player-name">
						Dennis
					</div>
					<div className="player-score">
						<div className="counter">
							<button className="counter-action decrement"> - </button>
							<div className="counter-score"> 31 </div>
							<button className="counter-action increment"> + </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	)
}

Application.propTypes = {
	title: React.PropTypes.string.isRequired,
};

Application.defaultProps = {
	title: "Scoreboard",
};

ReactDOM.render(<Application title="My Scoreboard"/>, document.getElementById('container'));
```

#### Decomposing our Application

Breaking down our Application into smaller components.

To this is, we think of Application from a high level.
- In this example, we can set "isRequired" to Header.propTypes because the default will be passed down from the Application.propTypes
- The Player function is using JSX to replace my name and my score with props values
- **Note:** if you look into the React console, you should note that these functions we declare and render in the virtual DOM also come up as components. How handy for debugging!
- **Note:** if you look at the Counter function, it has been decomposed from Application -> Player -> Counter. The required props have been passed down. This is very common practise in React!
- How to break it down is up to you. Pros and cons for how modular you go.

```javascript
function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement"> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment"> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} />
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
}

function Application(props) {
	return(
		<div className="scoreboard">
			<Header title={props.title}/>

			<div className="players">
				<Player name="Dennis" score={32} />
				<Player name="Ben" score={34} />
			</div>
		</div>
	)
}

Application.propTypes = {
	title: React.PropTypes.string,
};

Application.defaultProps = {
	title: "Scoreboard",
};

ReactDOM.render(<Application title="My Scoreboard"/>, document.getElementById('container'));
```

#### Loops and Lists in JSX

Currently, we have two hard coded players, but we want to be able to loop through an array of this.

- Notice that Application.propTypes now requires an array of objects for the term players. We use shape to define exactly the properties of this object that we require.
- The JSX map function used to dynamically create players will return an array which in turn will be rendered as a list
- We use a "key" for each component in the loop to let the virtual DOM know which components are simply being rearranged or reordered so that we do not need to re-render more than we have to! (remember, the goal of React is to efficiently render the DOM)
	- The key must be unique for each DOM node
	- To see how the error would work, run this code but take out the "key" from the renderDOM function.

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement"> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment"> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} />
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
}

function Application(props) {
	return(
		<div className="scoreboard">
			<Header title={props.title}/>

			<div className="players">
				{props.players.map(function (player) {
					return <Player name={player.name} score{player.score} key={player.id} />
				})}
			</div>
		</div>
	)
}

Application.propTypes = {
	title: React.PropTypes.string,
	player: React.PropTypes.arrayOf(React.PropTypes.shape({
		name: React.PropTypes.string.isRequired,
		score: React.PropTypes.number.isRequired,
		id: React.PropTypes.number.isRequired,
	})).isRequired,
};

Application.defaultProps = {
	title: "Scoreboard",
};

ReactDOM.render(<Application players={PLAYERS}/>, document.getElementById('container'));
```

## Stateful Components

#### Creating a Component Class

Right now, our application is still static. We cannot update any data details.

We need to add some State. So far, we have been writing Stateless Function Components (SFC). This form isn't designed for handling state.

We need to build a component class, but this comes with complexity. Now we will refactor to reflect this.

- note, when create a object literal (or class in ECMA2015), you also must not forget to use the keyword "this"
	- eg. React.createClass is pre ECMA2015

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

// functionally the same, we are preparing to be able to add state to the component

var Counter = React.createClass({
	propTypes: {
		score: React.PropTypes.number.isRequired,
	},
	render: function() {
		return (
			<div className="counter">
				<button className="counter-action decrement"> - </button>
				<div className="counter-score"> {this.props.score }</div>
				<button className="counter-action increment"> + </button>
			</div>
		);
	}
});

// function Counter(props) {} - this can be removed

// Counter.propTypes = {} - this can be removed

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} />
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
}

function Application(props) {
	return(
		<div className="scoreboard">
			<Header title={props.title}/>

			<div className="players">
				{props.players.map(function (player) {
					return <Player name={player.name} score{player.score} key={player.id} />
				})}
			</div>
		</div>
	)
}

Application.propTypes = {
	title: React.PropTypes.string,
	player: React.PropTypes.arrayOf(React.PropTypes.shape({
		name: React.PropTypes.string.isRequired,
		score: React.PropTypes.number.isRequired,
		id: React.PropTypes.number.isRequired,
	})).isRequired,
};

Application.defaultProps = {
	title: "Scoreboard",
};

ReactDOM.render(<Application players={PLAYERS}/>, document.getElementById('container'));
```

#### Understanding State

Managing data that can change. React has a mechanism to deal with State. React doesn't provide everything, and you're encouraged to use other libraries to deal with things such as AJAX and State Management.

A popular design pattern used is Flux (what we will use). It is also recommended to use Redux which takes Flux a little bit further, however Flux and Redux are topics for another time.

After understanding state, it is recommended to use these other libraries to save time and work more effectively.

- After clicking on a button, the DOM will know to be re-rendered to show to correct State
- We need to the this.setState() function to let React know to re-render itself, this is why we don't just update the score!
- We use this.decrementScore in the onClick attribute, but not this.decrementScore.bind(this). React does this automatically for us in a high performance way.
- We have updated props to show an example if we want to pass props and then use them for an initial state.

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

// functionally the same, we are preparing to be able to add state to the component

var Counter = React.createClass({
	propTypes: {
		// this is no longer needed
		// score: React.PropTypes.number.isRequired,
		initialScore: React.PropTypes.number.isRequired
	},
	getInitialState: function() {
		return {
			score: this.props.initialScore,
		}
	},
	incrementScore: function(e) {
		// uncomment if you want to check out the event in the console
		// console.log("increment score", e);
		this.setState({
			score: (this.state.score + 1),
		})
	},
	decrementScore: function(e) {
		this.setState({
			score: (this.state.score - 1),
		})
	},
	render: function() {
		return (
			<div className="counter">
				<button className="counter-action decrement" onClick={this.decrementScore}> - </button>
				<div className="counter-score"> {this.state.score }</div>
				<button className="counter-action increment" onClick={this.incrementScore}> + </button>
			</div>
		);
	}
});

// function Counter(props) {} - this can be removed

// Counter.propTypes = {} - this can be removed

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter initialScore={props.score}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
}

function Application(props) {
	return(
		<div className="scoreboard">
			<Header title={props.title}/>

			<div className="players">
				{props.players.map(function (player) {
					return <Player name={player.name} score{player.score} key={player.id} />
				})}
			</div>
		</div>
	)
}

Application.propTypes = {
	title: React.PropTypes.string,
	player: React.PropTypes.arrayOf(React.PropTypes.shape({
		name: React.PropTypes.string.isRequired,
		score: React.PropTypes.number.isRequired,
		id: React.PropTypes.number.isRequired,
	})).isRequired,
};

Application.defaultProps = {
	title: "Scoreboard",
};

ReactDOM.render(<Application players={PLAYERS}/>, document.getElementById('container'));
```

## Designing Data Flow

#### Unidirectional Data Flow

It's cumbersome to maintain State when applications scale. We should think of State as the following:

1. Application State
2. Component State

Component state is normally not shared or visible outside of a component.

Application state should be handled as high up as possible. We can pass all the changes down using properties.

Because of the direction of data flow, parents don't call methods to change the values of children. Instead, they pass down new values to declare how the children should be re-rendered. (Back to the whole Declarative programming!)

This Parent passing down to Child is what we call Unidirectional Data Flow. If it changes at the top, it will cascade down the virtual DOM.

Since children cannot talk to parents, we can implement callback functions to update data. When a child wants to indicate a State should change, they will use the callback.

Currently, we have State in a number of places. We will change this to become more unidirectional.

#### Restructuring State

At the moment, we have one State. Our counter component. However, as useful as it has been to show how States work by using counter, the State of the counter is really a state of a Player Score.

We're going to relocate the state up to the Application.

- implement back the Counter function
- onClick handlers removed
- Application is going to become the stateful component

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement"> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment"> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
}

// function Application(props) {} - now this is removed
// props moved into the class

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},

	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title}/>

				<div className="players">
					{this.state.players.map(function (player) {
						return <Player name={player.name} score{player.score} key={player.id} />
					})}
				</div>
			</div>
		);
	}
});

// this is also removed
// Application.defaultProps = {
// 	title: "Scoreboard",
// };

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Communicating Events

We now need to implement these callback functions so that we can change our counter.

- reimplement the onClick function
- we add onChange functions to pass data up the tree
- at the Application level where player is called, we can call the function but we do need to .bind(this) for the particular instance since it is called on an array
- to know which player score to update, we use the map function's second parameter which will pass an index. This we can continue passing to let the function know which score to change.
	- AGAIN, MAKE SURE YOU BIND SINCE WE PASS AN ANON FUNC
- You can verify that the score is being tracked by the Application and not the Counter by inspecting this in the console and checking out the values of the Application.

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Header(props) {
	return (
		<div className="header">
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},

	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title}/>

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Building the Statistics Component

The problem with keeping the score locally is that if wanted to do something (eg show to total score) we wouldn't have had access to that.

Let's show that by creating some stats.

- When creating table elements, make sure you add in the tbody tag too! Otherwise, this will cause issues between the DOM and Virtual DOM.

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

function Stats(props) {
	// you don't have to store it, but it's handy for organisation
	var totalPlayers = props.players.length;
	var totalPoints = props.players.reduce(function(total, player){
		return total + player.score;
	}, 0)

	return (
		<table className="stats">
			<tbody>
				<tr>
					<td>Players:</td>
					<td>{totalPlayers}</td>
				</tr>
				<tr>
					<td>Total Points:</td>
					<td>{totalPoints}</td>
				</tr>
			</tbody>
		</table>
	);
}

Stats.propTypes = {
	players: React.PropTypes.array.isRequired,
};

function Header(props) {
	return (
		<div className="header">
			<Stats />
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},

	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title} players={this.state.players} />

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Adding Players to the Scoreboard

In React, States are our responsibility. What happens if we need to add players?

- form values need to be handled differently due to the unidirectional flow and re-rendering.
	- to update State, we need an onChange handler

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

var nextId = 4;

var AddPlayerForm = React.createClass({
	propTypes: {
		onAdd: React.PropTypes.func.isRequired,
	},
	getInitialState: function() {
		return {
			name: ""
		};
	},
	onNameChange: function(e) {
		// uncomment to see the changes on target value
		// console.log("onNameChange", e.target.value);
		this.setState({name: e.target.value});
	},
	onSubmit: function(e) {
		e.preventDefault();

		this.props.onAdd(this.state.name);
		this.setState({name: ""});
	},
	render: function() {
		return (
			<div className="add-player-form">
				<form onSubmit={this.onSubmit}>
					<input type="text" value={this.state.name} onChange={this.onNameChange} />
					<input type="submit" value="Add Player" />
				</form>
			</div>
		);
	}
});

function Stats(props) {
	// you don't have to store it, but it's handy for organisation
	var totalPlayers = props.players.length;
	var totalPoints = props.players.reduce(function(total, player){
		return total + player.score;
	}, 0)

	return (
		<table className="stats">
			<tbody>
				<tr>
					<td>Players:</td>
					<td>{totalPlayers}</td>
				</tr>
				<tr>
					<td>Total Points:</td>
					<td>{totalPoints}</td>
				</tr>
			</tbody>
		</table>
	);
}

Stats.propTypes = {
	players: React.PropTypes.array.isRequired,
};

function Header(props) {
	return (
		<div className="header">
			<Stats />
			<h1>{props.title}</h1>
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				<a className="remove-player" onClick={props.onRemove}>x</a>
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
	onRemove: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},
	onPlayerRemove: function(index) {
		// uncomment to see the player index
		// console.log('remove', index);
		this.state.players.splice(index, 1);
		setState(this.state);
	},
	onPlayerAdd: function() {
		// uncomment to see new player name
		//console.log('Player added:', name);
		this.state.players.push({
			name: name,
			score: 0,
			id: nextId,
		});

		/*
			NOTE: in something like Redux, we don't update the state itself, we actually create a brand new state object
		*/

		this.setState(this.state);
		nextId += 1;
	};
	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title} players={this.state.players} />

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							onRemove={function() {
								this.onRemovePlayer(index);
								}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
				<AddPlayerForm onAdd={this.onPlayerAdd} />
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

## Component Lifecyle

#### Designing a Stopwatch

Let's build a more advanced component. A stopwatch.

We will need a timer in seconds. We will have a button to stop and start the timer.

- The clock will continue ticking, so this presents the unique challenge of continually changing State.


```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

var nextId = 4;

var StopWatch = React.createClass({
	render: function() {
		return (
			<div className="stopwatch">
				<h2>Stopwatch</h2>
				<div className="stopwatch-time">0</div>
				<button>Start</button>
				<button>Reset</button>
			</div>
		);
	}
});

var AddPlayerForm = React.createClass({
	propTypes: {
		onAdd: React.PropTypes.func.isRequired,
	},
	getInitialState: function() {
		return {
			name: ""
		};
	},
	onNameChange: function(e) {
		// uncomment to see the changes on target value
		// console.log("onNameChange", e.target.value);
		this.setState({name: e.target.value});
	},
	onSubmit: function(e) {
		e.preventDefault();

		this.props.onAdd(this.state.name);
		this.setState({name: ""});
	},
	render: function() {
		return (
			<div className="add-player-form">
				<form onSubmit={this.onSubmit}>
					<input type="text" value={this.state.name} onChange={this.onNameChange} />
					<input type="submit" value="Add Player" />
				</form>
			</div>
		);
	}
});

function Stats(props) {
	// you don't have to store it, but it's handy for organisation
	var totalPlayers = props.players.length;
	var totalPoints = props.players.reduce(function(total, player){
		return total + player.score;
	}, 0)

	return (
		<table className="stats">
			<tbody>
				<tr>
					<td>Players:</td>
					<td>{totalPlayers}</td>
				</tr>
				<tr>
					<td>Total Points:</td>
					<td>{totalPoints}</td>
				</tr>
			</tbody>
		</table>
	);
}

Stats.propTypes = {
	players: React.PropTypes.array.isRequired,
};

function Header(props) {
	return (
		<div className="header">
			<Stats />
			<h1>{props.title}</h1>
			<Stopwatch />
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				<a className="remove-player" onClick={props.onRemove}>x</a>
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
	onRemove: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},
	onPlayerRemove: function(index) {
		// uncomment to see the player index
		// console.log('remove', index);
		this.state.players.splice(index, 1);
		setState(this.state);
	},
	onPlayerAdd: function() {
		// uncomment to see new player name
		//console.log('Player added:', name);
		this.state.players.push({
			name: name,
			score: 0,
			id: nextId,
		});

		/*
			NOTE: in something like Redux, we don't update the state itself, we actually create a brand new state object
		*/

		this.setState(this.state);
		nextId += 1;
	};
	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title} players={this.state.players} />

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							onRemove={function() {
								this.onRemovePlayer(index);
								}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
				<AddPlayerForm onAdd={this.onPlayerAdd} />
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Stopwatch State

Stopwatch will either be running, or it won't be.
- Implement the getInitialState method for Stopwatch
- One way to implement the button name depending on the state is to have control logic and a var that equals <button>[state]</button>
- The other way is to use a ternary operator. We can use this in a JSX expression!

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

var nextId = 4;

var StopWatch = React.createClass({
	getInitialState: function () {
		return {
			running: false,

		};
	},
	onStop: function() {
		this.setState({ running: false });
	},
	onStart: function() {
		this.setState({ running: true });
	},
	onReset: function() {

	},
	render: function() {
		return (
			<div className="stopwatch">
				<h2>Stopwatch</h2>
				<div className="stopwatch-time">0</div>
				{ this.state.running ?
					<button onClick={this.onStop}>Stop</button>
					:
					<button onClick={this.onStart}>Start</button>;
				}
				<button onClick={this.onReset}>Reset</button>
			</div>
		);
	}
});

var AddPlayerForm = React.createClass({
	propTypes: {
		onAdd: React.PropTypes.func.isRequired,
	},
	getInitialState: function() {
		return {
			name: ""
		};
	},
	onNameChange: function(e) {
		// uncomment to see the changes on target value
		// console.log("onNameChange", e.target.value);
		this.setState({name: e.target.value});
	},
	onSubmit: function(e) {
		e.preventDefault();

		this.props.onAdd(this.state.name);
		this.setState({name: ""});
	},
	render: function() {
		return (
			<div className="add-player-form">
				<form onSubmit={this.onSubmit}>
					<input type="text" value={this.state.name} onChange={this.onNameChange} />
					<input type="submit" value="Add Player" />
				</form>
			</div>
		);
	}
});

function Stats(props) {
	// you don't have to store it, but it's handy for organisation
	var totalPlayers = props.players.length;
	var totalPoints = props.players.reduce(function(total, player){
		return total + player.score;
	}, 0)

	return (
		<table className="stats">
			<tbody>
				<tr>
					<td>Players:</td>
					<td>{totalPlayers}</td>
				</tr>
				<tr>
					<td>Total Points:</td>
					<td>{totalPoints}</td>
				</tr>
			</tbody>
		</table>
	);
}

Stats.propTypes = {
	players: React.PropTypes.array.isRequired,
};

function Header(props) {
	return (
		<div className="header">
			<Stats />
			<h1>{props.title}</h1>
			<Stopwatch />
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				<a className="remove-player" onClick={props.onRemove}>x</a>
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
	onRemove: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},
	onPlayerRemove: function(index) {
		// uncomment to see the player index
		// console.log('remove', index);
		this.state.players.splice(index, 1);
		setState(this.state);
	},
	onPlayerAdd: function() {
		// uncomment to see new player name
		//console.log('Player added:', name);
		this.state.players.push({
			name: name,
			score: 0,
			id: nextId,
		});

		/*
			NOTE: in something like Redux, we don't update the state itself, we actually create a brand new state object
		*/

		this.setState(this.state);
		nextId += 1;
	};
	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title} players={this.state.players} />

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							onRemove={function() {
								this.onRemovePlayer(index);
								}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
				<AddPlayerForm onAdd={this.onPlayerAdd} />
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Making the Stopwatch Tick

- Create the onTick function.
	- We don't want this function in Render.
	- There are several lifecycle methods in React, we'll use componentDidMount.
- Be careful with componentDidMount. The memory attachment with 'this' creates a strong cycle. We need to also use componentWillUnmount.

```javascript
let PLAYERS = [
	{
		name: "Dennis",
		score: 33,
		id:1,
	},
	{
		name: "Ben",
		score: 34,
		id:2,
	},
	{
		name: "Clark From InVision",
		score: 12,
		id:3,
	}
];

var nextId = 4;

var StopWatch = React.createClass({
	getInitialState: function () {
		return {
			running: false,
			elapsedTime: 0,
			previousTime: 0,
		};
	},
	componentDidMount: function() {
		this.interval = setInterval(this.onTick, 100);
	},
	componentWillUnmount: function() {
		clearInterval(this.setInterval);
	},
	onTick: function() {
		//uncomment to confirm the tick in the console.
		//console.log('onTick');
		if (this.state.running) {
			var now = Date.now();
			this.setState({
				previousTime: now,
				elapsedTime: this.state.elapsedTime + (now - this.state.previousTime),
			});
		}
	},
	onStop: function() {
		this.setState({ running: false });
	},
	onStart: function() {
		this.setState({
			running: true,
			previousTime: Date.now(),
		});
	},
	onReset: function() {
		this.setState({
			elapsedTime: 0,
			previousTime: Date.now(),
		});
	},
	render: function() {
		var seconds = Math.floor(this.state.elapsedTime / 1000);
		return (
			<div className="stopwatch">
				<h2>Stopwatch</h2>
				<div className="stopwatch-time">{seconds}</div>
				{ this.state.running ?
					<button onClick={this.onStop}>Stop</button>
					:
					<button onClick={this.onStart}>Start</button>;
				}
				<button onClick={this.onReset}>Reset</button>
			</div>
		);
	}
});

var AddPlayerForm = React.createClass({
	propTypes: {
		onAdd: React.PropTypes.func.isRequired,
	},
	getInitialState: function() {
		return {
			name: ""
		};
	},
	onNameChange: function(e) {
		// uncomment to see the changes on target value
		// console.log("onNameChange", e.target.value);
		this.setState({name: e.target.value});
	},
	onSubmit: function(e) {
		e.preventDefault();

		this.props.onAdd(this.state.name);
		this.setState({name: ""});
	},
	render: function() {
		return (
			<div className="add-player-form">
				<form onSubmit={this.onSubmit}>
					<input type="text" value={this.state.name} onChange={this.onNameChange} />
					<input type="submit" value="Add Player" />
				</form>
			</div>
		);
	}
});

function Stats(props) {
	// you don't have to store it, but it's handy for organisation
	var totalPlayers = props.players.length;
	var totalPoints = props.players.reduce(function(total, player){
		return total + player.score;
	}, 0)

	return (
		<table className="stats">
			<tbody>
				<tr>
					<td>Players:</td>
					<td>{totalPlayers}</td>
				</tr>
				<tr>
					<td>Total Points:</td>
					<td>{totalPoints}</td>
				</tr>
			</tbody>
		</table>
	);
}

Stats.propTypes = {
	players: React.PropTypes.array.isRequired,
};

function Header(props) {
	return (
		<div className="header">
			<Stats />
			<h1>{props.title}</h1>
			<Stopwatch />
		</div>
	);
}

Header.propTypes = {
	title: React.PropTypes.string.isRequired,
};

function Counter(props) {
	return (
		<div className="counter">
			<button className="counter-action decrement" onClick={function() {props.onChange(-1)}}> - </button>
			<div className="counter-score"> {props.score }</div>
			<button className="counter-action increment" onClick={function() {props.onChange(1)}}> + </button>
		</div>
	);
}

Counter.propTypes = {
	score: React.PropTypes.number.isRequired,
	onChange: React.PropTypes.func.isRequired,
}

function Player(props) {
	return (
		<div className="player">
			<div className="player-name">
				<a className="remove-player" onClick={props.onRemove}>x</a>
				{props.name}
			</div>
			<div className="player-score">
				<Counter score={props.score} onChange={props.onScoreChange}/>
			</div>
		</div>
	);
}

Player.propTypes = {
	name: React.PropTypes.string.isRequired,
	score: React.PropTypes.number.isRequired,
	onScoreChange: React.PropTypes.func.isRequired,
	onRemove: React.PropTypes.func.isRequired,
}

var Application = React.createClass({
	propTypes: {
		title: React.PropTypes.string,
		initialPlayers: React.PropTypes.arrayOf(React.PropTypes.shape({
			name: React.PropTypes.string.isRequired,
			score: React.PropTypes.number.isRequired,
			id: React.PropTypes.number.isRequired,
		})).isRequired,
	},

	getDefaultProps: function() {
		return {
			title: "Scoreboard",
		}
	},
	getInitialState: function() {
		return {
			players: this.props.initialPlayers,
		};
	},
	onScoreChange: function(index, delta) {
		// uncomment this to double check value change on the application
		// console.log('onScoreChange', index, delta);
		this.state.players[index].score += delta;
		this.setState(this.state);
	},
	onPlayerRemove: function(index) {
		// uncomment to see the player index
		// console.log('remove', index);
		this.state.players.splice(index, 1);
		setState(this.state);
	},
	onPlayerAdd: function() {
		// uncomment to see new player name
		//console.log('Player added:', name);
		this.state.players.push({
			name: name,
			score: 0,
			id: nextId,
		});

		/*
			NOTE: in something like Redux, we don't update the state itself, we actually create a brand new state object
		*/

		this.setState(this.state);
		nextId += 1;
	};
	render: function() {
		return(
			<div className="scoreboard">
				<Header title={this.props.title} players={this.state.players} />

				<div className="players">
					{this.state.players.map(function (player, index) {
						return (
							<Player
							onScoreChange={function(delta) {
								this.onScoreChange(index,delta)}.bind(this)
							}
							onRemove={function() {
								this.onRemovePlayer(index);
								}.bind(this)
							}
							name={player.name}
							score{player.score}
							key={player.id} />
						);
					}.bind(this))}
				</div>
				<AddPlayerForm onAdd={this.onPlayerAdd} />
			</div>
		);
	}
});

ReactDOM.render(<Application intialPlayers={PLAYERS}/>, document.getElementById('container'));
```

#### Review and Next Steps

What did we learn?

- Managing State, a key component of design we focused on.
- We used intermediate components to use callbacks to send upwards.
- Redux can give us useful utilities for managing state.
- Babel.js has been used to precompile our JSX.
- React for mobile doesn't render to the DOM, but the native components for the platform. 
