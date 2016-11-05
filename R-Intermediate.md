# Title

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="reloperators"></div>

***

## Relational Operators

R.O.'s are operators that let us see how one R object relates to another eg. equality etc

You can compare arrays, matrices, lists and other types of data structures.
```
# Equality == 
> TRUE == TRUE
[1] TRUE 

# Inequality !=
# LT, GT > and <

Alphabetical order with relate to alphabet and T/F will go 1/0

# Relational Operators and Vectors 
> example <- c(12,4,5,3,5)
> example
[1] 12 4 5 3 5
> example > 10
[1] TRUE FALSE FALSE FALSE FALSE

# Comparison of logicals
> TRUE == FALSE
[1] FALSE
> 
# Comparison of numerics
> -6 * 14 != 17 - 101
[1] FALSE
> 
# Comparison of character strings
> "useR" == "user"
[1] FALSE
> 
# Compare a logical with a numeric
> TRUE == 1
[1] TRUE
```

<div id="2"></div>

### ---- Greater than or less than

```
# Comparison of numerics
> -6 * 5 + 2 >= -10 + 1
[1] FALSE
> 
# Comparison of character strings
> "raining" <= "raining dogs"
[1] TRUE
> 
# Comparison of logicals
> TRUE > FALSE
[1] TRUE
```

<div id="3"></div>

### ---- Compare Vectors

```
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> facebook <- c(17, 7, 5, 16, 8, 13, 14)
> 
# Popular days
> linkedin > 15
[1]  TRUE FALSE FALSE FALSE FALSE  TRUE FALSE
> 
# Quiet days
> linkedin <= 5
[1] FALSE FALSE FALSE  TRUE  TRUE FALSE FALSE
> 
# LinkedIn more popular than Facebook
> linkedin > facebook
[1] FALSE  TRUE  TRUE FALSE FALSE  TRUE FALSE
```

<div id="4"></div>

### ---- Compare Matrices

```
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> facebook <- c(17, 7, 5, 16, 8, 13, 14)
> views <- matrix(c(linkedin, facebook), nrow = 2, byrow = TRUE)
> 
# When does views equal 13?
> views == 13
      [,1]  [,2]  [,3]  [,4]  [,5]  [,6]  [,7]
[1,] FALSE FALSE  TRUE FALSE FALSE FALSE FALSE
[2,] FALSE FALSE FALSE FALSE FALSE  TRUE FALSE
> 
# When is views less than or equal to 14?
> views <= 14
      [,1] [,2] [,3]  [,4] [,5]  [,6] [,7]
[1,] FALSE TRUE TRUE  TRUE TRUE FALSE TRUE
[2,] FALSE TRUE TRUE FALSE TRUE  TRUE TRUE
```

### ---- Logical Operators

```
x <- 12
x > 5 & x < 15	# evaluates to TRUE

&	// and
|	// or
! 	// not 

# for vectors

&& 		// only evaluates the first element of the vector
|| 		// only evaluates the first element of the vector

// examples 

> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> last <- tail(linkedin, 1)
> 
# Is last under 5 or above 10?
> last < 5 | last > 10
[1] TRUE
> 
# Is last between 15 (exclusive) and 20 (inclusive)?
> last > 15 & last <= 20
[1] FALSE

// vector examples

# linkedin exceeds 10 but facebook below 10
> linkedin > 10 & facebook < 10
[1] FALSE FALSE  TRUE FALSE FALSE FALSE FALSE
> 
# When were one or both visited at least 12 times?
> linkedin >= 12 | facebook >= 12
[1]  TRUE FALSE  TRUE  TRUE FALSE  TRUE  TRUE
> 
# When is views between 11 (exclusive) and 14 (inclusive)?
> views > 11 & views <= 14
      [,1]  [,2]  [,3]  [,4]  [,5]  [,6] [,7]
[1,] FALSE FALSE  TRUE FALSE FALSE FALSE TRUE
[2,] FALSE FALSE FALSE FALSE FALSE  TRUE TRUE

// tougher exercises

# Select the second column, named day2, from li_df: second
> second <- li_df["day2"]
> 
# Build a logical vector, TRUE if value in second is extreme: extremes
> extremes <- c(second > 25 | second < 5)
> 
# Count the number of TRUEs in extremes
> sum(extremes == TRUE)
[1] 16
> 
# Solve it with a one-liner
> sum(li_df["day2"] > 25 | li_df["day2"] < 5)
[1] 16
```

<div id="5"></div>

### ---- Conditional Statements

```
if (condition) {
	// expr
}

x <- 3

if (x < 0) {
	print("x is negative")
} else if (x < 3) {
	print("else if exec")
} else {
	print("x is positive")
}

# Variables related to your last day of recordings
> medium <- "LinkedIn"
> num_views <- 14
> 
# Examine the if statement for medium
> if (medium == "LinkedIn") {
    print("Showing LinkedIn information")
  }
[1] "Showing LinkedIn information"
> 
# Write the if statement for num_views
> if (num_views > 15) {
    print("You're popular!")
  }
> 
```


