# Go Language Overview

## Types

- int, int8 etc
- bool
- string
- float32, float64 (64 by default)

## Packages - public and private variables

When it comes to declaring variables, to have them available to other files when the package is imported, declare the variable with a capital letter.

Lowercase variables are private.

## Variables

```go
// outside of func
var greeting = "hello"

func main() {
	// inside of func
	greeting := "Hello from Go"
	fmt.Println(test)
	fmt.Println(greeting)
}
```

### Variable declarations and assigning

```go
func main() {
	var a int
	a = 2
	var b, c int
	b = 2
	c = 3
	d := 5	// same as var d = 5
	var e = 10 // type is inferred

	// you'll need to use all the above variables
	// otherwise there will be a declaration err
	// thrown
}
```

- Variable names must start with a letter
- Uppercase variables and funcs can be used outside of the package
- Lowercase cannot
- Declaring type can come after the variable name eg `var floating float64 = 1.4`
- Casting `float64(variable)`
- Errors are thrown for mismatched types
- For scope, you are able to declare blocks by themselves
	- Each package is a implicit block

## Functions

```go
// not available outside the package
func main() {
	myFunction()
}

func myFunction() {
	fmt.Println("Running myFunction")
}

func MyPublicFunction() {
	fmt.Println("Running MyPublicFunction")
}
```

You can enforce type safety for parameters by adding the type expected to the function `func myFunc(test string, number int) {}`

- Go doesn't allow default parameter values
- No named values
- No method overloading

For returning a certain value, you can enfore this by the following
```
func myFunc(test string, number int) int {}
func myFuncTwo(numberOne int, number int) (sum int) {
	return number + numberOne;
}
func myFuncThree(number int) (difference int) {
	difference = number + 4;
}
```

### Multiple return values

```go
package main

import (
	"fmt",
	"math",
	"log"
)

func main() {
	squareRoot, err := squareRoot(-1)
	if err != nil {
		log.Fatal(err)
	}
	fmt.Println(squareRoot)
}

func squareRoot(x float64) (float64, error) {
	x < 0 {
		return 0, fmt.Errorf("Can't take a negative number")
	}
	return math.Sqrt(x), nil
}
```

As for errors

```go
package main

import (
	"fmt",
	"os"
)

// panic errors - no good!
func mainBad() {
	fileInfo, _ := os.Stat("existent.txt")
	fmt.Println(fileInfo.Size())
	fileInfo, _ := os.Stat("nonexistent.txt")
	fmt.Println(fileInfo.Size())
}

// instead, do this
func main() {
	fileInfo, error := os.Stat("existent.txt")
	if error != nil {
		fmt.Println(error)
	} else {
		fmt.Println(fileInfo.Size())
	}
	fileInfo, error := os.Stat("nonexistent.txt")
	if error != nil {
		fmt.Println(error)
	} else {
		fmt.Println(fileInfo.Size())
	}
}
```

### The Go Formatting Tool

`go fmt <filename>` will update the file itself and it will nicely format it.

## Control Structures

### For loops

```go
for i := 1; i <= 3; i++ {
	fmt.Println(i)
}
```

### If statements


```go
if true {
	fmt.Println("You'll come here")
} else if false {
	// ...
} else {
	// ...
}
```

### Switch statement

Switch statements look like they do not need a break.

```go
switch doorNumber {
	case 1:
		fmt.Println("new car ")
	case 2:
		// ...
	default:
		// ...
}
```

## Data Structures

### Pointers

You can create a pointer to a variable too.

```go
package main

import "fmt"

func main() {
	var aValue float64 = 1.23
	var aPointer *float64 = &aValue
	fmt.Println("aPointer", aPointer)
	fmt.Println("*aPointer", *aPointer)
}

/*
	Prints
	aPointer 0xc42000a3b8
	*aPointer 1.23
 */
```

There are situations where the pointer is better to use than using a value directly.

