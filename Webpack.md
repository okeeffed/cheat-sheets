# Webpack

For results from this, the react gen will have the results of the Webpack tutorial installed!

It is important that you generate this folder or refer to the Treehouse course files.

Because the way Webpack current stands and how it is designed, think of using it for React projects.

## Table of Contents

<a href="#web1>WEB-1</a>
<a href="#web2>title</a>

<div id="web1"></div>

***

## WEB-1: Webpack - The Why.

Build Tasks

1. Module loading

Looks for `require` and `import` statements. This helps prevents errors.

2. Concatenation

Combining several files into one for loading performance. Minimal HTTP reqs.

3. Minification

Compressing/extraction unnecessary lines and characters.

<div id="web2"></div>

## WEB-2: Webpack Config

Webpack is an opinionated tool. If you stick to industry standard, you won't need to do much config.


Config is done in `webpack.config.js`

For now, we'll just look at 3 configuration properties:

```
1. entry
2. output
3. module
```

The file looks like so:

```
var HtmlWebpackPlugin = require("html-webpack-plugin");

// ensure all the webpack dependencies are installed
var webpackConfig = {
	entry: "./src/app.js",
	output: {
		path: "build",
		filename: "bundle.js"
	},
	module: {
		loaders: [
			{
				// used to ensure js loads
				loader: "babel-loader",
				test: /\.js$/
			}
		]
	}
}
```

`entry` can be specified with a string for a single entry point or an object for multiple entry points.

`output` used for building for production - which folder to place your build in and what file to have the bundled file.

`module` many properties that are used to config webpack. Loaders will be used for using installed loaders.

<div id="web3"></div>

***

## WEB-3: Building an app

Webpack has it's own CLI tool.

In the example file from the TH lesson, index.js is the entry point and index.ejs is then used to inject JS into a HTML file.

We're going to define a npm script for webpack.

```
// in package.json
...
"script": {
		"build": "webpack --optimize-minimize"
}
...
```

<div id="web4"></div>

***

## WEB-4: Webpack Dev Server

`webpack-dev-server` is an npm file you can use for serving, however you can just flag `webpack --watch` and run from MAMP if you want.

<div id="web5"></div>

***

## WEB-5: Adding Styles

Loaders are extensions that enable more webpack config options.

<div id="web6"></div>

***

## WEB-6: Loaders

Source maps, fonts etc.

We can pipe loaders.
