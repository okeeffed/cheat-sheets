## Testing

The test files are stored in the test folders and require the dev dependencies `sinonjs, jsdom, mocha, chai`.

Run `npm test` to view the tests files that are written in that folder.

Testing is still primitive and should be BDD (behaviour driven). Tests that are too specific will cause issues.

__mocha and chai__

These two are used in tandem to assert/expect values. Check out the Chai documentation for relative examples.

Tests consist of test suites and test specs. In order to recreate DOM elements if you are looking to test values etc. from functionality, you can use the `jsdom` library and import `jquery`.

Below is a small example of a test set up.

```javascript
import jsdom from 'jsdom-global';
import jQuery from '../bower_components/jquery/dist/jquery.min.js';

import ModuleToTest from 'path/to/module'l

// require sinon/chai
const sinon = require('sinon');
const expect = require('chai').expect;

// Test suite
describe('These tests are supposed to test some functionality', () => {

	let $;
	let ageGateFilters;
	jsdom();

	// this function will run before every Test Spec
	before(function () {
		$ = jQuery;
		const params = ['param1', 'param2', 'param3']

		// create instance
		const moduleToTest = new ModuleToTest(...params);
	});

	// Test Spec (unit test)
	it('This test should return ok', () => {
		expect(true).to.be.ok;	// returns ok
	});

	// Test Spec (unit test)
	it('This test should return true for the ModuleToTest function', () => {
		expect(moduleToTest.func()).to.equal(true);	// returns ok if result is true
	});

});
```

__sinon.js__

This library is used to essentially stub data for functions that require things like ajax etc. No tests currently use this effectively. Examples will be added later if used.

For now, I will show an example of a `spy` and a `stub` (as this may the most relevant): 

_For the Spy_

```
// in module Example

export default class Example {
	
	callout() {
		let a = 1;
		let b = 2;

		return target(a,b);
	}

}

// in a test file

import Example from 'Example';

// Test suite
describe('A test suite using sinon', () => {

	// this function will run before every Test Spec
	before(function () {
		$ = jQuery;
		const params = ['param1', 'param2', 'param3']

		// create instance
		const example = new Example(...params);
	});

	// Test spec (unit test)
	it('Should return that the async func was called', () => {
		
		let targetSpy = sinon.spy(example, 'target');

		// Now, any time we call the function, the spy logs information about it
		example.callout();

		assert(targetSpy.calledOnce); // returns true
	});
});
```

_For the Stub_

```
// in module Example

export default class Example {
	
	callout(param, callback) {
		$.ajax({
			// whatever it normally is
		}, callback);
	}

}

// in a test file

import Example from 'Example';

// Test suite
describe('A test suite using sinon', () => {

	// this function will run before every Test Spec
	before(function () {
		$ = jQuery;
		const params = ['param1', 'param2', 'param3']

		// create instance
		const example = new Example(...params);
	});

	// Test spec (unit test)
	it('Should call callback after saving', () => {
		
		//We'll stub $.post so a request is not sent
		const post = sinon.stub($, 'ajax');
		post.yields();

		//We can use a spy as the callback so it's easy to verify
		var callback = sinon.spy();

		example.callout(param, callback);

		post.restore();
		sinon.assert.calledOnce(callback); // returns true
	});
});
```

__jsdom__

jsdom is a library that allows you to write a `innerHTML` var for the test to use if you want to test out the jQuery values for a test.

For an example, checkout yt `test/agegate_test.js`.