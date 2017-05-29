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
