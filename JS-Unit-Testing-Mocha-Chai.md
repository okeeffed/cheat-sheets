# Mocha and Chai

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="section"></div>

***

## Getting Started

BDD - Behaviour Driven Development 

We want to put the test code in a file separate from the other code.

After install the dev dependency of mocha and chai, you can write a test.js file and then run `mocha test.js' and it will simply run the test!

To start making these tests, we __NEED__ to make a `test` file in the same directory as `package.json`

<div id="testSuite"></div>

### ---- Building a test suite

Write a test that will run the test using the npm task `test` and just reply an assertion to be true.

```
const expect = require('chai').expect;

// Test suite
describe('Mocha', () => {
	// Test spec (unit test)
	it('should run our test using npm', () => {
		expect(true).to.be.ok;
	});
});
```
