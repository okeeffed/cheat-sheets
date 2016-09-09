# React Native with CSS and SCSS

## React Native to CSS/SCSS Node Package

[This is the link to the package](https://github.com/sabeurthabti/react-native-css)

This package converts css/scss to a .js file that we can use in the react-native component/container files.

__Instructions__

Install globally `npm install react-native-css -g`

Now we can run `react-native-css -i INPUT_CSS_FILE -o OUTPUT_JS_FILE --watch` - check the .md

__! IMPORTANT: Rules for the SASS File__

The target classes _NEED be written in camel case_

__Basic Example: style.css__

```
.container {
        margin-top: 75;
        align-items: center;
}

.image {
    width: 107;
    height: 165;
    padding: 10;
}

.descriptionCamelCaseExample {
    padding: 10;
    font-size: 25;
    color: #656565;
}
```

If we run `react-native-css -i ./style.css -o ./style.js --watch`

The following will be in style.js

```
module.exports = require('react-native').StyleSheet.create({ 	
	"container": {
		"marginTop":75,
		"alignItems":"center"
		},
	"image": {
		"width":107,
		"height":165,
		"padding":10
		},
	"descriptionCamelCaseExample": {
		"padding":10,
		"fontSize":25,
		"color":"#656565"}
	});
```

In the respective component js file, you will now need to import this.

```
'use strict';

// var React = require('react-native');
import React, { Component } from 'react';
import styles from './style.js';

import {
    StyleSheet,
    Text,
    View,
    Image
} from 'react-native';

class ExampleComponentOrContainer extends Component {
	render() {

		// example variable declarations
		// not directly relevant to explanation
	    var book = this.props.book;
	    var imageURI = (typeof book.volumeInfo.imageLinks !== 'undefined') ? book.volumeInfo.imageLinks.thumbnail : '';
	    var description = (typeof book.volumeInfo.description !== 'undefined') ? book.volumeInfo.description : '';

	    return (

			// use style = {styles.<class>}
			// to apply the styles

	        <View style={styles.container}>
	            <Image style={styles.image} source={{uri: imageURI}} />
	            <Text style={styles.descriptionCamelCaseExample}>{description}</Text>
	        </View>
	    );
	}
}

export { BookDetail };
```

Happy days!
