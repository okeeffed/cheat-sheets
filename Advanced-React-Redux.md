# Advanced React and Redux

## 1. Testing

Jumping into examples are normally more useful as you are learning.

In the `testing` folder you will see a whole bunch of configuration for `test_helper.js`.

### Test Reporting

## 4. Authentication

Not a lot of great end-to-end tutorials already. Most skip some important steps.

Best React backend? There is no best backend. All they care about is being served JSON.

Work on the relationship of have a `Username/Password` combination and being authenticated by the server. After being authenticated, we want them to be able to make post requests without reidentifying. The server must give the client back something for this part.

In conclusion, we just want `Here is my cookie OR token for a protected resource`.

### Cookies vs Tokens

**Cookies**

- Automatically included on all requests 
- Unique to each domain 
- Cannot be sent to different domains 

Headers - `cookie: {}`
Body - JSON 

The point of cookies is to bring `state` to something `stateless`

**Token**

- Have to manually wire up
- Can be sent to any domain 

Headers - `authorization: jioeajteioa`
Body - JSON

Being able to send this to any domain we wish is a benefit with a token.

### Scalable Architecture 

So we've decided to go with tokens, which is also aligned with how the industry is trending.

If we served `index.html` and `bundle.js` from a Content Server, we can make that server work with no auth req'd.
- Very easy to redistribute 