# React-Native Cheat Sheet using ES6

## RN-1: Importing from React

### In index.ios.js

```javascript
// import from React and React-Native
import React, { Component } from 'react';

// required components go here -> check from the docs
import {
  AppRegistry,
  TabBarIOS,
  StyleSheet,
  Text,
  View
} from 'react-native';

// import from your own files
import { Featured } from './Featured.js';
import { Search } from './Search.js';
```

## RN-2: Example classes

```javascript
// this is an example class
class BookSearch extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedTab: 'featured'
        };
    }

	// this is where the view renders
    render() {
        return (
			// JSX commands relate to imports from react-native
			// {} is where the JSX compiles Javascript
            <TabBarIOS selectedTab={this.state.selectedTab}>
                <TabBarIOS.Item
					title="Left Tab"
                    selected={this.state.selectedTab === 'featured'}
                    icon={{uri: base64Icon, scale: 3}}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'featured'
                        });
                    }}>
                    <Featured/>
                </TabBarIOS.Item>
                <TabBarIOS.Item
					title="Right Tab"
                    selected={this.state.selectedTab === 'search'}
                    icon={{uri: base64Icon, scale: 3}}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'search'
                        });
                    }}>
                    <Search/>
                </TabBarIOS.Item>
            </TabBarIOS>
        );
    }
}
```

## RN-3: Registry for an App

```javascript
AppRegistry.registerComponent('BookSearch', () => BookSearch);
```

## RN-4: Debugging - Important things to note

If the AppRegistry is not working (error regarding App not registered)

1. Check all terminal sessions that have used React Native have closed
2. Try running the command npm link from the main directory of the project
3. Check the moduleName in the AppDelegate.m file in the Xcode Project

## RN-4: StyleSheet.create

In this example, you can see how the 'const styles' variable is declared and how it is implemented in the render() function.

```javascript
const styles = StyleSheet.create({
    description: {
        fontSize: 20,
        backgroundColor: 'white'
    },
    container: {
        flex: 1,
    }
});

class Search extends Component {
	render() {
        return (
            <NavigatorIOS
                style={styles.container}
                initialRoute={{
            title: 'Search Books',
            component: SearchBooks
        }}/>
        );
    }
}
```

# iOS Views

** ! important **

<View> tags are treated similar to as if they are <div> tags

## RN-5: Navigation View

Example: Search.js from the BookSearch project

```javascript
'use strict';

import React, { Component } from 'react';
import {
	StyleSheet,
    NavigatorIOS,
    Text
} from 'react-native';
import { SearchBooks } from './SearchBooks.js';

const styles = StyleSheet.create({
    description: {
        fontSize: 20,
        backgroundColor: 'white'
    },
    container: {
        flex: 1,
    }
});

class Search extends Component {
	render() {
        return (
            <NavigatorIOS
                style={styles.container}
                initialRoute={{
            title: 'Search Books',
            component: SearchBooks
        }}/>
        );
    }
}

export { Search };
```

## RN-6: UITableCellView replica (ListView)

BookList.js - taken from BookSearch

```javascript
'use strict';

import React, {Component} from 'react';

import {
	Image,
    StyleSheet,
	Text,
    View,
	ListView,
    TouchableHighlight,
    ActivityIndicatorIOS
} from 'react-native';

import { BookDetail } from './BookDetail.js';

const styles = StyleSheet.create({
	container: {
	    flex: 1,
	    flexDirection: 'row',
	    justifyContent: 'center',
	    alignItems: 'center',
	    backgroundColor: '#F5FCFF',
	    padding: 10
	},
	thumbnail: {
	    width: 53,
	    height: 81,
	    marginRight: 10
	},
	rightContainer: {
	    flex: 1
	},
	title: {
	    fontSize: 20,
	    marginBottom: 8
	},
	author: {
	    color: '#656565'
	},
	separator: {
       height: 1,
       backgroundColor: '#dddddd'
   },
   listView: {
	   marginTop: 60,
       backgroundColor: '#F5FCFF'
   },
   loading: {
       flex: 1,
       alignItems: 'center',
       justifyContent: 'center'
   }
});

// the commented out code related to FAKE_BOOK_DATA is how you can stub some data

// const FAKE_BOOK_DATA = [
//     {volumeInfo: {title: 'The Catcher in the Rye', authors: "J. D. Salinger", imageLinks: {thumbnail: 'http://books.google.com/books/content?id=PCDengEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api'}}}
// ];

const REQUEST_URL = 'https://www.googleapis.com/books/v1/volumes?q=subject:fiction';

class BookList extends Component {

	constructor(props) {
       super(props);
       this.state = {
           isLoading: true,
           dataSource: new ListView.DataSource({
               rowHasChanged: (row1, row2) => row1 !== row2
           })
       };
   	}

	componentDidMount() {
		// var books = FAKE_BOOK_DATA;
		// this.setState({
		//     dataSource: this.state.dataSource.cloneWithRows(books)
		// });
		this.fetchData();
	}

	fetchData() {
       fetch(REQUEST_URL)
       .then((response) => response.json())
       .then((responseData) => {
           this.setState({
               dataSource: this.state.dataSource.cloneWithRows(responseData.items),
               isLoading: false
           });
       })
       .done();
   }

	render() {
	// var book = FAKE_BOOK_DATA[0];
		if (this.state.isLoading) {
		   return this.renderLoadingView();
	   }

	   return (
			<ListView
				dataSource={this.state.dataSource}
				renderRow={this.renderBook.bind(this)}
				style={styles.listView}
				/>
		);
    }

	renderLoadingView() {
	    return (
	        <View style={styles.loading}>
	            <ActivityIndicatorIOS
	                size='large'/>
	            <Text>
	                Loading books...
	            </Text>
	        </View>
	    );
	}

	renderBook(book) {
       return (
		   <TouchableHighlight
		   		onPress={() => this.showBookDetail(book)}
				underlayColor='#dddddd'>
                <View>
                    <View style={styles.container}>
                        <Image
                            source={{uri: book.volumeInfo.imageLinks.thumbnail}}
                            style={styles.thumbnail} />
                        <View style={styles.rightContainer}>
                            <Text style={styles.title}>{book.volumeInfo.title}</Text>
                            <Text style={styles.author}>{book.volumeInfo.authors}</Text>
                        </View>
                    </View>
                    <View style={styles.separator} />
                </View>
            </TouchableHighlight>
       );
   }

	showBookDetail(book) {
       this.props.navigator.push({
           title: book.volumeInfo.title,
           component: BookDetail,
           passProps: {book}
       });
   }
}

export { BookList };
```
