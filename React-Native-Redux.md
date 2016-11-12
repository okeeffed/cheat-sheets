# React Native with Redux

## RNREDUX-1: Intro

__Roadmap__

Setting up RN for iOS and Android.

__Installing the Dependencies for OSX__

## RNREDUX-2: React Native 101

### ---- RNREDUX-2.1: Project Directory/Screen Content

__ios and android__

The project folders rarely need to be adjusted unless we want to work at a low-level.

__index.ios.js vs index.android.js__

Entry points for our applications. When Android or iOS run, these two files are the first platform entry points respectively.

__Steps for components__

```
// Import a library to help create a component

import React from 'react';
// destructuring
// import ReactNative from 'react-native';
import { Text, AppRegistry } from 'react-native';

// Create a component
// if we are returning just one statement, we can get rid of the curly braces
// and the return statement - not an error! ES lint issue.

const App => () => {
	return (
		<Text>Some Text</Text>
	);
}

// ^ this will become...

const App => () => (
	<Text>Some Text</Text>
);

// Render it to the device
// name 'albums' must correlate to name of the project
// also destructure ReactNative.AppRegistry.registerComponent('albums', () => App);
AppRegistry.registerComponent('albums', () => App);
```

### ---- RNREDUX-2.2: React vs React Native

Both are distinct libraries. RN is essentially the handle to getting things onto a device!

`import` is required to working with `outside code` eg. other libraries/modules.

__React__

- Knows how a component should behave
- Knows how to take a bunch of components and make them work together

__React Native__

- Knows how to take the output from a component and place it on the screen
- Provides default core components (image, text)

## RNREDUX-4: HTTP Requests with React Native

### ---- RNREDUX-4.1: Sourcing Album Data

For the idea of creating is a label is to create two components.

a) The AlbumList
b) The AlbumDetail

__AlbumList Component__

Note: If you are embedding more than one component, wrap around in <View>.

```
// after importing from React, ReactNative

const AlbumView = () => {
	return (
		<View>
			<Text>Album List!</Text>
		</View>
	);
};

export default AlbumList;
```

### ---- RNREDUX-4.2: Functional Component vs Class Component

__Functional Component__

- Used for presenting static data
- Can't handle fetching data
- Easy to write

__Class Component__

- Used for dynamic sources of data
- Handles any data that might change (fetching data, user events, etc)
- Knows when it gets rerendered to the device (useful for data fetching)
- More code to write

```javascript
// functional component

const Header = () => {
	return <Text>Hi there!</Text>
}

// class component

class Header extends Component {
	render() {
		return <Text>Hi there!</Text>
	}
}
```

So recreating our AlbumList...

```javascript
import React, { Component } from 'react';
import { View, Text }, from 'react-native';

class AlbumView extends Component {
	render() {
		return (
			<View>
				<Text>Album List!</Text>
			</View>
		);
	}
};

export default AlbumList;
```

### ---- RNREDUX-4.3: Fetching Data with Lifecycle Methods

Class based components themselves KNOW when they're about to rendered.

Example Lifecycle Methods include `componentWillMount()`

__Network Requests__

How do we make the HTTP request? It's quite straight forward.

`npm install --save axios`

Ensure you need to have some logic to rerender the components after the AJAX returns and the promise is fulfilled.

__Component Level State__

Components will already be on the screen before we can get our promise back. Our state so far will look like the following...

We need to use component level state for it all to rerender

1. Set up a default state (class level property)
2. Update the state (needs to use `this.setState`!)

__Rules of State__

- Definition of State: a plain JS object used to record and respond to 'user-triggered events'.
- When we need to update what a component shows, call `this.setState`.
- Only change state with 'setState' not this.state='something'.

__When do we use props?__

- props is for parent to child communication
- state is internal record keeping

```
// before
state = { albums: [] };

// after fetching data
state = {
	albums: [
		{name: 'ashio'},
		{name: 'aheure'}
	]
};
```


```javascript
import React, { Component } from 'react';
import { View, Text }, from 'react-native';
import axios from 'axios';

class AlbumView extends Component {
	state = { albums: [] };


	componentWillMount() {
		// console.log('componentWillMount in console');
		// debugger;
		axios.get('https://theapilink.com')
			.then(response => this.setState({ albums: response.data }));
	}

	render() {
		// can use this when the render method continues to re-render
		console.log(this.state);
		debugger;

		return (
			<View>
				<Text>Album List!</Text>
			</View>
		);
	}
};

export default AlbumList;
```

