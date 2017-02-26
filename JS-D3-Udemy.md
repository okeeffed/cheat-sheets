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
