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

***

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
> # The nyc list is already specified
> nyc <- list(pop = 8405837, 
              boroughs = c("Manhattan", "Bronx", "Brooklyn", "Queens", "Staten Island"), 
              capital = FALSE)
> 
> # Loop version 1
> for (n in nyc) {
    print(n)
  }
[1] 8405837
[1] "Manhattan"     "Bronx"         "Brooklyn"      "Queens"       
[5] "Staten Island"
[1] FALSE
> 
> # Loop version 2
> for (i in 1:length(nyc)) {
    print(nyc[[i]])
  }
[1] 8405837
[1] "Manhattan"     "Bronx"         "Brooklyn"      "Queens"       
[5] "Staten Island"
[1] FALSE
```

__How about printing over a matrix?__

```
> # The tic-tac-toe matrix ttt has already been defined for you
> 
> # define the double for loop
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

__Mixing together Control Flow and Loops__

```
> # The linkedin vector has already been defined for you
> linkedin <- c(16, 9, 13, 5, 2, 17, 14)
> 
> # Code the for loop with conditionals
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










































