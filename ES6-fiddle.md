# ES6 Fiddle

***

## Map Function

```
let doubles = [1,2,3,4].map(v => v+1);
console.log(doubles[0]); //2

let terms = ["Ben", "Den", "Sam"];
console.log(terms.map(name => `I am ${name}`));
// I am Ben, I am Den, I am Sam
```

## Arrow Function

```
let nums = [1,2,3,4,5,6];
let fives = [];

nums.forEach(v => {
   if (v % 5 === 0)
       fives.push(v)
})

console.log(fives);
// print 5
```

## Rest Parameter

```
function f (x, y, ...a) {
    return (x + y) * a.length;
}
console.log(f(1, 2, "hello", true, 7) === 9);
// returns true
```