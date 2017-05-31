# GraphQL - Udemy

## RESTful Router Primer

- Given a collection of records on a server, there should be a uniform URL and HTTP request method used to utilize that collection of records.


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

1. Make an Express server and hook it up to a datastore
2. Hook it up to a prebuilt app called GraphiQL to make a couple of test queries

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

# A realistic data source

So we don't really want to use a static list of users - because that's not realistic. So let's use some different architectures that we can use to use GraphQL with.

We could the server which hosts GraphQL and then any database.

If it's any small sized project, we could use Express etc. With larger companies, you won't use a single monolithic store, but the same Express/GraphQL Server will touch bases with a variety of databases and can act as a proxy of sorts to go and collect this data from those different datasources.