1. Functions that need to affect their argument. Args in funcs are always passed by value. The function recieves a copy of the value.
2. Passing a complex value to a function - example a complex struct

```go
// Example
package main

import "fmt"

// Not using the pointer
func main() {
	num := 8.2
	halve(num)
	fmt.Println(num)
}

func halve(number float64) {
	number = number / 2;
	fmt.Println(number)
}

// Using the pointer
package main

import "fmt"

// Not using the pointer
func main() {
	num := 8.2
	halve(&num)
	fmt.Println(num)
}

func halve(number *float64) {
	*number = *number / 2
	fmt.Println(*number)
}
```

### Arrays

Slices are used more commonly used than arrays, but given they are built on arrays, we'll explore arrays first.

```go
func main() {
	var months [3]string // array of three strings
	months[0] = "Jan"
	months[1] = "Feb"
	months[2] = "Mar"
	fmt.Println(months[0])
	// also could be months := [3]string{"Jan", "Feb", "Mar"}

	for i := 0; i < len(months); i++ {
		fmt.Println(months[i])
	}

	// another way to loop through the array
	for i, month := range months {
		fmt.Println(month)
	}

	// omit the index
	for _, month := range months {
		fmt.Println(month)
	}
}
```
 The main limitation arrays are used are because you cannot assign values to an array larger than it's initial allocated memory size.

### Slices

Slices also represent an array. Slices are easier to work with.

While `len` shows the length, `cap` shows the capacity of how it can grow.

`append` can be used to append to a slice.

```go
package main

import "fmt"

func main() {
	a := [5]int{0,1,2,3,4}
	s1 := a[0:3]
	s2 := a[2:5]
	fmt.Println(a, s1, s2)
	// prints [0 1 2 3 4] [0 1 2] [2 3 4]
	a[2] = 88
	fmt.Println(a, s1, s2)
	// prints [0 1 88 3 4] [0 1 88] [2 3 88]
	s1 = s1[0:4]
	fmt.Println(a, s1, s2)
	// prints [0 1 88 3 4] [0 1 88 3] [88 3 4]
	s2 = s2[0:4] // throws an error
	s2 = append(s2, 5) // returns a new slice
	fmt.Println(a, s1, s2)
	// prints [0 1 88 3 4] [0 1 88 3] [88 3 4 5]
	s2[0] = 999
	// prints [0 1 88 3 4] [0 1 88 3] [999 3 4 5]

	// Declaring an array on its own
	s3 := []int{1, 2, 3}
	fmt.Println(s3) // prints [1 2 3]
	s3 = append(s3, 4, 5)
	fmt.Println(s3) // [1 2 3 4 5]
}
```

### Maps

Slices are good for storing collections, but the only way to get elements back is by the index.

While in most collections you have dictionaries, hashes, hash maps, Go refers to these data structures as `Maps`.

```go
func main() {
	ages := map[string]float64{}
	ages["Alice"] = 12
	ages["Bob"] = 9
	fmt.Println(ages) // prints map[Alice:12 Bob:9]
}
```

Similar to arrays or slices, we can use a literal to prefill the values.

```go
func main() {
	ages := map[string]float64{"Alice":12, "Bob":9}
	fmt.Println(ages) // prints map[Alice:12 Bob:9]
	for name, age := range ages {
		fmt.Println(name, age)
	}

	for _, age := range ages {
		fmt.Println(age)
	}

	for name := range ages {
		fmt.Println(name)
	}
}
```

## Custom Types

We can use the `type` keyword to define a type and it's underlying type.


```go
package main

import "fmt"

type Minutes int
type Hours int

func main() {
	minutes := Minutes(37)
	hours := Hours(37)

	fmt.Println(minutes, hours)
}
```

We can also compare custom types to their underlying type. However two custom types with the same underlying type cannot be compared.

The more commonly used aggregate type is a Struct which is how we can base custom types on them.
