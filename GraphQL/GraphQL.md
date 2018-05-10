# GraphQL - Udemy

<!-- TOC -->

- [GraphQL - Udemy](#graphql---udemy)
    - [RESTful Router Primer](#restful-router-primer)
    - [The shortcomings of RESTful routing](#the-shortcomings-of-restful-routing)
        - [Complex example](#complex-example)
    - [Starting with GraphQL](#starting-with-graphql)
    - [Working with GraphQL](#working-with-graphql)
    - [Registering GraphQL with Express](#registering-graphql-with-express)
    - [GraphQL Schemas](#graphql-schemas)
    - [The Graphiql tool](#the-graphiql-tool)
    - [A realistic data source](#a-realistic-data-source)
    - [Async Resolve functions](#async-resolve-functions)
- [How do we hook up relating a company to a user?](#how-do-we-hook-up-relating-a-company-to-a-user)
    - [Updating the Schema](#updating-the-schema)
    - [Multiple Root Query Points](#multiple-root-query-points)
    - [Bidirectional Relations](#bidirectional-relations)
    - [Query Fragments](#query-fragments)
    - [Mutations](#mutations)
        - [Non-null fields and Mutations](#non-null-fields-and-mutations)
        - [Deleting mutations](#deleting-mutations)
        - [Editing mutations](#editing-mutations)
    - [GraphQL Clients - Apollo vs Relay](#graphql-clients---apollo-vs-relay)
        - [Apollo Server vs GraphQL Server](#apollo-server-vs-graphql-server)
        - [Setting up MongoLab](#setting-up-mongolab)
        - [Running the project](#running-the-project)
        - [Setting up Apollo Client](#setting-up-apollo-client)
        - [GQL Queries in React](#gql-queries-in-react)
        - [Bonding queries with components](#bonding-queries-with-components)
        - [Handling Pending Queries](#handling-pending-queries)
        - [Adding React Router](#adding-react-router)
    - [Mutations in React](#mutations-in-react)
        - [Query Params](#query-params)
        - [Passing variables in React](#passing-variables-in-react)
        - [Refetching Lists](#refetching-lists)
        - [Deletion mutations](#deletion-mutations)
        - [Fetching a particular item](#fetching-a-particular-item)
        - [Adding fetchSong to the component](#adding-fetchsong-to-the-component)
        - [Watching for Data](#watching-for-data)
        - [More action submitting](#more-action-submitting)
        - [Submitting the lyrics](#submitting-the-lyrics)
        - [Extending Queries](#extending-queries)
    - [Caching with dataIdFromObject](#caching-with-dataidfromobject)
    - [More on Mutations](#more-on-mutations)
        - [Optimistic mutations](#optimistic-mutations)
- [Authentication Applications - concerned with both the front and back end](#authentication-applications---concerned-with-both-the-front-and-back-end)
        - [Delegating to an Authentication Service](#delegating-to-an-authentication-service)
    - [Handling Errors Gracefully](#handling-errors-gracefully)
        - [Handling Errors Around Signup](#handling-errors-around-signup)

<!-- /TOC -->

## RESTful Router Primer

*   Given a collection of records on a server, there should be a uniform URL and HTTP request method used to utilize that collection of records.

Having the ability to use CRUD requests to interact with data on the server.

There are more than just POST, GET, PUT and DELETE methods, but they are the most common.

So far, we have just looked at how to manipulate single records.

Handling users may look like `/users`, handling posts from that user may be `/users/23/posts` - get may then start deepening even further.

## The shortcomings of RESTful routing

There are no hardcoded set of rules, just a set of conventions.

### Complex example

Think of a Facebook grid where the users are lined up with things like a user image, name, company name and position name. How might we store this data in the table?

Maybe create a User model? But also maybe no the ideal way to do it.

It would not be obvious to get all the company names back.

Maybe as an alternative schema, we would start build out a relational schema.

Given that, how do we now build out a URL RESTful route in order to get all of this data.

So far for `Current User > Friend > Company || Position`, we might be able to start with `/users/23/friends` - but then how do we get the company or the position for the deeper nested URL?

Maybe we could do `users/1/companies` which could get back the ID for the company, a similiar thing for the position etc. Alternatively, maybe `/users/23/friends/[companies|positions]`. The problem with these endpoints is that they are all very particular.

How about if we broke all conventions and went with `/users/23/friends_with_companies_and_positions`? We are definitely breaking conventions here.

Once we even do make the particular request, we might get a bunch of data from the tables that we don't even care about. This could be dramatically overserving or we may need to continually add or edit the RESTful end points.

## Starting with GraphQL

Now that we've seen the shortfalls of RESTful routing, let's see how GraphQL can help us out.

Let's now imagine we know all the data in this theoretical database. When we think about the `graph` that all the relations between all this data makes and the relations between them (nodes and edges), understanding how the data fits into the structure is key to understanding how GraphQL works. NOTE we can still use any database we want - use this as an understanding.

Now, if we take this graph and assign an ID to each of our users and organised the data, we can query it using GraphQL.

```
// start with user 23 - find all their friends
// and all the companies that those friends work at

1. Tell GraphQL find user 23
2. Find all friends of user 23
3. Tell GraphQL to find the company associated

// the query that could do this
// crawl along the query
query {
	user(id: "23") {
		friends {
			company {
				name
			}
		}
	}
}
```

## Working with GraphQL

How can we get this to come together?

1.  Make an Express server and hook it up to a datastore
2.  Hook it up to a prebuilt app called GraphiQL to make a couple of test queries

For installation on the test `users` project, let's `yarn add express express-graphql graphql lodash`

## Registering GraphQL with Express

Once you have set up a basic Express server, we can look at how to make GraphQL work with Express.

Process of the app

```
1. Web page makes a request to the Server
2. Server decides whether it asks for Graphql
	- if yes, GraphQL before 3
	- if no, go to 3
3. Respond
```

GraphQL is just one little part of the Express app.

```
// hooking up GraphQL
const express = require('express');
const expressGraphQL = require('express-graphql');

const app = express();

app.use('/graphql', expressGraphQL({
	graphiql: true
}));

app.listen(4000, () => {
	console.log('listening on 4000');
});
```

## GraphQL Schemas

Using this middleware (using the "use" Express instance method), we passed in an options object. We need to also pass a schema along with these options.

We can do all this inside of a schema js file.

If we decide the `user` schema as such that is has an `id, firstName company_id, position_id and users [id]`, we can the picture our relational shema.

**Writing the schema**

Not the easiest the write, but as we continual to work with GraphQL, it'll start to become more and more of the same.

```
// schema.js

const graphql = require('graphql');

const {
	GraphQLObjectType,
	GraphQLString,
	GraphQLInt
} = graphql;

const UserType = new GraphQLObjectType({
	name: 'User',
	fields: {
		id: { type: GraphQLString },
		firstName: { type: GraphQLString },
		age: { type: GraphQLInt }
	}
});
```

**Root Query**

We need to pass something into the root query eg. "Hey, give me the user with id 23". We can think of it like an "entry point" into our data.

We can tell the 'root query' what we can ask about.

Below with the `resolve()` function, the parentValue is not used often, and the args are the args that we provide.

```
// in GraphQL
const RootQuery = new GraphQLObjectType({
	name: 'RootQueryType',
	fields: {
		user: {
			type: UserType,
			args: { id: { type: GraphQLString } },
			resolve(parentValue, args) {

			}
		}
	}
});
```

**Querying for data**

Instead of using a database, we're just going to hard code some users for now.

```
// top of the schema.js file

const users = [
	{ id: '23', firstName: 'Bill', age: 20 },
	{ id: '47', firstName: 'Sam', age: 21 }
];

// in the query
const RootQuery = new GraphQLObjectType({
	name: 'RootQueryType',
	fields: {
		user: {
			type: UserType,
			args: { id: { type: GraphQLString } },
			resolve(parentValue, args) {
				// use lodash to find
				return _.find(users, { id: args.id });
			}
		}
	}
});
```

To pass this schema back to express, we destructure import `GraphQLSchema` and at the bottom of the file we pass the root query.

```
new GraphQLSchema({
	query: RootQuery
});
```

## The Graphiql tool

This tool has been given to us by the GraphQL team. On the left hand side, we can write a query and run it to see what happens.

The `docs` auto generates docs for us to see the type of queries we can make.

```
// making the query
// note: this is not JS
{
  user(id: "23") {
    id,
    firstName,
    age
  }
}

// what is returns
{
  "data": {
    "user": {
      "id": "23",
      "firstName": "Bill",
      "age": 20
    }
  }
}
```

So with the query, it heads to the `RootQueryType` and enter into the graph of data. Since we declared `user` on the query, it checks the `user` field in the RootQuery below.

With the args, we say that it expects an `id` of type string of what we did, so what it then does with the lodash find method we added is that it looks within users for the id that matches the argument ID.

Lodash returns a raw JSON object directly since the return handles objects for us.

```
const RootQuery = new GraphQLObjectType({
	name: 'RootQueryType',
	fields: {
		user: {
			type: UserType,
			args: { id: { type: GraphQLString } },
			resolve(parentValue, args) {
				// use lodash to find
				return _.find(users, { id: args.id });
			}
		}
	}
});
```

With the query, we can also now reduce and only call for the data that we want.

If we do not find an valid `id`, we will get null back. If there is no arg to the query, we get an error where it expects the `name of an argument`.

## A realistic data source

So we don't really want to use a static list of users - because that's not realistic. So let's use some different architectures that we can use to use GraphQL with.

We could the server which hosts GraphQL and then any database.

If it's any small sized project, we could use Express etc. With larger companies, you won't use a single monolithic store, but the same Express/GraphQL Server will touch bases with a variety of databases and can act as a proxy of sorts to go and collect this data from those different datasources.

What we can do is have an outside server to give us some data in our current approach.

That way, we will need to spin up a second server. We can use JSON server to act as another source of data.

For the outside API, we can use `json-server`. Spin up a server create a `db.json` file in order to do so.

## Async Resolve functions

```
const RootQuery = new GraphQLObjectType({
	name: 'RootQueryType',
	fields: {
		user: {
			type: UserType,
			args: { id: { type: GraphQLString } },
			resolve(parentValue, args) {
				return axios.get(`http://localhost:3000/users/${args.id}`)
					.then(res => res.data);
			}
		}
	}
});
```

# How do we hook up relating a company to a user?

Given a schema of `id, name and description`, how can we relate a user and their company?

First with db.json, update the file to have companies.

Once we have...

```json
{
    "users": [
        { "id": "23", "firstName": "Bill", "age": 20, "companyId": "1" },
        { "id": "47", "firstName": "Sam", "age": 21, "companyId": "2" },
        { "id": "41", "firstName": "Milly", "age": 41, "companyId": "2" }
    ],
    "companies": [
        { "id": "1", "name": "Apple", "description": "iPhone" },
        { "id": "2", "name": "Google", "description": "Search" }
    ]
}
```

We can now see the `/companies` url can give us a company. To get JSON server to show us who works where, `json-server` works the relationship out at `companies/1/users`.

## Updating the Schema

Now in the schema we can update to have the following.

```javascript
const CompanyType = new GraphQLObjectType({
    name: 'Company',
    fields: {
        id: { type: GraphQLString },
        name: { type: GraphQLString },
        description: { type: GraphQLString }
    }
});

const UserType = new GraphQLObjectType({
    name: 'User',
    fields: {
        id: { type: GraphQLString },
        firstName: { type: GraphQLString },
        age: { type: GraphQLInt },
        // note: this is from the previously declared type
        company: { type: CompanyType }
    }
});
```

Why can we get away with saying a related `company` and not `companyId`. Where the difference is, the `resolve` function will help with the resolution.

## Multiple Root Query Points

Currently, we cannot just find a company by itself. Only the user using the id.

We can adjust this with adding to the Root Query.

```javascript
const RootQuery = new GraphQLObjectType({
    name: 'RootQueryType',
    fields: {
        user: {
            type: UserType,
            args: { id: { type: GraphQLString } },
            resolve(parentValue, args) {
                return axios
                    .get(`http://localhost:3000/users/${args.id}`)
                    .then((res) => res.data);
            }
        },
        company: {
            type: CompanyType,
            args: { id: { type: GraphQLString } },
            resolve(parentValue, args) {
                return axios
                    .get(`http://localhost:3000/companies/${args.id}`)
                    .then((res) => res.data);
            }
        }
    }
});
```

## Bidirectional Relations

Given the one-to-many relationship we can find between companies and users, how can find the users that work for a company?

We can use a `GraphQLList` to return a list of different entities.

The circular reference order of operations issue requires a little work around. We can use a lexical arrow function to give lexical scope. Using this, it will ensure the entire file is executed beforehand.

The issue itself is more of closures and closure scopes.

```javascript
const CompanyType = new GraphQLObjectType({
    name: 'Company',
    fields: () => ({
        id: { type: GraphQLString },
        name: { type: GraphQLString },
        description: { type: GraphQLString },
        users: {
            // UserType may not yet be defined error may occur
            // because of a circular reference
            type: new GraphQLList(UserType),
            resolve(parentValue, args) {
                return axios
                    .get(
                        `http://localhost:3000/companies/${
                            parentValue.id
                        }/users`
                    )
                    .then((res) => res.data);
            }
        }
    })
});
```

Now that we have circular relations, we can build back nested circular relations as we go.

## Query Fragments

How does the syntax work and how can we expand upon it?

You could also add the `query` to a query to acknowledge

```
query findCompany {
	company(id: "2") {
    name
    users {
      id,
      firstName
        company {
          name
        }

    }
  }
}
```

With the Root Query, each field is like an optional query to make.

We can also ask for as many companies as we like, however we need to name the response so there are no JSON duplicate keys on the return:

```
{
  apple: company(id: "1") {
    name
    users {
      id,
      firstName
        company {
          name
        }

    }
  },
  google: company(id: "2") {
    name
    users {
      id,
      firstName
        company {
          name
        }

    }
  }
}
```

**Query Fragments**

In the above, we list out the name, users etc twice.

A query fragment is a list of different properties we want to get back. These are seen a lot on the front end.

```
{
	google: company(id: "2") {
    ...companyDetails
  },
  apple: company(id: "1") {
    ...companyDetails
  }
}

fragment companyDetails on Company {
	name
    users {
      id,
      firstName
        company {
          name
        }

    }
}
```

## Mutations

Now that we've set up the ability to read data, we haven't spent anything on modifying the datastore.

They're notorious for being a bit more challenging to work with.

The `json-server` has support for updating records.

In order for updating, we create completely separate objects that we can manipulate in `schema.js`.

```javascript
const mutation = new GraphQLObjectType({
    name: 'Mutation',
    fields: {}
});
```

### Non-null fields and Mutations

Given our application at the moment, it probably makes sense that all of these users we add with this mutation have a `firstName` and `age`. We can use `GraphQLNonNull` as a wrapper object to ensure the value is non-null.

Make sure you import it.

```
const mutation = new GraphQLObjectType({
	name: 'Mutation',
	fields: {
		addUser: {
			// not always returning the same type
			// that we work on
			type: UserType,
			args: {
				firstName: { type: new GraphQLNonNull(GraphQLString) },
				age: { type: new GraphQLNonNull(GraphQLInt) },
				companyId: { type: GraphQLString }
			},
			resolve(parentValue, { firstName, age }) {
				return axios.post(`http://localhost:3000/users`, {
					firstName,
					age
				}).then(res => res.data);
			}
		}
	}
});
```

As for using the mutation:

```
// in graphiql
mutation {
	addUser(firstName: "Stan", age: "26") {
		// we must ask for some property coming back
		id,
		firstName,
		age
	}
}
```

### Deleting mutations

This will be different since you should take a shot.

```
const mutation = new GraphQLObjectType({
	name: 'Mutation',
	fields: {
		addUser: {
			// not always returning the same type
			// that we work on
			type: UserType,
			args: {
				firstName: { type: new GraphQLNonNull(GraphQLString) },
				age: { type: new GraphQLNonNull(GraphQLInt) },
				companyId: { type: GraphQLString }
			},
			resolve(parentValue, { firstName, age }) {
				return axios.post(`http://localhost:3000/users`, {
					firstName,
					age
				}).then(res => res.data);
			}
		},
		deleteUser: {
			type: UserType,
			args: {
				id: { type: new GraphQLNonNull(GraphQLString) }
			},
			resolve(parentValue, { id }) {
				return axios.delete(`http://localhost:3000/users/${id}`, { id })
					.then(res => res.data);
			}
		}
	}
});
```

### Editing mutations

Reminder: difference between a `put` and `patch` request.

A `put` request is used when we want to **completely** replace a record, whereas a `patch` request does not replace it completely, but forms the updates.

```
const mutation = new GraphQLObjectType({
	name: 'Mutation',
	fields: {
		addUser: {
			// not always returning the same type
			// that we work on
			type: UserType,
			args: {
				firstName: { type: new GraphQLNonNull(GraphQLString) },
				age: { type: new GraphQLNonNull(GraphQLInt) },
				companyId: { type: GraphQLString }
			},
			resolve(parentValue, { firstName, age }) {
				return axios.post(`http://localhost:3000/users`, {
					firstName,
					age
				}).then(res => res.data);
			}
		},
		deleteUser: {
			type: UserType,
			args: {
				id: { type: new GraphQLNonNull(GraphQLString) }
			},
			resolve(parentValue, { id }) {
				return axios.delete(`http://localhost:3000/users/${id}`, { id })
					.then(res => res.data);
			}
		},
		editUser: {
			type: UserType,
			args: {
				id: { type: new GraphQLNonNull(GraphQLString) } ,
				firstName: { type: GraphQLString },
				age: { type: GraphQLInt },
				companyId: { type: GraphQLString }
			},
			resolve(parentValue, args) {
				return axios.patch(`http://localhost:3000/users/${args.id}`, args)
					.then(res => res.data);
			}
		}
	}
});
```

As for the mutation itself for editing:

```
mutation {
	editUser(id: "23", age: 10) {
		id,
		firstName,
		age
	}
}
```

## GraphQL Clients - Apollo vs Relay

So far we've limited everything to a client, but we haven't been able to put this data to the end user.

Let's take what we know and integrate it with a frontend framework.

In Graphiql, we can actually watch the `xhr` requests in the `Network` tab and can see everything that we get back etc. That way the data we get back it just the plain, raw data.

If we go down to request payload on the `Headers` tab, we can see the payload that we make. We can notice that even the query itself is the same as what we write in Graphiql.

The idea of having a front end app with a client is to do basically the same exact thing as we are currently seeing in the Graphiql client. The client itself should be that bonding layer.

With clients, there are basically three main ones we will discuss. `Lokka` being the simplest, `Apollo` built by the guys at Meteor JS - good balance between features and complexity. The downside of this is that they have huge experience with GraphQL clients. `Relay` is by far the most complex. `Relay` is officially used by the Facebook team. Things like mutations etc are 10x more difficult for mutations than what we've previously discussed. It makes sense for larger teams, although maybe not so much for smaller teams.

As of the current writing, it is at version one - they are in progress with version two.

In this course, the focus will be on `Apollo`.

### Apollo Server vs GraphQL Server

We are using GraphQL tech on both the frontend and the backend. There is an Apollo server you can make use of, but instead we will used `express-graphql`.

When is comes to the Apollo server "schema" set up, they split what we do in `GraphQL Express` into a `Types` and `Resolves` file (for the server side).

The FOLLOWING section is about how to set up GraphQL on the client side before getting them to communicate.

This app will use the Mongo Lab custom URL.

### Setting up MongoLab

Head onto MongoLab and then create a new free sandbox, then go find the address URI that we need from the info.

Ensure that you also add a `User` for the database.

### Running the project

Start by adding a song using a `mutation`.

```
mutation {
	addSong(title:"I want to know what love is") {
    id
  }
}

// once we have the songId, add a lyric in
mutation {
	addLyricToSong(content:"I want to know what loves is, I want you to show me!", songId:"5933a3ebcac9e6b57aad7f76") {
    id
    title
    lyrics {
      id
    }
  }
}

// now we can query something!
query {
	songs {
    id,
    title,
    lyrics {
      content
    }
  }
}
```

### Setting up Apollo Client

In the front end, how do we wrap our `React` application with helpers from the Apollo library?

The React app will have an Apollo Provider that talks back and forth with the Apollo Store. That in turn will talk to the GraphQL Server. The store will also `store` the data that comes back from the GraphQL Server.

The Apollo Store also doesn't care about the fact that we are using React. The Apollo Provider is what helps provide the data to the React application. Think of it as the `glue` layer.

For future projects, you will need to install `apollo-client`, `react-apollo`, `graphql-tag` and maybe `connect-mongo` if you are using a third party store. The following imports are required for the app.

In the code below, we have even passed an empty object to the ApolloClient - it can make assumptions. The store assumes that you are using `/graphql` route if you are passing in the object. If you deviate, you will need to start updating the config of this object.

```
import ApolloClient from 'apollo-client';
import { ApolloProvider } from 'react-apollo';

const client = new ApolloClient({});

const Root = () => {
	return (
		<ApolloProvider client={client}>
			<div>Lyrical</div>
		</ApolloProvider>
	);
};
```

In opposition, `Relay` requires a bunch of configuration to start up and have a working provider.

We can create a basic `SongList` component.

### GQL Queries in React

So the benefit of GraphQL again, you don't have to "overfetch".

GraphQL + Apollo take care of everything for us - we just need to bond the query and the component!

Once we have the query that we want, we can add the query into the component. That being said, queries are not valid JS. So what we will do is use `graphql-tag`.

`gql` is a helper to help us write files.

Making a query will look like so...

```
const query = gql`
	{
		songs {
			title
		}
	}
`;
```

### Bonding queries with components

In the component, `import { graphql } from 'react-apollo';`. After wrapping the export, we should have a component that may look like this:

```
import React, { Component } from 'react';
import gql from 'graphql-tag';
import { graphql } from 'react-apollo';

class SongList extends Component {
	render() {
		return (
			<div>
				SongList
			</div>
		);
	}
}

const query = gql`
	{
		songs {
			title
		}
	}
`;

// first parenthesis returns a function
// that is immediately invocated again
export default graphql(query)(SongList);
```

Now when the component is rendered, it will show up with no data until the query completes and then the data is resolved.

The data return is then kept within the component `props` field.

### Handling Pending Queries

The props handed in is `data` from `react-apollo` and `graphql` and we can access the return values from `this.props.data.[name]`.

We need to set some initial props value before we gets our GraphQL results back.

### Adding React Router

Note: ApolloProvider wraps the Router itself.

```
import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, hashHistory, IndexRoute } from 'react-router';
import ApolloClient from 'apollo-client';
import { ApolloProvider } from 'react-apollo';
import SongList from './components/SongList';
import App from './components/App';

const client = new ApolloClient({});

const Root = () => {
	return (
		<ApolloProvider client={client}>
			<Router history={hashHistory}>
				<Route path="/" component={App}>
					<IndexRoute component={SongList} />
				</Route>
			</Router>
		</ApolloProvider>
	);
};

ReactDOM.render(
  <Root />,
  document.querySelector('#root')
);
```

## Mutations in React

When adding a track using a component, we want to use a form a submit action to post that data.

That being said, how can we create the mutation on the `onSubmit` event?

### Query Params

In order to complete our `gql` mutation constant, we can make use of query variables.

A mutation that takes params can be like so:

```
mutation AddSong($title: String) {
	addSong(title: $title) {
		id
		title
	}
}

// in Graphql under query varibles, we can pass an object
{
	"title": "Desperado"
}
```

### Passing variables in React

First, set the mutation.

```
const mutation = gql`
	mutation addSong($title: String) {
		addSong(title: $title) {
			id,
			title
		}
	}
`;
```

Second, we can use a GraphQL helper like `export default graphql(mutation)(SongCreate);` - however, when we wrap a mutation, it forms a mutate function as part of this.props under `mutate`. Now, for the `onSubmit` function we have:

```
onSubmit(e) {
	e.preventDefault();
	console.log(this.props);
	// point of time when we
	// want to add a new song
	this.props.mutate({
		variables: {
			title: this.state.title
		}
	});
}
```

### Refetching Lists

How do we get Apollo to refetch the query?

We can actually do it after the mutation. Using `this.props.mutate` takes variables but can also take `refetchQueries`.

In practice, we do not refetch queries. What we will do is pull out queries from the component files and import it from another queries file.

```javascript
onSubmit(e) {
		e.preventDefault();
		console.log(this.props);
		// point of time when we
		// want to add a new song
		this.props.mutate({
			variables: {
				title: this.state.title
			},
			// need to pass in the exact query
			// can also pass variables: {} if we need them
			refetchQueries: [{ query: fetchSongsQuery }]
		}).then(() => hashHistory.push('/'));
	}
```

The GraphQL helper also knows not to rerun the same query twice too.

### Deletion mutations

```
mutation DeleteSong($id: ID) {
	deleteSong(id: $id) {
		id
	}
}
```

The `export default grahpql` can only take query at a time. So we need to create multiple instances of the `graphql` helper.

```
export default compose(
	graphql(deleteSongQuery),
	graphql(fetchSongsQuery)
)(SongList);
```

Setting this as our class allows for deletion:

```javascript
class SongList extends Component {
    onSongDelete(id) {
        // refetch will fetch any queries
        // with this component
        this.props
            .mutate({ variables: { id } })
            .then(() => this.props.data.refetch());
    }

    renderSongs() {
        return this.props.data.songs.map(({ title, id }) => {
            return (
                <li key={id} className="collection-item">
                    {title}
                    <i
                        className="material-icons"
                        onClick={() => this.onSongDelete(id)}
                    >
                        delete
                    </i>
                </li>
            );
        });
    }

    render() {
        console.log(this.props);
        if (this.props.data.loading) {
            return <div>Loading...</div>;
        }
        return <ul className="collection">{this.renderSongs()}</ul>;
    }
}
```

**Why `refetch` vs `refetchQueries`?**

Depends on how you're trying to update your query. If you refetch something not associated with the component, you would use refecthQueries. The `refetch` function would not have been available.

### Fetching a particular item

After creating a new song component, just in React Router and throw in the new route `songs/:id` - id being the wildcard.

Now in GraphiQL, just like mutations, we can make queries with query variables.

In a similar pattern:

```
query SongQuery($id: ID!) {
	song(id: $id) {
    	id
    	title
  }
}

// query var
{
  "id": "5933a3ebcac9e6b57aad7f76"
}

// query js file
import gql from 'graphql-tag';

export default gql`
query FetchSong($id: ID!) {
	song(id: $id) {
    id
    title
  }
}
`;
```

To get the access to React Router parameters, we can see how `React Router` wraps the entire app. If we `console.log(this.props)` and check `params`, we will see that the params are in fact stored there.

### Adding fetchSong to the component

```javascript
import React, { Component } from 'react';
import { graphql } from 'react-apollo';
import FetchSong from '../queries/fetchSong';

class SongDetail extends Component {
    render() {
        console.log(this.props);
        return (
            <div>
                <h3>SongDetail!</h3>
            </div>
        );
    }
}

export default graphql(FetchSong)(SongDetail);
```

So one gotcha we run into with the `graphql()()` wrapper is that we need an `id`.

The problem is that GraphQL makes fetch queries automatically, as opposed to mutations.

With GraphQL React-Apollo, we can do the following:

```
export default graphql(FetchSong, {
	options: (props) => { return { variables: { id: props.params.id } } }
})(SongDetail);
```

This will allow us to map `react-router` to `react-apollo`.

### Watching for Data

First, handle if no song yet exists.

```javascript
import React, { Component } from 'react';
import { graphql } from 'react-apollo';
import { Link } from 'react-router';
import FetchSong from '../queries/fetchSong';

class SongDetail extends Component {
    render() {
        console.log(this.props);
        const { song } = this.props.data;
        if (!song) {
            return <div />;
        }

        return (
            <div>
                <Link to="/">Back</Link>
                <h3>{song.title}</h3>
            </div>
        );
    }
}

export default graphql(FetchSong, {
    options: (props) => {
        return { variables: { id: props.params.id } };
    }
})(SongDetail);
```

### More action submitting

```javascript
import React, { Component } from 'react';

class LyricCreate extends Component {
    constructor(props) {
        super(props);

        this.state = { content: '' };
    }

    onSubmit(event) {
        event.preventDefault();
    }

    render() {
        return (
            <form action="">
                <label>Add a lyric</label>
                <input
                    value={this.state.content}
                    onChange={(event) =>
                        this.setState({ content: event.target.value })
                    }
                    // onSubmit={ (event) => this.onSubmit(event) }
                />
            </form>
        );
    }
}

export default LyricCreate;
```

### Submitting the lyrics

```javascript
import gql from 'graphql-tag';

export default gql`
    mutation AddLyricToSong($content: String!, $songId: ID!) {
        addLyricToSong(content: $content, songId: $songId) {
            id
            title
            lyrics {
                content
            }
        }
    }
`;
```

Using the mutations, we cannot just do this:

```
onSubmit(event) {
	event.preventDefault();
	this.props.mutate({
		variables: {
			content: this.state.content,
			// contrary to what you may expect
			songId: this.props.params.id
		}
	});
}
```

We in fact need to pass the ID down as a prop from the other component.

```
onSubmit(event) {
	event.preventDefault();
	this.props.mutate({
		variables: {
			content: this.state.content,
			songId: this.props.songId
		}
	});
}
```

### Extending Queries

How do we extend queries for something like a Lyric List? What we can do is enhance the `SongDetail` query to grab all the lyrics associated with it.

```
query FetchSong($id: ID!) {
	song(id: $id) {
		id
		title
		lyrics {
			id
			content
		}
	}
}
```

Now we can simply pass down the lyric value.

Given that the refresh also again won't automatically happen, we can do something similar to what we did with `refetchQueries`, but this time let's try something different.

**How it all works**

Each time you make a response using the `apollo` client, `apollo` returns a `typeName` in the response.

However, Apollo does not no what data is set within each of these data stores. It doesn't know the data and what attributes that it has. That's where the root of the current problem is.

To fix this issue, we can use a piece of Apollo Client config. What we can do is "associate" an `id` with each data state. That way, it can `bond` with React just that little bit better.

Now that `Apollo` can see that the song with an `id` has been updated, Apollo can then itself tell React to update its components.

## Caching with dataIdFromObject

```javascript
const client = new ApolloClient({
    dataIdFromObject: (obj) => obj.id
});

const Root = () => {
    return (
        <ApolloProvider client={client}>
            <Router history={hashHistory}>
                <Route path="/" component={App}>
                    <IndexRoute component={SongList} />
                    <Route path="songs/new" component={SongCreate} />
                    <Route path="songs/:id" component={SongDetail} />
                </Route>
            </Router>
        </ApolloProvider>
    );
};
ReactDOM.render(<Root />, document.querySelector('#root'));
```

## More on Mutations

Liking a lyric

```javascript
const mutation = gql`
    mutation LikeLyric($id: ID) {
        likeLyric(id: $id) {
            id
            likes
        }
    }
`;
```

### Optimistic mutations

```javascript
onLike(id, likes) {
	this.props.mutate({
		variables: { id },
		optimisticResponse: {
			_typename: 'Mutation',
			likeLyric: {
				id: id,
				_typename: 'LyricType',
				likes: likes + 1
			}
		}
	});
}
```

# Authentication Applications - concerned with both the front and back end

**Challenges**

| Challenge      | Solution     |
| -------------- | ------------ |
| Multiple pages | React Router |
| Data store     | MongoDB      |
| Authentication | PassportJS   |

But Passport isn't designed with GraphQL in mind.

**Auth with GraphQL**

There are two approaches that we can take to auth with GraphQL and Passport.

1.  Decoupled approach
2.  Coupled approach

**Coupled vs Decoupled**

If we do not use a changed `mutation`, we are using the `decoupled approach`. In the `coupled` approach, we have GraphQL work as the `middleman` between the application and `passport`. It's about whether or not use GraphQL to process the request or not.

So, which one? Why would we ever have `Passport` involved with `GraphQL`? You could make a strong case for either approach.

**Coupled**

Pros:

*   using Graphql in the way it was intended

**Decoupled**

Pros:

*   Once authenticated, you do not need to continue the authentication process.

Cons:

*   part of the React app would not use GraphQL at all

In the example given, they are used together - however, usually the argument is that maybe they should remain decoupled.

### Delegating to an Authentication Service

## Handling Errors Gracefully

### Handling Errors Around Signup

With the `apollo` client, you can also `catch` after a mutation.

```javascript
this.props.mutate({
	variables: { email, password }
}).catch(res => {
	const errors = res.graphQLErrors.map(err => err.message);
	this.setState({ errors });
});

### The Needs for a HOC
```
