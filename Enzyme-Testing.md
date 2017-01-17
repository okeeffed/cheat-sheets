# Testing with Enzyme

React components allow unit tests in JS to be much easier.

These exampes require `sinonjs`, `jsdom`, `enzyme`, `mocha`, `chai`

These are examples of the three APIs that you get with Enzyme. Remember, that a majority of the test cases will need `shallow`.

Testing lifecycle events, use `mount`.

If you need to test a component that gets rendered or returns just HTML, you can use `render`.

*File structure*

- test
	- repository_test.spec.js
	- github_widget.spec.js
	- user_image.spec.js
- scripts
	- mocha_runner.js
- package.json
- src
	- components
		- repositories.js

## ENZ-1: Testing with "Shallow"

```
// package.json
...
"scripts": {
	...
	"test": "mocha --require scripts/mocha_runner.js ./test/**/*.spec.js",
	...
}
...

```
// reposity_test.js
import React from 'react-native';
import { shallow } from 'enzyme';
import { expect } from 'chai';

// import a component
import Repositories from '../src/components/repositories';

describe('<Repositories />', () => {
	it('should render one number of repos specified by top prop', () => {
		const wrapper = shallow(<Repositories repositories={repos} top={2} />);
		expect(wrapper.find(Repository)).to.have.length(2);
	});

	it('should display repos ordered by stargazers' () => {
		const sortedTestData = repos.sort((a, b) => b.stargazers_count - a.stargazers_count);
		const wrapper = shallow(<Repositories repositories={repos} top={2} />);

		// find each child <Repository /> with <Repositories />
		const topRepos = wrapper.find(Repository);

		// for each <Repository /> found, test out correct values
		topRepos.forEach((repo, index) => {
			expect(repo.prop('url')).to.equal(sortedTestData[index.url]);
			expect(repo.prop('name')).to.equal(sortedTestData[index].name);
			expect(repo.prop('language')).to.equal(sortedTestData[index].language);
			expect(repo.prop('stars')).to.equal(sortedTestData[index].stars);
		});
	});
});
```

## ENZ-2: Testing with "Mount"

This requires use of `js-dom`

```
// mocha_runner.js

var jsdom = require('jsdom').jsdom;

var exposedProperties = ['window', 'navigator', 'document'];

global.document = jsdom('');
global.window = document.defaultView;
Object.keys(document.defaultView).forEach((property) => {
	if (typeof global[property] === 'undefined') {
		exposedProperties.push(property);
		global[property] = document.defaultView[property];
	}
});

global.navigator = {
	userAgent: 'node.js'
};

documentRef = document;

require('babel-core/register');
```

```
// github_widget.spec.js
import React from 'react-native';
import { mount } from 'enzyme';
import { expect } from 'chai';
import sinon from 'sinon';

// js dom has also been used as an example for these headless browser testing

// import a component
import GithubWidget from '../src/components/GithubWidget';
import UserDetails from ...
// import all the other components
// found in the expect below
...

describe('<GithubWidget />', () => {
	it('should render all sub-components', () => {
		const wrapper = mount(<GithubWidget username="test" />);
		
		expect(wrapper.containsAllMatchingElements([
			<UserDetails />,
			<UserStats />,
			<hr />,
			<Repositories />,
			<Footer />
		])).to.equal(true);
	});

	it('should display repos ordered by stargazers' () => {
		const sortedTestData = repos.sort((a, b) => b.stargazers_count - a.stargazers_count);
		const wrapper = shallow(<Repositories repositories={repos} top={2} />);

		// find each child <Repository /> with <Repositories />
		const topRepos = wrapper.find(Repository);

		// for each <Repository /> found, test out correct values
		topRepos.forEach((repo, index) => {
			expect(repo.prop('url')).to.equal(sortedTestData[index.url]);
			expect(repo.prop('name')).to.equal(sortedTestData[index].name);
			expect(repo.prop('language')).to.equal(sortedTestData[index].language);
			expect(repo.prop('stars')).to.equal(sortedTestData[index].stars);
		});
	});

	it('should call componentDidMount once' () => {
		// create a spy
		sinon.spy(GithubWidget.prototype, 'componentDidMount');
		mount(<GithubWidget username ="test />");
		expect(GithubWidget.prototype.componentDidMount.calledOnce).to.equal(true);
	});
});
```

## ENZ-3: Testing with "Render"

```
// user_image.spec.js
import React from 'react-native';
import { render } from 'enzyme';
import { expect } from 'chai';

// Component
import UserImage from './UserImage';

describe('<UserImage />', () => {
	it('should have a <div /> element with .gh-widget-photo class', () => {
		const wrapper = render(<UserImage />);
		expect(wrapper.find('div').attr('class')).to.equal('gh-widget-photo');
	});
});
```