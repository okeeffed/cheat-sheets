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
