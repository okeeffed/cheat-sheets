# React-Native Style Guide

### React Native Style Guide


#### General Guidelines

* Every component should be treated as an API.
* When in doubt, break up a component or function into smaller useful parts.

#### ES6 and ES7

The flavor of JS we use is based on ES5 but with ES6 and ES7 transforms. This means, that a large part of the syntax is based on the current version of JS, but is flavored with capabilities that come with ES6 and ES7. For example:

* Object destructing (ES6)
* Object spread (ES7)
* Rest and spread params (ES6)
* Promises (ES6)
* Arrow Functions (ES6)
* Object concise method (ES6)
* Object short notation (ES6)
* Classes (ES6)

For more information see [React Native JavaScript Environment](https://facebook.github.io/react-native/docs/javascript-environment.html#content)

#### Component Creation

Components should be created using ES6 classes and Object Short Notation.

```javascript

// Bad

var ChatBox = React.createClass({

  getInitialState: function(){
    return {toggle: 'on'};
  },

  render: function(){
    return (
      <Text> Example </Text>
    );
  }

})

// Good

class ChatBox extends React.Component{

  constructor(){
    this.state = {toggle: 'on'}
  }

  render(){
    return (
      <Text> Example </Text>
    );
  }

}

```

Component functions that are not life-cycle functions should be created with an underscore at the beginning of the function name.

```javascript

_fetchmessages(){
  fetch(requestURL)
    .then((response)=> response.json() )
    .then((responseData)=> {
      this.setState({messages: responseData})
    })
    .done();
}

_turnEditOn(){
  this.setState({edit: true});
}

```

Keep life-cycle functions at the top of the object constructor in logical order.

1. `constructor`
2. `componentWillMount`
3. `componentDidMount`
4. `componentWillReceiveProps`
5. `render`

For more information see [Component Specs and Lifecycle](https://facebook.github.io/react/docs/component-specs.html)

Every component function should be as parsimonious as possible. If you find yourself creating a function that is doing more than two things at once, then break up the function into smaller functions.

#### Using Bind

When passing a function as prop to a child component, the use of bind is not necessary. React Native automatically binds `this` to that function.

```javascript

// Bad

render(){
  return(
    <CameraButton
      selectImage={this.selectImage.bind(this)}
    />
  );
}

// Good

render(){
  return(
    <CameraButton
      selectImage={this.selectImage}
    />
  );
}

```

It necessary however to use bind, when passing a component function to an event prop. For example:

```javascript

<ListView
  renderRow={this.renderMessage.bind(this)}
/>

...

renderMessage(message) {
  return (
    <Message
      message={message}
      navigator={this.props.navigator}
      fetchMessages={this.fetchMessages.bind}
    />
  );
}

```

#### Passing Props

Explicitly pass props if the number of props is small or if the prop is important enough that you want to be explicit about it.

If there are a large number of props, pass in the whole thing or use destructuring to break it apart and pass them correctly.

```javascript

//Bad

<MessageBody
  content=this.props.message.content
/>
<MessageFooter
  replies=this.props.message.replies
  upvotes=this.props.message.upvotes
  timestamp=this.props.message.timestamp
  distance=this.props.message.distance
/>

// Good

var {content, ...footer} = this.props.message

<MessageBody {content} />
<MessageFooter {..footer} />

```

Sometimes you want to combine objects and pass them as props. In that case use `Object.assign`.

```javascript

_onPressMessage() {

  var {message, ...props} = this.props;
  var {votes, ...message} = this.props.message;
  var fetchMessages = this._updateHearts;

  this.props.navigator({
    component: Comments,
    passProps: Object.assign(
      {..props},
      {..message},
      {fetchMessages}
    ),
  })
}

```

For more information on passing props, see React Native [Transferring Props](https://facebook.github.io/react/docs/transferring-props.html)

#### State and Props

Props are immutable. Do not mutate them.

```javascript
// Bad

var component = <Component />;
component.props.foo = x;
component.props.bar = y;

```

State is mutable.

```javascript

constructor(){
  this.state = {messages:[]};
}

...

_addMessages(data){
  var messages = data.messages;
  this.setState({
    messages: this.state.messages.push(messages)
  })
}

```

Props can be passed into state, but be explicit that they are only 'initial values'

```javascript

constructor(props){
  var initialNum = this.props.numHearts;
  this.state = {numHearts: initialNum};
}

...

_handleClick(){
  this.setState({numHearts: this.state.numHearts + 1});
}

```

Be sure to  make use of `componentWillReceiveProps` to sync state and props, if props are passed to state.

```javascript

componentWillReceiveProps(props){
  this.setState({numHearts: props.numHearts});
}
```

# React Style Guide Cheet Sheet

## Custom Classes

- place custom functions above the render function.

```javascript
React.createClass({
  displayName : '',
  propTypes: {},
  mixins : [],
  getInitialState : function() {},
  componentWillMount : function() {},
  componentWillUnmount : function() {},
  _onChange : function() {},
  _onCreate : function() {},
  render : function() {}
});
```

## Conditional html

In JSX, anything in {} will be evaluated in JavaScript

```javascript
{this.state.show && 'This is Shown'}
{this.state.on ? ‘On’ : ‘Off’}
```

For anything more complicated, I have typically been creating a variable inside the render method, suffixed with ‘Html’:

```javascript
var dinosaurHtml = '';
if (this.state.showDinosaurs) {
  dinosaurHtml = (
    <section>
      <DinosaurTable />
      <DinosaurPager />
    </section>
  );
}

return (
  <div>
    ...
    {dinosaurHtml}
    ...
  </div>
);
```

## JSX as variable or return value

```javascript
var multilineJsx = (
  <header>
    <Logo />
    <Nav />
  </header>
);

var singleLineJsx = <h1>Simple JSX</h1>;
```

## Self-closing tags

Components without children should simply close themselves

** correct **

```javascript
<Logo />
```

** bad practise **

```javascript
<Logo></Logo>
```

## List Iterations

List iterations are better done inline, especially if each list item will be rendered as a component. You may even be able to reduce to one line with fat arrows.

** Note ** This does require the harmony flag on JSX to be included, which will toggle certain ES6 features (fat arrows, template strings, destructuring, and rest parameters)

```javascript
render : function() {
  return (
    <ul>
      {this.state.dinosaursList.map(dinosaur => <DinosaurItem item={dinosaur} />)}
    </ul>
  );
}
```

## Forms

```javascript
<form onChange={this.inputHandler}>
  ...
    <input type="text" name="newDinosaurName" value={this.state.newDinosaurName} />
  ...
</form>

// input handler

function(event) {
  actions.propagateValue({
    field : event.target.name,
    value : event.target.value
  });
}
```

## Formatting Attributes

Preferable
```javascript
<input
  type="text"
  value={this.state.newDinosaurName}
  onChange={this.inputHandler.bind(this, 'newDinosaurName')} />
```

Alternative
```javascript
<input type="text"
       value={this.state.newDinosaurName}
       onChange={this.inputHandler.bind(this, 'newDinosaurName')} />
```
