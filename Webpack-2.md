# Webpack-2

<!-- TOC -->

- [Webpack-2](#webpack-2)
    - [1.0: Webpack in Action](#10--webpack-in-action)
    - [1.1 Webpack Configuration](#11-webpack-configuration)
    - [2.0 Module Loaders](#20-module-loaders)
    - [2.1 CSS Loaders](#21-css-loaders)
    - [2.2 Image Loaders](#22-image-loaders)
    - [3.0 Code Splitting](#30-code-splitting)
    - [4.4: Code Splitting in the real world](#44--code-splitting-in-the-real-world)

<!-- /TOC -->

The concept is to have many js files that are small and specific.

*   Webpack bundles JS
*   CSS and Babelifying is just a side effect we can do

## 1.0: Webpack in Action

Module Systems and their Common Syntax:

| Module System | Common Syntax           |
| ------------- | ----------------------- |
| CommonJS      | require, module.exports |
| AMD           | require, define         |
| ES2015        | import, export          |

## 1.1 Webpack Configuration

| Command           | What it does                                                 |
| ----------------- | ------------------------------------------------------------ |
| entry             | Specify entry                                                |
| output            | Specify where the file is saved too                          |
| output > path     | Specify the file path (must be absolute)                     |
| output > filename | Output file name                                             |
| webpack           | allows you to install globally (instead, opt for npm script) |

For defining paths, we can use `path` from NodeJS.

```
const path = require('path');

const config = {
	entry: './src/index.js',
	output: {
		path: path.resolve(__dirname, 'build'),
		filename: 'bundle.js'
	}
};

module.exports = config;
```

However, you'll notice if you have two small files that combining them into an output looks far larger than those two files - so what is happening?

Behind the scenes, Webpack is doing similar to the following:

*   new array has been created
*   two functions within contain code from the two files
*   entry point index is defined which points to the index of the array that was given as the entry point
*   if it needs other functions, it calls them from the array

---

## 2.0 Module Loaders

*   Designed to do some preprocessing before they are put into the final file eg dealing with Babel etc. - The example with Babel requires `babel-loader`, `babel-core` and `babel-preset-env` (the env being the preset).
*   so how do we add this to Webpack?
*   previously, we referred to loaders as opposed to rules and modules, but this is how it is in Webpack 2. - rules are to do with configuration - rules have a `use` and `test` - `test` is a regex to select which file to apply too

```javascript
const config = {
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                use: 'babel-loader',
                test: /\.js$/
            }
        ]
    }
};
```

## 2.1 CSS Loaders

*   There are basically the `CSS` and `Style` loaders - style loader takes CSS imports and adds them to the HTML Document - CSS loader knows how to deal with CSS imports - Adding in more rules will allow us to make use of these loaders
*   Once you've compiled Webpack, what is it that these loaders are doing? - By default, it actually injects the CSS into a head tag, but how? - There is actually Javascript where the Style module actually takes that CSS and manually injects that into the CSS
*   We use another library `Extract Text Plugin` to ensure that these CSS files get output into their own file - Instead of `use`, we use `loader` (even though they are similar) but since the plugin is used in a way, we need to define `loader` - `plugins` are different to `loaders` and have the ability to stop files from ending up in the final `bundle.js` file - the `plugin` that we have will now create a `style.css` file

```javascript
const config = {
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                use: 'babel-loader',
                test: /\.js$/
            },
            {
                loader: ExtractTextPlugin.extract({
                    loader: 'css-loader'
                }),
                test: /\.css$/
            }
        ]
    },
    plugins: [new ExtractTextPlugin('style.css')]
};
```

## 2.2 Image Loaders

We can use `image-webpack-loader` and `url-loader`.

*   `image-webpack-loader` will compact down the file size automatically
*   The result of a compact image is then taken and `url-loader` will behave differently depending on the size of the image. - options, if larger than 40000, save it as a different file, else keep it as part of the js file

```javascript
const config = {
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'bundle.js',
        // publicPath for files not saved to bundle
        publicPath: 'build/'
    },
    module: {
        rules: [
            {
                use: 'babel-loader',
                test: /\.js$/
            },
            {
                loader: ExtractTextPlugin.extract({
                    loader: 'css-loader'
                }),
                test: /\.css$/
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: { limit: 40000 }
                    },
                    'image-webpack-loader'
                ]
            }
        ]
    },
    plugins: [new ExtractTextPlugin('style.css')]
};
```

---

## 3.0 Code Splitting

Code splitting is one of the big wins with using Webpack.

Code spltting is the art of creating a single `.js` file and then being able to split that code into several individual files and know when to load up these different modules.

To import a module only after an event:

```javascript
const button = document.createElement('button');
button.innerText = 'Click me';
button.onclick = () => {
    // if this below has import statements of it's own
    // it will also bring in this code
    System.import('./image_view');
};

document.body.appendChild(button);
```

The above example was to see what happens, but really we can just use the `import` statement to do this for us.

You can see this on the `network` tab on Google Dev Tools to see this all in action.

Anything that uses `System.import()` it will split up our call for different modules to import.

---

## 4.4: Code Splitting in the real world

The CommonChunksPlugin will look for common code in the bundles and split them into seperate files depending on the value you pass in for `name`.

```javascript
...

plugins: [
	new webpack.optimize.CommonsChunkPlugin({
		name: 'vendor'
	});
];

...
```
