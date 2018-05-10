# React with Redux - Middleware

<!-- TOC -->

*   [React with Redux - Middleware](#react-with-redux---middleware)
    *   [REDMID-1: Overview](#redmid-1-overview) - [---- REDMID-1.1: Component Set up](#-----redmid-11-component-set-up) - [---- REDMID-1.2: Controlled Components and Binding Text](#-----redmid-12-controlled-components-and-binding-text)

<!-- /TOC -->

## REDMID-1: Overview

In the last chapter, we saw some main ideas about Redux. Now, we want to create an app. We will have async (like AJAX) calls in this.

We're going to create a webpage that will search for cities and give back Temp, Pressure and Humidity.

We will use things like a line chart for the temp etc.

In general, the components won't make AJAX calls... we want Redux to that for us.

#### ---- REDMID-1.1: Component Set up

1.  SearchBar
2.  App
3.  ForecastList
4.  Chart

Ensure that within source, you have the folders that you are looking for.

**In containers > SearchBar.js**

```javascript
import React, { Component } from 'react';

export default class SearchBar extends Component {
    render() {
        return (
            <form className="input-group">
                <input />
                <span className="input-group-btn">
                    <button type="submit" className="btn btn-secondary">
                        Submit
                    </button>
                </span>
            </form>
        );
    }
}
```

**In components > app.js**

```javascript
import React, { Component } from 'react';
import SearchBar from '../containers/SearchBar.js';

export default class App extends Component {
    render() {
        return (
            <div>
                <SearchBar />
            </div>
        );
    }
}
```

#### ---- REDMID-1.2: Controlled Components and Binding Text

To create the component level state. (not redux)

Remember, for event handlers, we need to set the callback function where the callback reference is "this", it will have the wrong context from the render section.

You can fix this in the constructor by let the instance of search bar to bind "this" and replace this.onInputChange with this result.

The other option sometimes would be to instead of using the constructor, we could us onChange={ () => this.onInputChange }

**In containers > SearchBar.js**

```javascript
import React, { Component } from 'react'

export default class SearchBar extends Component {

	contructor(props) {
		super(props);

		this.state = { term: '' };

		this.onInputChage = this.onInputChange.bind(this);
	}

	onInputChange(event) {
		console.log(event.target.value);
		this.setState({ term: event.target.value });
	}

	render() {
		return (
			<form className="input-group">
				<input
					placeholder="Get a 5-day forecast in your favourite cities"
					className="form-control"
					value={this.state.term}
					onChange={this.onInputChange}
				/>
				<span className="input-group-btn">
					<button type="submit" className="btn btn-secondary">Submit</button>
				</span>
			</form>
		)
	}
}
```
