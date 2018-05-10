# Server side Rendering with React and Redux

<!-- TOC -->

*   [Server side Rendering with React and Redux](#server-side-rendering-with-react-and-redux)
    *   [How do tradition React apps work?](#how-do-tradition-react-apps-work)
    *   [Serverside - What happens](#serverside---what-happens)
    *   [Serverside Architecture](#serverside-architecture)
    *   [Example base package.json](#example-base-packagejson)
    *   [RenderToString function](#rendertostring-function)
    *   [The build process](#the-build-process)
    *   [What is Isomorphic Javascript?](#what-is-isomorphic-javascript)
    *   [Clientside JS](#clientside-js)
    *   [Client bundles](#client-bundles)

<!-- /TOC -->

## How do tradition React apps work?

In relation to the index `html` file, we end up with a root div that React targets onto.

The webpage makes the request to the server, then we fetch the JS file, then app boots and we make some requests - all before any content is visible.

Using server side React, the goal is to make one request. The impact of this means that after the browser requests the page, the return info is the content being visible.

## Serverside - What happens

1.  Receive the request
2.  Load up React app in memory
3.  Fetch any required data
4.  Render app
5.  Send back to the HTML

Back on the browser side, the React application still ensure it fetches the bundle for the client-side interactivity.

## Serverside Architecture

*   Run two back end server. One for the API, the other for rendering. - The API layer is to deal wth DB access, validation, auth etc. - The View layer just focuses on producing data.

## Example base package.json

```javascript
{
  "name": "react-ssr",
  "version": "1.0.0",
  "description": "Server side rendering project",
  "main": "index.js",
  "scripts": {
  },
  "author": "",
  "license": "ISC",
  "dependencies": {
    "axios": "0.16.2",
    "babel-cli": "6.26.0",
    "babel-core": "6.26.0",
    "babel-loader": "7.1.2",
    "babel-preset-env": "1.6.0",
    "babel-preset-es2015": "6.24.1",
    "babel-preset-es2017": "6.24.1",
    "babel-preset-react": "6.24.1",
    "babel-preset-stage-0": "6.24.1",
    "compression": "1.7.0",
    "concurrently": "3.5.0",
    "express": "4.15.4",
    "express-http-proxy": "1.0.6",
    "lodash": "4.17.4",
    "nodemon": "1.12.0",
    "npm-run-all": "4.1.1",
    "react": "16.0.0",
    "react-dom": "16.0.0",
    "react-helmet": "5.2.0",
    "react-redux": "5.0.6",
    "react-router-config": "1.0.0-beta.4",
    "react-router-dom": "4.2.2",
    "redux": "3.7.2",
    "redux-thunk": "2.2.0",
    "serialize-javascript": "1.4.0",
    "webpack": "3.5.6",
    "webpack-dev-server": "2.8.2",
    "webpack-merge": "4.1.0",
    "webpack-node-externals": "1.6.0"
  }
}
```

## RenderToString function

We use ReactDOM and instead of rendering it, we render it to raw HTML and turn it into string.

We can use an example of a Express file like so to run a base file:

```javascript
/*
	Use this for the optimized build
	and serve out with Docker
 */

var fs = require('fs');
var dotenv = require('dotenv').config;

// Main starting point of the application
const express = require('express');
const http = require('http');
const bodyParser = require('body-parser');
const morgan = require('morgan');
const app = express();
const cors = require('cors');
const spawn = require('child_process').spawn;
const path = require('path');
const React = require('react');
const renderToString = require('react-dom/server').renderToString;
const Home = require('./components/home/Home').default;

// App Setup
app.use(morgan('combined'));
app.use(cors());
app.use(bodyParser.json({ type: '*/*' }));

app.use(express.static(path.resolve(__dirname, 'build')));

app.get('/', (req, res) => {
    const content = renderToString(<Home />);

    res.send(content);
});

app.get('*', (req, res) => {
    res.sendFile(path.resolve(__dirname, 'build', 'index.html'));
});

// Server Setup
const port = process.env.PORT || 3000;
const server = http.createServer(app);
server.listen(port);
console.log('Server listening on:', port);
```

Given a Webpack file like the following, we can bundle the .js file and then use a Node server to run and return the code:

```
const path = require('path');

module.exports = {
	// Target Nodehs
	target: 'node',
	// Looking for the root of server app
	entry: './src/app.js',
	output: {
		filename: 'server.js',
		path: path.resolve(__dirname, 'build')
	},
	// Run Babel on every file
	module: {
		rules: [
			{
				test: /\.js?$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
				options: {
					presets: [
						'react',
						'stage-0',
						['env', { targets: { browsers: ['last 2 versions']}}]
					]
				}
			}
		]
	}
}
```

If using with `create-react-app` - add the following config:

```javascript
// config/paths.js

module.exports = {
	...
	appServer: resolveApp('server'),
  	serverIndexJs: resolveApp('src/server.js'),
 	...
}
```

Ignore the file itself in the appropriate places. for the other webpack configs.

Create a `webpack.config.server.js` file.

```
const path = require('path');
const paths = require('./paths');
const webpackNodeExternals = require('webpack-node-externals');

module.exports = {
	// Target Nodehs
	target: 'node',
	// Looking for the root of server app
	entry: paths.serverIndexJs,
	output: {
	    // The build folder.
	    path: paths.appServer,
	    filename: 'server.js'
	},
	// Run Babel on every file
	module: {
		rules: [
			{
				test: /\.js?$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
				options: {
					presets: [
						'react',
						'stage-0',
						['env', { targets: { browsers: ['last 2 versions']}}]
					]
				}
			}
		]
	},
	externals: [webpackNodeExternals()]
}
```

## The build process

Currently, we have a static base file. We want to watch and re-run the server on changes. This can be done with Nodemon and Webpack's `--watch` option.

## What is Isomorphic Javascript?

`Serverside rendering` isn't necessarily accurate. Univeral/Isomorphic JS basically means that code that is rendered serverside might also be used client side.

## Clientside JS

```javascript
<div className="home">
    <h1>Home</h1>
    <button onClick={() => console.log('HI!')}>Press me!</button>
</div>
```

Why doesn't the above work? We are rendering out HTML and 0 JavaScript code being sent to the user browser. How can we ship this down?

## Client bundles

We basically want to create 2 bundles:

1.  A server + client side bundle
2.  A client side only bundle
