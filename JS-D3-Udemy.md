## Reading the D3 Documentation

- API Documentation is a great link to bookmark

## map and filter methods

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