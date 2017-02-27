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

## Working with Arrays of Objects 

If working with a dict, we need an accessor function!

```javascript
var data = [
	{key: "Glazed",		value: 132},
	{key: "Jelly",		value: 71},
	{key: "Holes",		value: 337},
	{key: "Sprinkles",	value: 93},
	{key: "Crumb",		value: 78},
	{key: "Chocolate",	value: 43},
	{key: "Coconut", 	value: 20},
	{key: "Cream",		value: 16},
	{key: "Cruller", 	value: 30},
	{key: "Éclair", 	value: 8},
	{key: "Fritter", 	value: 17},
	{key: "Bearclaw", 	value: 21}
];

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
		.domain([0, d3.max(data, (d) => {
    		return d.value;
    })])
		.range([0, width]);
 
let y = d3.scale.linear()
		.domain([0, data.length])
		.range([0, height]);

let svg = d3.select('body').append('svg')
						.attr('width', 800)
            .attr('height', 420)
            .attr('id', 'chart');
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
			return x(d.value);		// x() does the scaling
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
			return x(d.value);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(i);
		})
		.attr('dy', (d, i) => {
			return y(1)/1.5+2;
		})
		.text((d, i) => {
			return d.value;
		});
}

plot.call(chart, {
	data: data
});
```

## Creating an Ordinal Scale

```
var data = [
	{key: "Glazed",		value: 132},
	{key: "Jelly",		value: 71},
	{key: "Holes",		value: 337},
	{key: "Sprinkles",	value: 93},
	{key: "Crumb",		value: 78},
	{key: "Chocolate",	value: 43},
	{key: "Coconut", 	value: 20},
	{key: "Cream",		value: 16},
	{key: "Cruller", 	value: 30},
	{key: "Éclair", 	value: 8},
	{key: "Fritter", 	value: 17},
	{key: "Bearclaw", 	value: 21}
];

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
		.domain([0, d3.max(data, (d) => {
    		return d.value;
    })])
		.range([0, width]);
var y = d3.scale.ordinal() 			// need distinct values eg keys
		.domain(data.map((entry) => {
			return entry.key;
		}))
		.rangeBands([0, height]); 	// used for distinct values

let svg = d3.select('body').append('svg')
						.attr('width', 800)
            .attr('height', 420)
            .attr('id', 'chart');
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
			return y(d.key);
		})
		.attr('width', (d, i) => {
			return x(d.value);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return y.rangeBand() - 1;
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d.value);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(d.key);
		})
		.attr('dy', (d, i) => {
			return y.rangeBand()/1.5+2;
		})
		.text((d, i) => {
			return d.value;
		});
}

plot.call(chart, {
	data: data
});
```

## Setting colour with colour scales

```
var data = [
	{key: "Glazed",		value: 132},
	{key: "Jelly",		value: 71},
	{key: "Holes",		value: 337},
	{key: "Sprinkles",	value: 93},
	{key: "Crumb",		value: 78},
	{key: "Chocolate",	value: 43},
	{key: "Coconut", 	value: 20},
	{key: "Cream",		value: 16},
	{key: "Cruller", 	value: 30},
	{key: "Éclair", 	value: 8},
	{key: "Fritter", 	value: 17},
	{key: "Bearclaw", 	value: 21}
];

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
		.domain([0, d3.max(data, (d) => {
    		return d.value;
    })])
		.range([0, width]);
var y = d3.scale.ordinal() 			// need distinct values eg keys
		.domain(data.map((entry) => {
			return entry.key;
		}))
		.rangeBands([0, height]); 	// used for distinct values

// alter colours using linear scale
let linearColorScale = d3.scale.linear()
						.domain([0, data.length])
						.range(['#572500', '#F68026']);

// ordinal for distinct colours
let ordinalColorScale = d3.scale.category20();

let svg = d3.select('body').append('svg')
						.attr('width', 800)
            .attr('height', 420)
            .attr('id', 'chart');
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
			return y(d.key);
		})
		.attr('width', (d, i) => {
			return x(d.value);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return y.rangeBand() - 1;
		})
		.style('fill', (d, i) => {
			return linearColorScale(i);
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d.value);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(d.key);
		})
		.attr('dy', (d, i) => {
			return y.rangeBand()/1.5+2;
		})
		.text((d, i) => {
			return d.value;
		});
}

plot.call(chart, {
	data: data
});
```

## Adding X and Y axis

```
// after the colour scales

let xAxis = d3.svg.axis() 			// svg portion of the d3 library
				.scale(x)
				.orient('bottom');

let yAxis = d3.svg.axis()
				.scale(y)
				.orient('left');

...

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
			return y(d.key);
		})
		.attr('width', (d, i) => {
			return x(d.value);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return y.rangeBand() - 1;
		})
		.style('fill', (d, i) => {
			return linearColorScale(i);
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d.value);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(d.key);
		})
		.attr('dy', (d, i) => {
			return y.rangeBand()/1.5+2;
		})
		.text((d, i) => {
			return d.value;
		});
	this.append('g')
			.classed('x axis', true)
			.attr('transform', 'translate(' + 0  + ', ' + height  + ')')
			.call(xAxis);
	this.append('g')
			.classed('y axis', true)
			.attr('transform', 'translate(0, 0)')
			.call(yAxis);
}
```

