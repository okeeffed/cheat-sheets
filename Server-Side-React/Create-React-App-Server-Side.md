# create-react-app Server Side bootstrapping

1.  npm run eject
2.  Update config/paths.js

```javascript
// config/paths.js

module.exports = {
	...
	appServer: resolveApp('server'),
  	serverIndexJs: resolveApp('src/server.js'),
 	...
}
```

3.  Create a `webpack.config.server.js` file.
4.  Install `webpack-node-externals`.

As described on the github:

_Webpack allows you to define externals - modules that should not be bundled._

_When bundling with Webpack for the backend - you usually don't want to bundle its node_modules dependencies. This library creates an externals function that ignores node_modules when bundling in Webpack._

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