### ---- RNREDUX-4.4: Rendering a List of Components

Only use state with class level components (not functional components)

For each album now, we want to create one component using `map`.

Ensure that each property has a unique key!

__AlbumList__

```javascript
import React, { Component } from 'react';
import { View, Text }, from 'react-native';
import axios from 'axios';

class AlbumView extends Component {
	state = { albums: [] };


	componentWillMount() {
		// console.log('componentWillMount in console');
		// debugger;
		axios.get('https://theapilink.com')
			.then(response => this.setState({ albums: response.data }));
	}

	renderAlbums() {
		return this.state.albums.map(album =>
			// best to use for the key is an id if you have one
			<Text key={album.title}>{album.title}</Text>
		);
	}

	render() {
		// can use this when the render method continues to re-render
		console.log(this.state);
		debugger;

		return (
			<View>
				{this.renderAlbums()}
			</View>
		);
	}
};

export default AlbumList;
```

__Creating an AlbumDetail__

Does it need to be a Class or Functional component?

```javascript
import React, { Component } from 'react';
import { View, Text }, from 'react-native';

const AlbumDetail = (props) => {
	return (
		<View>
			<Text>{props.album.title}</Text>
		</View>
	);
};

export default AlbumDetail;
```

__Final AlbumList__

Import AlbumDetail, reset the "renderAlbums" function to render the AlbumDetail and then use props to pass down from parent to child.

```javascript
import React, { Component } from 'react';
import { View }, from 'react-native';
import axios from 'axios';
import AlbumDetail from './AlbumDetail'

class AlbumView extends Component {
	state = { albums: [] };


	componentWillMount() {
		// console.log('componentWillMount in console');
		// debugger;
		axios.get('https://theapilink.com')
			.then(response => this.setState({ albums: response.data }));
	}

	renderAlbums() {
		return this.state.albums.map(album =>
			// best to use for the key is an id if you have one
			// prop name "album" can be named anything
			<AlbumDetail key={album.title} album={album}/>
		);
	}

	render() {
		// can use this when the render method continues to re-render
		console.log(this.state);
		debugger;

		return (
			<View>
				{this.renderAlbums()}
			</View>
		);
	}
};

export default AlbumList;
```

### ---- RNREDUX-4.5: Creating Reusable Components

For styling, it is sometimes useful to make components within components for layout purposes!

__Passing components as props__

We can pass `props` as a parameter and then use {props.children} to make a reference to it.

__Card.js__

```
import React from 'react';
import { View } from 'react-native';

const Card = (props) => {
	render (
		<View style={styles.containerStyle}>
			{props.children}
		</View>
	);
}

const styles = {
	containerStyle: {
		borderWidth: 1,
		borderRadius: 2,
		borderColor: '#ddd',
		borderBottomWidth: 0,
		shadowColor: '#000',
		shadowOffset: { width: 0, height: 2 },
		shadowOpacity: 0.1,
		shadowRadius: 2,
		elevation: 1,
		marginLeft: 5,
		marginRight: 5,
		marginTop: 10
	}
};

export default Card;
```

__AlbumDetail__

We want to use this to pass down props for `Card`

```javascript
import React, { Component } from 'react';
import { Text }, from 'react-native';
import Card from './Card';

const AlbumDetail = (props) => {
	return (
		<Card>
			<Text>{props.album.title}</Text>
		</Card>
	);
};

export default AlbumDetail;
```

### ---- RNREDUX-4.5: Turn a Component into Sections

__CardSection.js__

```javascript
import React from 'react';
import { View } from 'react-native';

const CardSection = (props) => {
	render (
		<View style={styles.containerStyle}>
			{props.children}
		</View>
	);
}

const styles = {
	containerStyle: {
		borderBottomWidth: 1,
		padding: 5,
		backgroundColor: '#fff',
		justifyContent: 'flex-start',
		flexDirection: 'row',
		borderColor: '#ddd',
		position: 'relative'
	}
};

export default CardSection;
```

__AlbumDetail__

We want to use this to pass down props for `Card`

```javascript
import React, { Component } from 'react';
import { Text }, from 'react-native';
import Card from './Card';
import CardSection from './CardSection';

const AlbumDetail = (props) => {
	return (
		<Card>
			<CardSection>
				<Text>{props.album.title}</Text>
			</CardSection>
		</Card>
	);
};

export default AlbumDetail;
```

## RNREDUX-5: Handling Component Layout