## Flipping the axes

How to create a column chart?

- height needs to take an offset
- other values essentially invert
- text anchor will be `middle` in css 

```
var data = [
	{key: "Glazed",		value: 132},
	{key: "Jelly",		value: 71},
	{key: "Holes",		value: 337},
	{key: "Sprinkles",	value: 93},
	{key: "Crumb",		value: 78},
	{key: "Chocolate",	value: 43},
	{key: "Coconut", 	value: 20},
	{key: "Cream",		value: 16},
	{key: "Cruller", 	value: 30},
	{key: "Éclair", 	value: 8},
	{key: "Fritter", 	value: 17},
	{key: "Bearclaw", 	value: 21}
];

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

let x = d3.scale.ordinal() 			// need distinct values eg keys
		.domain(data.map((entry) => {
			return entry.key;
		}))
		.rangeBands([0, height]); 	// used for distinct values

let y = d3.scale.linear()
		.domain([0, d3.max(data, (d) => {
    		return d.value;
    	})])
    	.range([height, 0]);	// IMPORTANT CHANGE FROM [0, width]

// alter colours using linear scale
let linearColorScale = d3.scale.linear()
						.domain([0, data.length])
						.range(['#572500', '#F68026']);

// ordinal for distinct colours
let ordinalColorScale = d3.scale.category20();

let svg = d3.select('body').append('svg')
						.attr('width', 800)
            .attr('height', 420)
            .attr('id', 'chart');
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
		.attr('x', (d, i) => {
			return x(d.key);
		})
		.attr('y', (d, i) => {
			return y(d.value);
		})
		.attr('width', (d, i) => {
			return x(d.value);		// x() does the scaling
		})
		.attr('height', (d, i) => {
			return x.rangeBand();
		})
		.style('fill', (d, i) => {
			return linearColorScale(i);
		});

	this.selectAll('.bar-label')
		.data(params.data)
		.enter()
		.append('text')
		.classed('bar-label', true)
		.attr('x', (d, i) => {
			return x(d.value);			// use css to change the anchor
		})
		.attr('dx', -4)
		.attr('y', (d, i) => {
			return y(d.key);
		})
		.attr('dy', (d, i) => {
			return y.rangeBand()/1.5+2;
		})
		.text((d, i) => {
			return d.value;
		});

		this.append('g')
			.classed('x axis', true)
			.attr('transform', 'translate(' + 0  + ', ' + height  + ')')
			.call(xAxis);
		this.append('g')
			.classed('y axis', true)
			.attr('transform', 'translate(0, 0)')
			.call(yAxis);
}

plot.call(chart, {
	data: data
});
```

## Adding Gridlines

```
var yGridlines = d3.svg.axis() 				// create another "axis"
					.scale(y)
					.tickSize(-width, 0, 0) 			// used to adjust the axis
					.tickFormat('')
					.orient('left');

// add these grid lines with the call function at the start of the plot function
```

The grid lines also need to be styled! Hit up the CSS file to do this.

```
.gridline path,
.gridline line {
	fill: none;
	color: blue;
	shape-rendering: crispEdges;
}
```

## Rotating the X axis titles

```
...
this.append('g')
			.classed('x axis', true)
			.attr('transform', 'translate(' + 0  + ', ' + height  + ')')
			.call(xAxis)
				.selectAll('text')
					.style('text-anchor', 'end')
					.attr('dx', -8)
					.attr('dy', 8)
					.attr('transform', 'translate(0,0), rotate(-45)');
this.append('g')
			.classed('y axis', true)
			.attr('transform', 'translate(0, 0)')
			.call(yAxis);
...
```

## Adding axis labels

```
// within the plot function at the bottom

this.select('.y.axis')
	.append('text')
	.attr('x', 0)
	.attr('y', 0)
	.style('text-anchor', 'middle')
	.attr('transform', 'translate(-50, ' + height / 2 + ') rotate(-90)')
	.text('Units sold');

this.select('.x.axis')
	.append('text')
	.attr('x', 0)
	.attr('y', 0)
	.style('text-anchor', 'middle')
	.attr('transform', 'translate(' + width / 2 + ', 80) rotate(-90)')
	.text('Donut Type');
```

## Updating the plot function with best practises

- Add new parameter entries.

```
plot.call(chart, {
	data: data,
	axis: {
		x: xAxis,
		y: yAxis
	},
	gridlines: yGridlines
}
})
```

***

# Secontion 5: Making the Chart Interactive