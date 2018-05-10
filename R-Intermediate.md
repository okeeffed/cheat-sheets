# Title

<!-- TOC -->

*   [Title](#title)
    *   [Table of Contents](#table-of-contents)
    *   [Relational Operators](#relational-operators)
        *   [---- Greater than or less than](#-----greater-than-or-less-than)
        *   [---- Compare Vectors](#-----compare-vectors)
        *   [---- Compare Matrices](#-----compare-matrices)
        *   [---- Logical Operators](#-----logical-operators)
        *   [---- Conditional Statements](#-----conditional-statements)
    *   [Loops](#loops)
        *   [---- For Loop](#-----for-loop)
        *   [---- Looping Over a List](#-----looping-over-a-list)
    *   [Functions](#functions)
        *   [++++ ---- mean()](#------mean)
        *   [++++ ---- mean() continued, sd() and rm.na](#------mean-continued-sd-and-rmna)
        *   [---- Writing Functions](#-----writing-functions)
        *   [---- Packages](#-----packages)
    *   [The Apply Family](#the-apply-family)
        *   [---- Anonymous Functions](#-----anonymous-functions)
        *   [---- sapply](#-----sapply)
        *   [---- vapply()](#-----vapply)
    *   [Useful Functions](#useful-functions)
        *   [---- Data Utilities](#-----data-utilities)
        *   [---- Beat Gauss using R](#-----beat-gauss-using-r)
        *   [---- Regex](#-----regex)
        *   [---- sub & gsub](#-----sub--gsub)
    *   [Times & Dates](#times--dates)

<!-- /TOC -->

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="reloperators"></div>

---

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

# Variables related to your last day of recordings
> li <- 15
> fb <- 9
>
# Code the control-flow construct
> if (li >= 15 & fb >= 15) {
    sms <- 2 * (li + fb)
  } else if (li < 10 & fb < 10) {
    sms <- 0.5 * (li + fb)
  } else {
    sms <- li + fb
  }
>
# Print the resulting sms to the console
> sms
[1] 24
```

<div id="loops"></div>

---

## Loops

```
while (condition) {
  // run the exp
}

ctr <- 1

while (ctr <= 7) {
  // run the expression
  ctr <- ctr + 1
}
```

Make sure that the condition for a while loop because false at some stage.

```
# Print out the speed variable
> speed
[1] 64
# Initialize the speed variable
> speed <- 64
>
# Code the while loop
> while (speed > 30) {
    print("Slow down!")
    speed <- speed -7
  }
[1] "Slow down!"
[1] "Slow down!"
[1] "Slow down!"
[1] "Slow down!"
[1] "Slow down!"
>
# Print out the speed variable
> speed
[1] 29
```

```
# Initialize the speed variable
> speed <- 64
>
# Extend/adapt the while loop
> while (speed > 30) {
    print(paste("Your speed is",speed))
    if (speed > 48) {
      print("Slow down big time!")
      speed <- speed - 11
    } else {
      print("Slow down!")
      speed <- speed - 6
    }
  }
[1] "Your speed is 64"
[1] "Slow down big time!"
[1] "Your speed is 53"
[1] "Slow down big time!"
[1] "Your speed is 42"
[1] "Slow down!"
[1] "Your speed is 36"
[1] "Slow down!"
```

```
# Initialize the speed variable
> speed <- 88
>
> while (speed > 30) {
    print(paste("Your speed is", speed))

    # Break the while loop when speed exceeds 80
    if (speed > 80) {
      break
    }

    if (speed > 48) {
      print("Slow down big time!")
      speed <- speed - 11
    } else {
      print("Slow down!")
      speed <- speed - 6
    }
  }
[1] "Your speed is 88"
```

```
# Initialize i as 1
> i <- 1
>
# Code the while loop
> while (i <= 10) {
    print(3 * i)
    if (3*i %% 8 == 0) {
      break
    }
    i <- i + 1
  }
[1] 3
[1] 6
[1] 9
[1] 12
[1] 15
[1] 18
[1] 21
[1] 24
```

<div id="loop2"></div>

### ---- For Loop

```
# The linkedin vector has already been defined for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
>
# Loop version 1
> for (l in linkedin) {
    print(l)
  }
[1] 16
[1] 9
[1] 13
[1] 5
[1] 2
[1] 17
[1] 14
>
>
# Loop version 2
> for (i in 1:length(linkedin)) {
    print(linkedin[i])
  }
[1] 16
[1] 9
[1] 13
[1] 5
[1] 2
[1] 17
[1] 14
```

<div id="loops3"></div>

### ---- Looping Over a List

```
primes_list <- list(2, 3, 5, 7, 11, 13)

# loop version 1
for (p in primes_list) {
  print(p)
}

# loop version 2
for (i in 1:length(primes_list)) {
  print(primes_list[[i]])
}
```

```
# The nyc list is already specified
> nyc <- list(pop = 8405837,
              boroughs = c("Manhattan", "Bronx", "Brooklyn", "Queens", "Staten Island"),
              capital = FALSE)
>
# Loop version 1
> for (n in nyc) {
    print(n)
  }
[1] 8405837
[1] "Manhattan"     "Bronx"         "Brooklyn"      "Queens"
[5] "Staten Island"
[1] FALSE
>
# Loop version 2
> for (i in 1:length(nyc)) {
    print(nyc[[i]])
  }
[1] 8405837
[1] "Manhattan"     "Bronx"         "Brooklyn"      "Queens"
[5] "Staten Island"
[1] FALSE
```

**How about printing over a matrix?**

```
# The tic-tac-toe matrix ttt has already been defined for you
>
# define the double for loop
> for (i in 1:nrow(ttt)) {
    for (j in 1:ncol(ttt)) {
      print(paste("On row", i, "and column", j, "the board contains", ttt[i,j]))
    }
  }
[1] "On row 1 and column 1 the board contains O"
[1] "On row 1 and column 2 the board contains NA"
[1] "On row 1 and column 3 the board contains X"
[1] "On row 2 and column 1 the board contains NA"
[1] "On row 2 and column 2 the board contains O"
[1] "On row 2 and column 3 the board contains O"
[1] "On row 3 and column 1 the board contains X"
[1] "On row 3 and column 2 the board contains NA"
[1] "On row 3 and column 3 the board contains X"
```

**Mixing together Control Flow and Loops**

```
# The linkedin vector has already been defined for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
>
# Code the for loop with conditionals
> for (li in linkedin) {
    if (li > 10) {
      print("You're popular!")
    } else {
      print("Be more visible!")
    }
    print(li)
  }
[1] "You're popular!"
[1] 16
[1] "Be more visible!"
[1] 9
[1] "You're popular!"
[1] 13
[1] "Be more visible!"
[1] 5
[1] "Be more visible!"
[1] 2
[1] "You're popular!"
[1] 17
[1] "You're popular!"
[1] 14
```

**Next in Loops**

Next does what continue does in a number of other languages

```
# The linkedin vector has already been defined for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
>
# Extend the for loop
> for (li in linkedin) {
    if (li > 10) {
      print("You're popular!")
    } else {
      print("Be more visible!")
    }

    # Add if statement with break
    if (li > 16) {
      print("This is ridiculous, I'm outta here!")
      break
    }

    # Add if statement with next
    if (li < 5) {
      print("This is too embarrassing!")
      next
    }

    print(li)
  }
[1] "You're popular!"
[1] 16
[1] "Be more visible!"
[1] 9
[1] "You're popular!"
[1] 13
[1] "Be more visible!"
[1] 5
[1] "Be more visible!"
[1] "This is too embarrassing!"
[1] "You're popular!"
[1] "This is ridiculous, I'm outta here!"
```

The `strsplit()` function splits the chars into a vector with individual letters.

```
# Pre-defined variables
> rquote <- "r's internals are irrefutably intriguing"
> chars <- strsplit(rquote, split = "")[[1]]
>
# Initialize rcount
> rcount <- 0
>
# Finish the for loop
> for (char in chars) {
    if (char == 'r') {
      rcount = rcount + 1
    }

    if (char == 'u') {
      break
    }
  }
>
# Print out rcount
> rcount
[1] 5
```

<div id="functions"></div>

---

## Functions

```
help()
args()
```

**Using functions**

```
# The linkedin and facebook vectors have already been created for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> facebook <- c(17, 7, 5, 16, 8, 13, 14)
>
# Calculate average number of views
> avg_li <- mean(linkedin)
> avg_fb <- mean(facebook)
>
# Inspect avg_li and avg_fb
> avg_li
[1] 10.85714
> avg_fb
[1] 11.42857
```

<div id="mean"></div>

### ++++ ---- mean()

```
# The linkedin and facebook vectors have already been created for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> facebook <- c(17, 7, 5, 16, 8, 13, 14)
>
# Calculate the mean of the sum
> avg_sum <- mean(linkedin + facebook)
>
# Calculate the trimmed mean of the sum
> avg_sum_trimmed <- mean(linkedin + facebook, 0.2)
>
# Inspect both new variables
> avg_sum
[1] 22.28571
> avg_sum_trimmed
[1] 22.6
```

<div id="sd"></div>

### ++++ ---- mean() continued, sd() and rm.na

```
# The linkedin and facebook vectors have already been created for you
> linkedin <- c(16, 9, 13, 5, NA, 17, 14)
> facebook <- c(17, NA, 5, 16, 8, 13, 14)
>
# Basic average of linkedin
> mean(linkedin)
[1] NA
>
# Advanced average of linkedin
> mean(linkedin, na.rm = TRUE)
[1] 12.33333
```

Note that you can use function calls within functions calls.

```
# The linkedin and facebook vectors have already been created for you
> linkedin <- c(16, 9, 13, 5, NA, 17, 14)
> facebook <- c(17, NA, 5, 16, 8, 13, 14)
>
# Calculate the mean absolute deviation
> mean(abs(linkedin - facebook), na.rm = TRUE)
[1] 4.8
```

<div id="writingfunctions"></div>

### ---- Writing Functions

```
# Create a function pow_two()
> pow_two <- function(x) {
    return (x^2)
  }
>
>
# Use the function
> pow_two(12)
[1] 144
>
# Create a function sum_abs()
> sum_abs <- function(x, y) {
    return (abs(x) + abs(y))
  }
>
# Use the function
> sum_abs(-2, 3)
[1] 5
```

```
# Define the function hello()
> hello <- function() {
    print("Hi there!")
    return (TRUE)
  }
>
# Call the function hello()
> hello()
[1] "Hi there!"
[1] TRUE
```

```
# Finish the pow_two() function
> pow_two <- function(x, print_info = TRUE) {
    y <- x ^ 2
    if (print_info) {
      print(paste(x, "to the power two equals", y))
    }
    return(y)
  }
>
> pow_two(2)
[1] "2 to the power two equals 4"
[1] 4
```

```
# Define the interpret function
> interpret <- function(num_views) {
    if (num_views > 15) {
      print("You're popular!")
      return (num_views)
    } else {
      print("Try to be more visible!")
      return (0)
    }
  }
>
# Call the interpret function twice
> interpret(linkedin[1])
[1] "You're popular!"
[1] 16
> interpret(facebook[2])
[1] "Try to be more visible!"
[1] 0
```

```
# The linkedin and facebook vectors have already been created for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> facebook <- c(17, 7, 5, 16, 8, 13, 14)
>
# The interpret() can be used inside interpret_all()
> interpret <- function(num_views) {
    if (num_views > 15) {
      print("You're popular!")
      return(num_views)
    } else {
      print("Try to be more visible!")
      return(0)
    }
  }
>
# Define the interpret_all() function
# views: vector with data to interpret
# return_sum: return total number of views on popular days?
> interpret_all <- function(views, return_sum = TRUE) {
    count <- 0

    for (v in views) {
      count <- count + interpret(v)
    }

    if (return_sum) {
      return (count)
    } else {
      return (NULL)
    }
  }
>
# Call the interpret_all() function on both linkedin and facebook
> interpret_all(linkedin)
[1] "You're popular!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] "You're popular!"
[1] "Try to be more visible!"
[1] 33
> interpret_all(facebook)
[1] "You're popular!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] "You're popular!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] "Try to be more visible!"
[1] 33
```

<div id="packages"></div>

### ---- Packages

To install... `install.packages(<install package>)`

`library()` loads packages, attaches them to the search list on your R workspace.

Example - loading the ggplot2

```
> search()
 [1] ".GlobalEnv"          "package:RBackend"    "package:datacampSCT"
 [4] "package:stats"       "package:graphics"    "package:grDevices"  
 [7] "package:utils"       "package:datasets"    "package:methods"
[10] "Autoloads"           "package:base"
> qplot(mtcars$wt, mtcars$hp)
Error: could not find function "qplot"

# Load the ggplot2 package
> library(ggplot2)
>
# Retry the qplot() function
> qplot(mtcars$wt, mtcars$hp)
>
# Check out the currently attached packages again
> search()
 [1] ".GlobalEnv"          "package:ggplot2"     "package:RBackend"
 [4] "package:datacampSCT" "package:stats"       "package:graphics"
 [7] "package:grDevices"   "package:utils"       "package:datasets"
[10] "package:methods"     "Autoloads"           "package:base"
```

<div id="apply"></div>

---

## The Apply Family

`lapply` can apply a function to each item in a list, vector etc.

`lapply` itself **ALWAYS** returns a list.

`unlist(lapply(example_list, nchar))` could do things like turn a list into a vector of the number of characters in each element of example_list.

`lapply(X, FUN, ...)`

To put it generally, lapply takes a vector or list X, and applies the function FUN to each of its members. If FUN requires additional arguments, you pass them after you've specified X and FUN (...). The output of lapply() is a list, the same length as X, where each element is the result of applying FUN on the corresponding element of X.

```
# The vector pioneers has already been created for you
> pioneers <- c("GAUSS:1777", "BAYES:1702", "PASCAL:1623", "PEARSON:1857")
>
# Split names from birth year
> split_math <- strsplit(pioneers, split = ":")
>
# Convert to lowercase strings: split_low
> split_low <- lapply(split_math, tolower)
>
# Take a look at the structure of split_low
> str(split_low)
List of 4
 $ : chr [1:2] "gauss" "1777"
 $ : chr [1:2] "bayes" "1702"
 $ : chr [1:2] "pascal" "1623"
 $ : chr [1:2] "pearson" "1857"
```

How about using `lapply` with your own functions?

```
> pioneers <- c("GAUSS:1777", "BAYES:1702", "PASCAL:1623", "PEARSON:1857")
> split <- strsplit(pioneers, split = ":")
> split_low <- lapply(split, tolower)
>
# Write function select_first()
> select_first <- function(x) {
   x[1]
 }
>
# Apply select_first() over split_low: names
> names <- lapply(split_low, select_first)
>
# Write function select_second()
> select_second <- function(x) {
   x[2]
 }
>
# Apply select_second() over split_low: years
> years <- lapply(split_low, select_second)
```

<div id="anon"></div>

### ---- Anonymous Functions

```
> pioneers <- c("GAUSS:1777", "BAYES:1702", "PASCAL:1623", "PEARSON:1857")
> split <- strsplit(pioneers, split = ":")
> split_low <- lapply(split, tolower)
>
# Transform: use anonymous function inside lapply
> names <- lapply(split_low, function(x) {
    x[1]
  })
>
# Transform: use anonymous function inside lapply
> years <- lapply(split_low, function(x) {
    x[2]
  })
```

```
# Definition of split_low
> pioneers <- c("GAUSS:1777", "BAYES:1702", "PASCAL:1623", "PEARSON:1857")
> split <- strsplit(pioneers, split = ":")
> split_low <- lapply(split, tolower)
>
# Generic select function
> select_el <- function(x, index) {
    x[index]
  }
>
# Use lapply() twice on split_low: names and years
> names <- lapply(split_low, select_el, index=1)
> years <- lapply(split_low, select_el, index=2)
```

<div id="sapply"></div>

---

### ---- sapply

Whereas lapply() returns a list, sapply() - instead of unlist() function on that returned list, we can used sapply() for "simplified apply" and it will result in a named vector. We can also have matrices retured too!

`sapply(X, FUNC, USE.NAMES = TRUE)`

```
> temp
[[1]]
[1]  3  7  9  6 -1

[[2]]
[1]  6  9 12 13  5

[[3]]
[1]  4  8  3 -1 -3

[[4]]
[1]  1  4  7  2 -2

[[5]]
[1] 5 7 9 4 2

[[6]]
[1] -3  5  8  9  4

[[7]]
[1] 3 6 9 4 1

# temp has already been defined in the workspace
>
# Use lapply() to find each day's minimum temperature
> lapply(temp, min)
[[1]]
[1] -1

[[2]]
[1] 5

[[3]]
[1] -3

[[4]]
[1] -2

[[5]]
[1] 2

[[6]]
[1] -3

[[7]]
[1] 1
>
# Use sapply() to find each day's minimum temperature
> sapply(temp, min)
[1] -1  5 -3 -2  2 -3  1
>
# Use lapply() to find each day's maximum temperature
> lapply(temp, max)
[[1]]
[1] 9

[[2]]
[1] 13

[[3]]
[1] 8

[[4]]
[1] 7

[[5]]
[1] 9

[[6]]
[1] 9

[[7]]
[1] 9
>
# Use sapply() to find each day's maximum temperature
> sapply(temp, max)
[1]  9 13  8  7  9  9  9
```

```
# Finish function definition of extremes_avg
> extremes_avg <- function(x) {
    ( min(x) + max(x) ) / 2
  }
>
# Apply extremes_avg() over temp using sapply()
> sapply(temp, extremes_avg)
[1] 4.0 9.0 2.5 2.5 5.5 3.0 5.0
>
# Apply extremes_avg() over temp using lapply()
> lapply(temp, extremes_avg)
[[1]]
[1] 4

[[2]]
[1] 9

[[3]]
[1] 2.5

[[4]]
[1] 2.5

[[5]]
[1] 5.5

[[6]]
[1] 3

[[7]]
[1] 5
```

```
# temp is already available in the workspace
>
# Create a function that returns min and max of a vector: extremes
> extremes <- function(x) {
    c(min = min(x), max = max(x))
  }
>
# Apply extremes() over temp with sapply()
> sapply(temp, extremes)
    [,1] [,2] [,3] [,4] [,5] [,6] [,7]
min   -1    5   -3   -2    2   -3    1
max    9   13    8    7    9    9    9
>
# Apply extremes() over temp with lapply()
> lapply(temp, extremes)
[[1]]
min max
 -1   9

[[2]]
min max
  5  13

[[3]]
min max
 -3   8

[[4]]
min max
 -2   7

[[5]]
min max
  2   9

[[6]]
min max
 -3   9

[[7]]
min max
  1   9
```

```
# temp is already prepared for you in the workspace
>
# Definition of below_zero()
> below_zero <- function(x) {
    return(x[x < 0])
  }
>
# Apply below_zero over temp using sapply(): freezing_s
> freezing_s <- sapply(temp, below_zero)
>
# Apply below_zero over temp using lapply(): freezing_l
> freezing_l <- lapply(temp, below_zero)
>
# Are freezing_s and freezing_l identical?
> identical(freezing_l, freezing_s)
[1] TRUE
```

**sapply with Null values**

```
# Definition of print_info()
> print_info <- function(x) {
    cat("The average temperature is", mean(x), "\n")
  }
>
# Apply print_info() over temp using sapply()
> null_s <- sapply(temp, print_info)
The average temperature is 4.8
The average temperature is 9
The average temperature is 2.2
The average temperature is 2.4
The average temperature is 5.4
The average temperature is 4.6
The average temperature is 4.6
>
# Apply print_info() over temp using lapply()
> null_l <- lapply(temp, print_info)
The average temperature is 4.8
The average temperature is 9
The average temperature is 2.2
The average temperature is 2.4
The average temperature is 5.4
The average temperature is 4.6
The average temperature is 4.6
>
> identical(null_l, null_s)
[1] TRUE
```

<div id="vapply"></div>

---

### ---- vapply()

```
lapply() : apply function over list or vector
output = list

sapply() : apply function over list or vector
try to simplify list to array

vapply() : apply function over list or vector
explicitly specify output format
```

```
# Definition of basics()
> basics <- function(x) {
    c(min = min(x), mean = mean(x), max = max(x))
  }
>
# Apply basics() over temp using vapply()
> vapply(temp, basics, numeric(3))
     [,1] [,2] [,3] [,4] [,5] [,6] [,7]
min  -1.0    5 -3.0 -2.0  2.0 -3.0  1.0
mean  4.8    9  2.2  2.4  5.4  4.6  4.6
max   9.0   13  8.0  7.0  9.0  9.0  9.0
```

```
# Convert to vapply() expression
> vapply(temp, max, numeric(1))
[1]  9 13  8  7  9  9  9
>
# Convert to vapply() expression
> vapply(temp, function(x, y) { mean(x) > y }, y = 5, logical(1))
[1] FALSE  TRUE FALSE FALSE  TRUE FALSE FALSE
```

<div id="usefulfunc"></div>

---

## Useful Functions

```
sapply(), lapply(), vapply()
sort()
print()
identical()
mean()
round()
abs()

// funcs for data structures
seq()
rep() // replicate
is.*()
as.*()
unlist()
append()
rev()
```

**Math Utils**

```
> errors <- c(1.9, -2.6, 4.0, -9.5, -3.4, 7.3)
>
# Sum of absolute rounded values of errors
> sum(round(abs(errors)))
[1] 29
```

```
# Don't edit these two lines
> vec1 <- c(1.5, 2.5, 8.4, 3.7, 6.3)
> vec2 <- rev(vec1)
>
# Fix the error
> mean(c(abs(vec1), abs(vec2)))
[1] 4.48
```

### ---- Data Utilities

R features a bunch of functions to juggle around with data structures::

```
seq(): Generate sequences, by specifying the from, to and by arguments.
rep(): Replicate elements of vectors and lists.
sort(): Sort a vector in ascending order. Works on numerics, but also on character strings and logicals.
rev(): Reverse the elements in a data structures for which reversal is defined.
str(): Display the structure of any R object.
append(): Merge vectors or lists.
is.*(): Check for the class of an R object.
as.*(): Convert an R object from one class to another.
unlist(): Flatten (possibly embedded) lists to produce a vector.
```

Remember the social media profile view data? Your LinkedIn and Facebook view counts for the last seven days are already defined as lists on the right.

```
# The linkedin and facebook lists have already been created for you
> linkedin <- list(16, 9, 13, 5, 2, 17, 14)
> facebook <- list(17, 7, 5, 16, 8, 13, 14)
>
# Convert linkedin and facebook to a vector: li_vec and fb_vec
> li_vec <- unlist(linkedin)
> fb_vec <- unlist(facebook)
>
# Append fb_vec to li_vec: social_vec
> social_vec <- append(li_vec, fb_vec)
>
# Sort social_vec
> sort(social_vec, decreasing = TRUE)
 [1] 17 17 16 16 14 14 13 13  9  8  7  5  5  2
```

```
> rep(seq(1, 7, by = 2), times = 7)
 [1] 1 3 5 7 1 3 5 7 1 3 5 7 1 3 5 7 1 3 5 7 1 3 5 7 1 3 5 7
```

<div id="gauss"></div>

### ---- Beat Gauss using R

There is a popular story about young Gauss. As a pupil, he had a lazy teacher who wanted to keep the classroom busy by having them add up the numbers 1 to 100. Gauss came up with an answer almost instantaneously, 5050. On the spot, he had developed a formula for calculating the sum of an arithmetic series. There are more general formulas for calculating the sum of an arithmetic series with different starting values and increments. Instead of deriving such a formula, why not use R to calculate the sum of a sequence?

```
# Create first sequence: seq1
> seq1 <- seq(1, 500, 3)
>
# Create second sequence: seq2
> seq2 <- seq(1200, 900, -7)
>
# Calculate total sum of the sequences
> sum(seq1, seq2)
[1] 87029
```

<div id="regex"></div>

### ---- Regex

```
grepl(patter = <regex>, x = <string>)

animals <- c("cat", "moose")
grepl("a", animals)
TRUE FALSE

sub(pattern = <regex>, replacement = <str>, x = <str>)
```

```
# The emails vector has already been defined for you
> emails <- c("john.doe@ivyleague.edu", "education@world.gov", "dalai.lama@peace.org",
              "invalid.edu", "quant@bigdatacollege.edu", "cookie.monster@sesame.tv")
>
# Use grepl() to match for "edu"
> grepl("edu", emails)
[1]  TRUE  TRUE FALSE  TRUE  TRUE FALSE
>
# Use grep() to match for "edu", save result to hits
> hits <- grep("edu", emails)
>
# Subset emails using hits
> emails[hits]
[1] "john.doe@ivyleague.edu"   "education@world.gov"
[3] "invalid.edu"              "quant@bigdatacollege.edu"
```

*   @, because a valid email must contain an at-sign.
*   ._, which matches any character (.) zero or more times (_). Both the dot and the asterisk are metacharacters. You can use them to match any character between the at-sign and the ".edu" portion of an email address.
*   \\.edu$, to match the ".edu" part of the email at the end of the string. The \\ part escapes the dot: it tells R that you want to use the . as an actual character.

```
# The emails vector has already been defined for you
> emails <- c("john.doe@ivyleague.edu", "education@world.gov", "dalai.lama@peace.org",
              "invalid.edu", "quant@bigdatacollege.edu", "cookie.monster@sesame.tv")
>
# Use grepl() to match for .edu addresses more robustly
> grepl("@.*\\.edu$", emails)
[1]  TRUE FALSE FALSE FALSE  TRUE FALSE
>
```

<div id="sub"></div>

### ---- sub & gsub

While grep() and grepl() were used to simply check whether a regular expression could be matched with a character vector, sub() and gsub() take it one step further: you can specify a replacement argument. If inside the character vector x, the regular expression pattern is found, the matching element(s) will be replaced with replacement.sub() only replaces the first match, whereas gsub() replaces all matches.

```
# The emails vector has already been defined for you
> emails <- c("john.doe@ivyleague.edu", "education@world.gov", "dalai.lama@peace.org",
              "invalid.edu", "quant@bigdatacollege.edu", "cookie.monster@sesame.tv")
>
# Use sub() to convert the email domains to datacamp.edu
> sub("@.*\\.edu$", "@datacamp.edu", emails)
[1] "john.doe@datacamp.edu"    "education@world.gov"
[3] "dalai.lama@peace.org"     "invalid.edu"
[5] "quant@datacamp.edu"       "cookie.monster@sesame.tv"
```

<div id="timesanddates"></div>

---

## Times & Dates

```
today <- Sys.Date()
today
# prints date

# for a timestamp
now <- Sys.time()

my_date <- as.Date("1975-14-05", format = "%Y-%d-%m")

# format must be specified if you change from Y-m-d

> now <- Sys.time()
> now
[1] "2016-11-20 09:36:43 AEDT"

# adding days

> mydate
[1] "2016-11-20"
> mydate + 1
[1] "2016-11-21"

# difference in dates

> mydate2 <- mydate + 40
> mydate2 - mydate
Time difference of 40 days

# posix - days since Jan 1, 1970
# unclass time will do this calculation in seconds

> unclass(mydate)
[1] 17125
```

In terms of packages that are good for dealing with dates and times:

*   lubridate
*   zoo
*   xts

```
# Get the current date: today
> today <- Sys.Date()
>
# See what today looks like under the hood
> unclass(today)
[1] 17124
>
# Get the current time: now
> now <- Sys.time()
>
# See what now looks like under the hood
> unclass(now)
[1] 1479595508
```

To create a Date object from a simple character string in R, you can use the as.Date() function. The character string has to obey a format that can be defined using a set of symbols (the examples correspond to 13 January, 1982):

%Y: 4-digit year (1982)
%y: 2-digit year (82)
%m: 2-digit month (01)
%d: 2-digit day of the month (13)
%A: weekday (Wednesday)
%a: abbreviated weekday (Wed)
%B: month (January)
%b: abbreviated month (Jan)

The following R commands will all create the same Date object for 13 January, 1982:

as.Date("1982-01-13")
as.Date("Jan-13-82", format = "%b-%d-%y")
as.Date("13 January, 1982", format = "%d %B, %Y")

Notice that the first line here did not need a format argument, because by default R matches your character string to the formats "%Y-%m-%d" or "%Y/%m/%d".

In addition to creating dates, you can also convert dates to character strings that use a different date notation. For this, you use the format() function. Try the following lines of code:

today <- Sys.Date()
format(Sys.Date(), format = "%d %B, %Y")
format(Sys.Date(), format = "Today is a %A!")

```
# Definition of character strings representing dates
> str1 <- "May 23, '96"
> str2 <- "2012-03-15"
> str3 <- "30/January/2006"
>
# Convert the strings to dates: date1, date2, date3
> date1 <- as.Date(str1, format = "%b %d, '%y")
> date2 <- as.Date(str2, format = "%Y-%m-%d")
> date3 <- as.Date(str3, format = "%d/%B/%Y")
>
>
# Convert dates to formatted strings
> format(date1, "%A")
[1] "Thursday"
> format(date2, "%d")
[1] "15"
> format(date3, "%b %Y")
[1] "Jan 2006"
```

Similar to working with dates, you can use as.POSIXct() to convert from a character string to a POSIXct object, and format() to convert from a POSIXct object to a character string. Again, you have a wide variety of symbols:

%H: hours as a decimal number (00-23)
%M: minutes as a decimal number
%S: seconds as a decimal number
%T: shorthand notation for the typical format %H:%M:%S

For a full list of conversion symbols, consult the strptime documentation in the console:

?strptime

Again, as.POSIXct() uses a default format to match character strings. In this case, it's %Y-%m-%d %H:%M:%S. In this exercise, abstraction is made of different time zones.

```
# Definition of character strings representing times
> str1 <- "May 23, '96 hours:23 minutes:01 seconds:45"
> str2 <- "2012-3-12 14:23:08"
>
# Convert the strings to POSIXct objects: time1, time2
> time1 <- as.POSIXct(str1, format = "%B %d, '%y hours:%H minutes:%M seconds:%S")
> time2 <- as.POSIXct(str2, format = "%Y-%m-%d %H:%M:%S")
>
# Convert times to formatted strings
> format(time1, "%M")
[1] "01"
> format(time2, "%I:%M %p")
[1] "02:23 PM"
```

Both Date and POSIXct R objects are represented by simple numerical values under the hood. This makes calculation with time and date objects very straightforward: R performs the calculations using the underlying numerical values, and then converts the result back to human-readable time information again.

You can increment and decrement Date objects, or do actual calculations with them (try it out in the console!):

today <- Sys.Date()
today + 1
today - 1

as.Date("2015-03-12") - as.Date("2015-02-27")

```
# Difference between last and first pizza day
> day5 - day1
Time difference of 11 days
>
# Create vector pizza
> pizza <- c(day1, day2, day3, day4, day5)
>
# Create differences between consecutive pizza days: day_diff
> day_diff <- diff(pizza)
>
# Average period between two consecutive pizza days
> mean(day_diff)
Time difference of 2.75 days
```

Calculations using POSIXct objects are completely analogous to those using Date objects. Try to experiment with this code to increase or decrease POSIXct objects:

now <- Sys.time()
now + 3600 # add an hour
now - 3600\*24 # subtract a day
Adding or substracting time objects is also straightforward:

birth <- as.POSIXct("1879-03-14 14:37:23")
death <- as.POSIXct("1955-04-18 03:47:12")
einstein <- death - birth
einstein

```
# login and logout are already defined in the workspace
# Calculate the difference between login and logout: time_online
> time_online <- logout - login
>
# Inspect the variable time_online
> time_online
Time differences in secs
[1] 2305.11818   34.18472  837.18182 2397.90153 1851.30411
>
# Calculate the total time online
> sum(time_online)
Time difference of 7425.69 secs
>
# Calculate the average time online
> mean(time_online)
Time difference of 1485.138 secs
```

```
> astro
       spring        summer          fall        winter
"20-Mar-2015" "25-Jun-2015" "23-Sep-2015" "22-Dec-2015"

> meteo
           spring            summer              fall            winter
    "March 1, 15"      "June 1, 15" "September 1, 15"  "December 1, 15"

# Convert astro to vector of Date objects: astro_dates
> astro_dates <- as.Date(astro, format="%d-%B-%Y")
>
> astro_dates
[1] "2015-03-20" "2015-06-25" "2015-09-23" "2015-12-22"
# Convert meteo to vector of Date objects: meteo_dates
> meteo_dates <- as.Date(meteo, format="%B %d, %y")
>
> meteo_dates
[1] "2015-03-01" "2015-06-01" "2015-09-01" "2015-12-01"
# Calculate the maximum absolute difference between astro_dates and meteo_dates
> max(abs(astro_dates - meteo_dates))
Time difference of 24 days
```