### ---- RNREDUX-5.1: Mastering Layout with Flexbox

Designing for web from personal experience is generally easier than React Native.

How about layout challenges? Keeping things on the left, and on the right? We use Flexbox to be our friend!

Imaging a layout like the following.

```
<Card>
	<CardSection>
		<Image />
		<Text />
		<Text />
	</CardSection>
</Card>
```

__Positioning of elements__

How do we want to apply flexbox to our particular layout? What we can do is use <View> to wrap the images - this is similar to using things like <div>.

We can then use flex direction to style our views for column and what is within for rows.

Unless we define a height, it will just flex to have just enough height!

__Images with React Native__

We can import `image` primitive from React Native!

However, images will not expand to fit by default. We need to manually add in a styling rule!

__Notes__

Destructure album objects if there is more than one.

If you wanted to, you can also dereference styles!

```
const { thumbnailStyle, headerContentStyle } = styles;
```

```
// the album and const is for destructuring

const Card = ({ album }) => {
	const { title, artist, thumbnail_image } = album;

	return (
		<Card>
			<CardSection>
				<View style={styles.thumbnailContainerStyle}>
					// <Image source={{ uri: props.album.thumbnail_image }}/>
					//destructured
					<Image
						style={styles.thumbnailStyle}
						source={{ uri: thumbnail_image }}/>
				</View>
				<View style={styles.headerContentStyle}>
					//<Text>{props.album.title}</Text>
					//<Text>{props.album.artist}</Text>
					// Destructured
					<Text style={styles.headerTextStyle}>{title}</Text>
					<Text>{artist}</Text>
				</View>
			</CardSection>
			<CardSection>
				<Image
					style={style.imageStyle}
					source={{ uri: image }} />
			</CardSection>
		</Card>
	);
}

const styles = {
	headerContentStyle: {
		flexDirection: 'column',
		justifyContent: 'space-around'
	},
	headerTextStyle: {
		fontSize: 18
	},
	thumbnailStyle: {
		height: 50,
		width: 50
	},
	thumbnailContainerStyle: {
		justifyContent: 'center',
		alignItems: 'center',
		marginLeft: 10,
		marginRight: 10
	},
	imageStyle: {
		height: 300,
		flex: 1,
		width: null
	},
};
```

### ---- RNREDUX-5.2: Making Content Scrollable and Handling Input

__ScrollView__

Scrolling is definitely one of the differenes between React and React Native. To make them scrollable, we just import `ScrollView` and use that on the outside.

For this case, it is the renderAlbums.

We can just replace View with ScrollView.

You also MUST find the root view and set it to flex: 1.

__Handling Input__

Time to make a button.

__Button.js__

```
import React from 'react';
import { Text } from 'react-native';

const Button = () = => {
	return (
		<Text>Click me!</Text>
	);
}

export default Button;
```

Now when we use this, we can have a section to house a button.

We need to wrap the button but using `TouchableHighlight` or `TouchableOpacity`

```
import React from 'react';
import { Text, TouchableOpacity } from 'react-native';

const Button = ({ onPress }) = => {

	const { buttonStyle, textStyle } = styles;

	return (
		// from the parent, have the prop of onPress{() => function}
		<TouchableOpacity style={buttonStyle} onPress={onPress}>
			<Text style={textStyle}>
				Click me!
			</Text>
		</TouchableOpacity>
	);
}

const styles = {
	textStyle: {
		alignSelf: 'center',
		color: '#007aff',
		fontSize: 16,
		fontWeight: '600',
		paddingTop: 10,
		paddingBottom: 10
	},
	buttonStyle: {
		flex: 1,
		alignSelf: 'stretch',
		backgroundColor: '#fff',
		borderRadius: 5,
		borderColor: '#007aff',
	}
}

export default Button;
```

### ---- RNREDUX-5.3: Responding to User Input

__Card.js__

