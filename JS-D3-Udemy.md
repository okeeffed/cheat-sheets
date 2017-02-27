## Reading the D3 Documentation

- API Documentation is a great link to bookmark

***

## map() and filter() methods

```javascript
var data = [123,52,46,30,4];

const results = data.filter((entry) => {
	return entry > 50;
});

const mapping = data.map((entry) => {
	console.log(entry.key);
	console.log(entry.value);
});
```

***

## d3 methods

```
const example = d3.min(data);
console.log(example);		// values returned

const dataLoHiValue = d3.extent(data);	// return min/max as array

var dictMinValue = d3.min(dounts, (d, i) {
	return d.value;
});
```

***

## Programmatic SVGs

```javascript
var data = [132,71,337,93,78,43,20,16,30,8,17,21];
let svg = d3.select('body').append('svg')
				.attr('id', 'chart')
				.attr('height', 450)
				.attr('width', 800);

// creating the bars
// vertical bar graph
svg.selectAll('.bar')
	.data(data)
	.enter() 				// enter phase
	.append('rect')
	.attr('class', 'bar') 	// for future selections
	.attr('x', 0)
	.attr('y', (d i) => {
		return i * 20;
	})
	.attr('width', (d, i) => {
    	return d;
    })
    .attr('height', 19);
```

## Scaling Data 

- Creating scaling functions for both x and y.

```javascript
var data = [132,71,337,93,78,43,20,16,30,8,17,21];
let w = 800;
let h = 450;
let x = d3.scale.linear()
		.domain([0, d3.max(data)])
		.range([0, w]);
let y = d3.scale.linear()
		.domain([0, data.length])
		.range([0, h]);

let svg = d3.select('body').append('svg')
				.attr('id', 'chart')
				.attr('height', h)
				.attr('width', w);

// creating the bars
// vertical bar graph
svg.selectAll('.bar')
	.data(data)
	.enter() 				// enter phase
	.append('rect')
	.attr('class', 'bar') 	// for future selections
	.attr('x', 0)
	.attr('y', (d, i) => {
		return y(i);
	})
	.attr('width', (d, i) => {
    	return x(d);		// x() does the scaling
    })
    .attr('height', (d, i) => {
    	return y(1) - 1;
    });
```

## Styling with CSS 

- Getting rid of the aliasing

```css
.bar {
	fill: purple;
}
```

Not that `attr('class', 'bar')` will manually reset the class value, so you can also use `.classed('bar', true)` - true to add the class, false to remove.

## Adding Text to the chart

- Creating scaling functions for both x and y.

```javascript
var data = [132,71,337,93,78,43,20,16,30,8,17,21];
let w = 800;
let h = 450;
let x = d3.scale.linear()
		.domain([0, d3.max(data)])
		.range([0, w]);
let y = d3.scale.linear()
		.domain([0, data.length])
		.range([0, h]);

let svg = d3.select('body').append('svg')
				.attr('id', 'chart')
				.attr('height', h)
				.attr('width', w);

function plot(params) {
	// creating the bars
	// vertical bar graph
	this.selectAll('.bar')
		.data(params.data)
		.enter() 				// enter phase
		.append('rect')
		.attr('class', 'bar') 	// for future selections
		.attr('x', 0)
		.attr('y', (d, i) => {
			return y(i);
		})
		.attr('width', (d, i) => {
			return x(d);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return y(1) - 1;
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(i);
		})
		.attr('dy', (d, i) => {
			return y(1)/1.5+2;
		})
		.text((d, i) => {
			return d;
		});
}

// first arg will be what is referenced by "this"
plot.call(svg, {
	data: data
});
```

## Using SVG groups

- SVG groups are like a div that are a convenience element to allow children to be moved and affected together.

```javascript
var data = [132,71,337,93,78,43,20,16,30,8,17,21];
let w = 800;
let h = 450;
let margin = {
	top: 20,
	bottom: 20,
	left: 20,
	right: 20
};

var width = w - margin.left - margin.right;
var height = h - margin.top - margin.bottom;

let x = d3.scale.linear()
		.domain([0, d3.max(data)])
		.range([0, width]);
let y = d3.scale.linear()
		.domain([0, data.length])
		.range([0, height]);

let svg = d3.select('body').append('svg')
				.attr('id', 'chart')
				.attr('height', h)
				.attr('width', w);

let chart = svg.append('g')
				.classed('display', true)
        .attr('transform', 'translate(20, 20)');

function plot(params) {
	// creating the bars
	// vertical bar graph
	this.selectAll('.bar')
		.data(params.data)
		.enter() 				// enter phase
		.append('rect')
		.attr('class', 'bar') 	// for future selections
		.attr('x', 0)
		.attr('y', (d, i) => {
			return y(i);
		})
		.attr('width', (d, i) => {
			return x(d);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return y(1) - 1;
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(i);
		})
		.attr('dy', (d, i) => {
			return y(1)/1.5+2;
		})
		.text((d, i) => {
			return d;
		});
}

// first arg will be what is referenced by "this"
plot.call(chart, {
	data: data
});
```

***

# Section 4: Making a Complex Chart

