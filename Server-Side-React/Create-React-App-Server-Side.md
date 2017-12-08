# create-react-app Server Side bootstrapping

1. npm run eject
2. Update config/paths.js

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
