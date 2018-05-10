# Using Stripe with Node

<!-- TOC -->

*   [Using Stripe with Node](#using-stripe-with-node)
    *   [Prereqs](#prereqs)
    *   [Testing with Express](#testing-with-express)

<!-- /TOC -->

## Prereqs

1.  Sign up
2.  `yarn add stripe` to your Node.js Project
3.  Build out a server

## Testing with Express

Configure the .env file and upload

[Node Stripe Github](https://github.com/stripe/stripe-node)

```javascript
const stripe = require('stripe')(process.env.STRIPE_SECRET_KEY);

/* GET home page. */
module.exports = function(app) {
    app.get('/', function(req, res) {
        res.send('Server is healthy');
    });

    app.post('/', function(req, res) {
        console.log(req.body);
        // Create a new customer and then a new charge for that customer:
        stripe.customers
            .create({
                email: 'foo-customer@example.com'
            })
            .then(function(customer) {
                console.log(customer);
                return stripe.customers.createSource(customer.id, {
                    source: {
                        object: 'card',
                        exp_month: 10,
                        exp_year: 2018,
                        number: '4242 4242 4242 4242',
                        cvc: 100
                    }
                });
            })
            .then(function(source) {
                return stripe.charges.create({
                    amount: 1600,
                    currency: 'aud',
                    customer: source.customer
                });
            })
            .then(function(charge) {
                // New charge created on a new customer
                console.log(charge);
            })
            .catch(function(err) {
                // Deal with an error
                console.log(err);
            });

        res.send('Post requests are healthy');
    });
};
```
