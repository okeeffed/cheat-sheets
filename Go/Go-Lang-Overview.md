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
