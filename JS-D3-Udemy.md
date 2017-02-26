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