```javascript
// have your imports
// the album and const is for destructuring

const Card = ({ album }) => {
	const { title, artist, thumbnail_image, url } = album;

	return (
		<Card>
			<CardSection>
				<View style={styles.thumbnailContainerStyle}>
					// <Image source={{ uri: props.album.thumbnail_image }}/>
					//destructured
					<Image
						style={styles.thumbnailStyle}
						source={{ uri: thumbnail_image }}/>
				</View>
				<View style={styles.headerContentStyle}>
					//<Text>{props.album.title}</Text>
					//<Text>{props.album.artist}</Text>
					// Destructured
					<Text style={styles.headerTextStyle}>{title}</Text>
					<Text>{artist}</Text>
				</View>
			</CardSection>
			<CardSection>
				<Image
					style={style.imageStyle}
					source={{ uri: image }} />
			</CardSection>
			<CardSection>
				<Button
					onPress={() => openURL(album.url)}>
					Buy now
				</Button>
			</CardSection>
		</Card>
	);
}

const styles = {
	headerContentStyle: {
		flexDirection: 'column',
		justifyContent: 'space-around'
	},
	headerTextStyle: {
		fontSize: 18
	},
	thumbnailStyle: {
		height: 50,
		width: 50
	},
	thumbnailContainerStyle: {
		justifyContent: 'center',
		alignItems: 'center',
		marginLeft: 10,
		marginRight: 10
	},
	imageStyle: {
		height: 300,
		flex: 1,
		width: null
	},
};
```

__Button.js__

```
import React from 'react';
import { Text, TouchableOpacity } from 'react-native';

const Button = ({ onPress, children }) = => {

	const { buttonStyle, textStyle } = styles;

	return (
		// from the parent, have the prop of onPress{() => function}
		<TouchableOpacity style={buttonStyle} onPress={onPress}>
			<Text style={textStyle}>
				{ children }
			</Text>
		</TouchableOpacity>
	);
}

const styles = {
	textStyle: {
		alignSelf: 'center',
		color: '#007aff',
		fontSize: 16,
		fontWeight: '600',
		paddingTop: 10,
		paddingBottom: 10
	},
	buttonStyle: {
		flex: 1,
		alignSelf: 'stretch',
		backgroundColor: '#fff',
		borderRadius: 5,
		borderColor: '#007aff',
	}
}

export default Button;
```

## RNREDUX-8: Redux inside of React Native

### ---- RNREDUX-8.1: Redux Boilerplate

The <Provider> tag works together with the Store. The Store is what holds the Application State.

The Provider is the communication with React. `react-redux` is the glue for React and Redux.

__Steps__

1. import { Provider } from 'react-redux' and import { createStore } from 'redux'.
2. Wrap app view in <Provider store={createStore(reducers)}
3. Create reducers/index.js
4. Import {combineReducers } from 'redux' in this new file and export default combineReducers with the reducers inside.

__app.js for React-Native Redux__

```javascript
import React from 'react';
import { View } from 'react-native';
import { Provider } from 'react-redux';
import { createStore } from 'redux';
import reducers from './reducers';

const App = () => {
	return (
		<Provider store={createStore(reducers)}>
			<View />
		</Provider>
	);
};

export default App;
```

__reducers/index.js__

Create `libraries` as basis to always return an array.

```
import {combineReducers } from 'redux';

export default combineReducers({
	libraries: () => []
});
```

### ---- RNREDUX-8.2: Reducer and State Design

How can we tap on something and move to show more detail?

Let's create a file to specifically show library details. Making a data model. You need to be thinking about Reducers here. Reducers contains the App Data.

This builds on the `combineReducers` function we have above.

Let's have two separate pieces of state.

a) a list of libraries
b) currently selected library

```javascript
// Examples of what our reducers
// could look like

// Library Reducer

[
	{ id: 1, name: 'React' },
	{ id: 2, name: 'Redux' }
]

// Selection Reducer

1
```

***

__Library list of data__

`Connect` function: Used to connect up the reducers and state.

_LibraryReducer.js_

```
import data from './LibraryList.json';

export default () => data;
```

_LibraryReducer.json_

This provides the data for above.

```
[
	{
		'id': 0,
		'title': 'ahid',
		'description': 'iOhoieshoit'
	},
	...
]
```

_reducers.js_

```
import { CombineReducers } from 'redux';
import LibraryReducer from './LibraryReducer';

export default combineReducers({
	libraries: LibraryReducer
});
```

_LibraryList.js_

Rendering the list to the user. mapStateToProps will grab the state from the connect function that is exported in `combineReducers` and any object returned from this `mapStateToProps` function will become available to our props.

```
import React, { Component } from 'react';
import { connect } from 'react-redux';

class LibraryList extends Component {
	render() {
		// this will show what is available from
		// the mapStateToProps func
		// console.log(this.props)
		return;
	}
}

const mapStateToProps = state => {
	// console.log(state); // use to see current state
	return {
		// this will give a prop to our LibraryList
		libraries: state.libraries;
	}
};

export default connect(mapStateToProps)(LibraryList);
```






