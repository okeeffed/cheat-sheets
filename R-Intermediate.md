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

<div id="subsection"></div>

### ---- newSubSection