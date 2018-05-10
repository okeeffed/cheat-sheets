# EXPRESS BASICS

<!-- TOC -->

*   [EXPRESS BASICS](#express-basics)
    *   [EXP-1: Getting Started with Express](#exp-1-getting-started-with-express)

<!-- /TOC -->

## EXP-1: Getting Started with Express

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    1.  Installing express
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

For this example...

git clone https://github.com/hdngr/treehouse-express-basics.git

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    2.  Your first Express
        App
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

client: web browser
routes: urls for different pages

//in app.js

'use strict'; //throws error if you make one

var express = require('express'); //now can access all methods and properties of express through this.

var app = express();

//app variable will extended

//set up dev server

app.get('/', function(request, response) {
});

app.listen(3000);

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

3.  Improving your first app
    *   some findal touches

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Quick enhancements

'use strict'; //throws error if you make one

var express = require('express'); //now can access all methods and properties of express through this.

var app = express();

//app variable will extended

//set up dev server

app.get('/', function(req, res) { //req and res are convention
res.send("<h1>I Love Treehouse!<h1>");
});

app.listen(3000, function(){
console.log("The frontend server is running on port 3000!");
});

/////////////////////////////////////////////////////////

PART 2: DEVELOPING EXPRESS APPS LIKE A BOSS

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

4.  Adding Routes to the
    App

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Routes are an important part of Express.

We make can make some dummy json data for testing...

{
"I like to run!": {
"title": "I like to run!",
"description": "Fanny pack vinyl put a bird on it, small"
},
"Crossfit is cool!": {
"title": "Crossfit is cool!",
"description": "Fanny pack vinyl put a bird on it, small"
},
"Swimming is great for the joints": {
"title": "Swimming is great for the joints",
"description": "Fanny pack vinyl put a bird on it, small"
}
}

//app.js

'use strict'; //throws error if you make one

var express = require('express'); //now can access all methods and properties of express through this.
var post = require('./mock/posts.json');

var app = express();

//app variable will extended

//set up dev server

app.get('/', function(req, res) { //req and res are convention
res.send("<h1>I Love Treehouse!<h1>");
});

app.get('/blog', function(req, res) {
res.send(post);
});

app.listen(3000, function(){
console.log("The frontend server is running on port 3000!");
});

QUESTIONS

/////////////////////////////////////////////

Create a get method for a /blog html extension.

Use the send method on the response object to return the posts object when the /blog route is requested.

'use strict';

var express = require('express');
var posts = require("./mock/posts.json");

var app = express();

app.get('/', function(req, res){
res.send("<h1>I Love Treehouse!</h1>");
});

app.get('/blog', function (req, res) {
res.send(posts);
});

app.listen(3000, function(){
console.log("The frontend server is running on port 3000!")
});

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

4.  Easily Debug Express

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

-   Programming it iterative.

Nodemon not needing to stop and restart the server.

Node-inspector is great for debugging.

nodemon is like a replacement for the keyword node!

nodemon src/app //this will start a node.js app which restarts when changes are made.

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

5.  Interactive Debugging
    and explorative programming

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

node-debug src/app.js

*   this launches node inspector in debug mode.

*   select in the body of the route to set a breakpoint.
*   access in the Chrome debugger

To put node-debugger and nodemon together.

Do this:
node-inspector //run this by itself. Won't run the server.

//in a seperate tab
nodemon --debug src/app

You can do the same thing with the regular node command - but with no server restart

node --debug src/app

Passing the breakpoint to the nodemon comment

nodemon --debug-brk src/app

*   this will hit the debugger; statement.

QUESTIONS:

1.  When the debugger breaks in the application, you have access to all variables in the current application context in the browser’s console.

A: True

2.  What command will runs the node app in “debug” mode?

A: nodemon --debug src

3.  `node-inspector` can be used to run node apps directly OR to debug node apps being run in debug mode

A: True

4.  A breakpoint in a JavaScript application can be set by clicking on the line of a file in the browser console, or writing the **\_** statement directly into your code.

A: debugger;

5.  The following command will break the debugger on the first line

A: nodemon --debug-brk src/app

/////////////////////////////////////////////

PART 3: THE REQUEST AND RESPONSE OBJECTS IN EXPRESS

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    6.  Requests and the
        request objects
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

-   Every route processes a request

So far, index AND blog route.

The server catches the http request, then sends back as a JS request object

In the debug mode:

req.param in debug currently empty. Can run the paramter through our routes!

eg.
app.get('/blog/:id', function(req, res) {
res.send(post);
});

Visiting .../blog/1 will set the id param to "1" etc

You can change the parameter names to be things like "title" or whatever you want.

QUESTIONS

////////////////////////

1.  The request object gives you access to the “hostname” where the server is serving from.

A: True

2.  Express route parameters allow you to request different data simply by changing the \_\_\_\_.

A: URL

3.  The request object is like a JavaScript bundle of the incoming **\_\_**

A: HTTP Request

4.  The request object stores route parameters in the parameters object.

A: False

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    7.  Responses and the
        Response Object
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

The server sends back the response.

This includes HTML and tons of behind the scenes info.

*   status codes, response info etc.

Using the debugger:

res //a lot going on

*   this gives a lot of return details

Add a question mark makes the route param optional.

app.get('/blog/:title?', function(req, res) { //now we can access the blog page when it is empty
var title = req.params.title;
if (title === undefined) {
res.send("This page is under construction");
} else {
var post = posts[title];
res.send(post);
}
});

res.get

QUESTIONS

////////////////////////////

1.  In express the \_\_\_ character at the end of a route parameter indicates that it is optional.

A: ?

2.  Status codes can be set manually on the response object.

A: True

3.  The response object’s **\_** method is used to turn templates into HTML.

A: render

/////////////////////////////////////////////

PART 4: USING TEMPLATES WITH EXPRESS

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    7.  What is Template
        Rendering
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Templates and template rendering at the core of an internet application framework.

res.send can send things to the browser.

Can also send back html.

Basically a example.html that can dynamically injected

This templates are referred to as VIEWS.

Popular template languages:

*   Handlebars
*   EJS (Embedded Javascript)
*   JADE // the most popular

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    8.  What is Jade?
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Most popular template engines for Node and Express.

Why do they love it?

It quickly uses block indents for taggings.

Examples:

doctype html
html
head
title Express Basics
body
h1 This is an awesome HTML page, generated with Jade.
p.class1.class2.another-class //used to make classes
p.(class="test") Some content

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

9.  Using Jade in your
    Express App

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

How to configure your template to use Jade.

//app.js

'use strict'; //throws error if you make one

var express = require('express'); //now can access all methods and properties of express through this.
var posts = require('./mock/posts.json');

var app = express();

//app variable will extended

//set up dev server

app.set('view engine', 'jade');
app.set('views', **dirname + '/templates'); //**dirname important for different directories from where node starts

app.get('/', function(req, res) { //req and res are convention
res.render('index');
});

app.get('/blog/:title?', function(req, res) { //now we can access the blog page when it is empty
var title = req.params.title;
if (title === undefined) {
res.status(503); //good for bots to see this status codes
res.send("This page is under construction");
} else {
var post = posts[title];
res.send(post);
}
});

app.listen(3000, function(){
console.log("The frontend server is running on port 3000!");
});

QUESTIONS

1.  In node.js, `__dirname` is a variable that gives you:

A: The path to the current file

2.  Which of the following is NOT a conventional folder name for storing templates

A: jade

3.  In Jade's syntax, which of the following is NOT a correct assignment of the class `nav` to a `div`

4.  The response object's `render` method takes the name of a template as its first parameter. The file extension (e.g. `.jade`) is required.

A: False

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

10. The "response.render"
    Method

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

So far, still only been using static data.

doctype html
html(lang="en")
head
title Post Page
body
section.post
.container.text-right
a(href="").text-faded view all
.row
.col-lg-8.col-lg-offset-2.text-center
h2.section-heading I like to run!

            hr.light

            p.text-faded
              | Fanny pack vinyl put a bird on it, small batch viral migas 8-bit meditation Shoreditch keytar health goth bespoke sustainable. Viral you probably haven't heard of them try-hard ennui, pug Thundercats selfies. Normcore cray health goth, umami ennui beard art party skateboard squid distillery.
            .article
              | Fanny pack vinyl put a bird on it, small batch viral migas 8-bit meditation Shoreditch keytar health goth bespoke sustainable. Viral you probably haven't heard of them try-hard ennui, pug Thundercats selfies. Normcore cray health goth, umami ennui beard art party skateboard squid distillery.

//app.js

'use strict'; //throws error if you make one

var express = require('express'); //now can access all methods and properties of express through this.
var posts = require('./mock/posts.json');

var app = express();

//app variable will extended

//set up dev server

app.set('view engine', 'jade');
app.set('views', **dirname + '/templates'); //**dirname important for different directories from where node starts

app.get('/', function(req, res) { //req and res are convention
res.render('index');
});

app.get('/blog/:title?', function(req, res) { //now we can access the blog page when it is empty
var title = req.params.title;
if (title === undefined) {
res.status(503); //good for bots to see this status codes
res.send("This page is under construction");
} else {
var post = posts[title] || {};
res.render('post', { post: post});
}
});

app.listen(3000, function(){
console.log("The frontend server is running on port 3000!");
});

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    11. Scaffolding the
        Templates
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

-   Name your templates well
-   Helps everyone for their team

in the layout.jade

block content //add more renderhtml from here

To add the content from layout.jade:

extends ./layout.jade
block content //again

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    12. Adding Partials
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Too much code in the layout file with the nav etc.

Solve by moving everything in a partial called nav.

*   make partials directors

First file will be \_nav.jade

_ - not used on its own! Sass usually uses this _ naming convention before.

To use partial:
include ./partials/\_nav.jade

QUESTIONS:

1.  Keeping your project's views/templates folder well organized is an important part of scaling your project.

A: True

2.  Jade uses the **\_\_** keyword to break chunks of content up for use across different files, or to be changed dynamically.

A: 'block' e.g. 'block content'

3.  Partials are useful for including portions of a page like navbars and footers, that are the same, or almost the same across a number of pages.

A: True

/////////////////////////////////////////////

PART 5: SERVING STATIC FILES IN EXPRESS

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
          	13. Setting Up the
    Express Static Server
    in Development
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Static files: sent to client as is eg. images etc.

public dir:

*   Contains other folders:
    css
    js
    img etc.

Middleware:

Middleware the logic on how to handle the a request in between when made by client but before it arrives at the route.

*   included in Express.

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    14. Add static to
        the layout template
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Adding styles and js is easy.

In the head.jade template, punch through all of it.

link() in the head.jade

script() in the body.jade at the end

Notes:

Convention for static files is that they're stored in public.

/////////////////////////////////////////////

PART 6: DOING MORE WITH EXPRESS

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    15. Marking Lists
        in Jade Templates
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

In the blog...

res.render('index')

We need files to be in an array from the .json file.

*   eg.

var postsLists = Object.keys(posts).map(function(value) {
return posts[value];
});

*   map turns each array member into something that can have a callback function which can return the value.

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

16. Using logic in Jade

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

Powerful to just have one nav bar to edit and change.

So in Jade...

if path === '/'
//indent everything to be here

If something doesn't fit and is undefined, then it is false.

in app.js
//for the index

app.get('/', function(req, res) {
var path = req.path;
//res.locals.path = path;
//res.render('index');

    //OR

    res.render('index', {path: path});

});

QUESTIONS

1.  The `res.locals` object stores

A: Variables that will be accessible in the template

2.  In the case of the Jade if block `if path === '/'`, the block's content would NOT be displayed in which of the following scenarios

A: /blog

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*

17. Use Express Generator

*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

We don't have to build an Express app from scratch

npm install -g express-generator

express <appname>

npm start //this is a script

Instead of templates, it has views

/****\*\*\*\*****\*\*\*\*****\*\*\*\*****

*         					*
    18. REST APIs
*         					*
    ****\*\*\*\*****\*\*\*\*****\*\*\*\*****/

app.get('/posts', function(req,res) {
if (req.query.raw) {
res.json(posts);
} else {
res.json(postLists);
}
});

To allow to access as a hash:

*   We can have /posts?raw=true
