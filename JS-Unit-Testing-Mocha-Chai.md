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

A `spec` looks very similar to a `suite`. It takes 2 arguments.

1. A string describing the desired behaviour.
2. A function that wraps all the expectations together.

It's important to start guessing what the function might expect etc.

We do a lot of the guess work for setting the spec itself. It may feel awkward at the start, but it will help get some bearings.

Once the spec is written, if we actually get `undefined` returned, that is likely because the function hasn't been written and/or does not return anything.

```
let expect = require('chai').expect;

describe('checkForShip', () => {
    const checkForShip = require('../path/to/src').checkForShip;
    
    // this is the test spec
    it('should correctly report no ship at a given player's coordinate',  () => { 

    	player = {
			ships: [
				{
					locations: [[0,0]]
				}
			]
		}

        expect(checkForShip(player, [9, 9])).to.be.false;
    });

    it('should handle ships located at more than one coordinate',  () => { 

    	player = {
			ships: [
				{
					locations: [[0,0], [0,1]]
				}
			]
		}

		expect(checkForShip(player, [0, 1])).to.be.true;
        expect(checkForShip(player, [9, 9])).to.be.false;
    });

    it('should handle ships located at more than one coordinate',  () => { 

    	player = {
			ships: [
				{
					locations: [[0,0], [0,1]]
				}
			]
		}

		expect(checkForShip(player, [0, 1])).to.be.true;
        expect(checkForShip(player, [9, 9])).to.be.false;
    });
});
```

// example in the /src/js/ship_methods.js

function checkForShip (player, coordinates) {
	
	var shipPresent, ship;

	for (var i = 0; i < player.ships.length; i++) {
		ship = player.ships[i];

		shipPresent = ship.locations.filter( (actualCoordinate) => {
			return (actualCoordinate[0] === coordinates[0]) && (actualCoordinate[1] === coordinates[1]);
		})[0];

		if (!shipPresent) {
			return false;
		}
	}
}





































































