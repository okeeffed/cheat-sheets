# Introduction to R

## Table of Contents

<a href="#1">How it Works</a>

<div id="1"></div>

***

## R-1: How it Works

In the editor on the right you should type R code to solve the exercises. When you hit the 'Submit Answer' button, every line of code is interpreted and executed by R and you get a message whether or not your code was correct. The output of your R code is shown in the console in the lower right corner.

R makes use of the # sign to add comments, so that you and others can understand what the R code is about. Just like Twitter! Comments are not run as R code, so they will not influence your result. For example, Calculate 3 + 4 in the editor on the right is a comment.

You can also execute R commands straight in the console. This is a good way to experiment with R code, as your submission is not checked for correctness.

<div id="2"></div>

### ---- Arithmetic with R

In its most basic form, R can be used as a simple calculator. Consider the following arithmetic operators:

Addition: +
Subtraction: -
Multiplication: *
Division: /
Exponentiation: ^
Modulo: %%

The last two might need some explaining: - The ^ operator raises the number to its left to the power of the number to its right: for example 3^2 is 9. - The modulo returns the remainder of the division of the number to the left by the number on its right, for example 5 modulo 3 or 5 %% 3 is 2.

<div id="3"></div>

### ---- Variable Assignment

A basic concept in (statistical) programming is called a variable.

A variable allows you to store a value (e.g. 4) or an object (e.g. a function description) in R. You can then later use this variable's name to easily access the value or the object that is stored within this variable.

You can assign a value 4 to a variable my_var with the command

my_var <- 4

```
# Assign the value 42 to x
x <- 42

# Print out the value of the variable x
x

# Assign a value to the variables my_apples and my_oranges
my_apples <- 5
my_oranges <- 6

# Add these two variables together
my_apples + my_oranges

# Create the variable my_fruit
my_fruit <- my_apples + my_oranges
```

<div id="4"></div>

### ---- Basic data types in R

R works with numerous data types. Some of the most basic types to get started are:

Decimals values like 4.5 are called __numerics__.
Natural numbers like 4 are called integers. Integers are also __numerics__.
Boolean values (TRUE or FALSE) are called __logical__.
Text (or string) values are called __characters__.
Note how the quotation marks on the right indicate that "some text" is a __character__.

Note that R is case sensitive.

```
# Change my_numeric to be 42
my_numeric <- 42

# Change my_character to be "universe"
my_character <- "universe"

# Change my_logical to be FALSE
my_logical <- FALSE

# Declare variables of different types
my_numeric <- 42
my_character <- "universe"
my_logical <- FALSE 

# Check class of my_numeric
class(my_numeric)

# Check class of my_character
class(my_character)

# Check class of my_logical
class(my_logical)
```
<div id="vectors"></div>

***

## R-2: Vectors

In R, you create a vector with the combine function c(). You place the vector elements separated by a comma between the parentheses. For example:

numeric_vector <- c(1, 2, 3)
character_vector <- c("a", "b", "c")
Once you have created these vectors in R, you can use them to do calculations.

```
numeric_vector <- c(1, 10, 49)
character_vector <- c("a", "b", "c")

# Complete the code for boolean_vector
boolean_vector <- c(TRUE, FALSE, TRUE)
```

<div id="vectors2"></div>

### ---- Naming a Vector

You can give a name to the elements of a vector with the names() function. Have a look at this example:

some_vector <- c("John Doe", "poker player")
names(some_vector) <- c("Name", "Profession")
This code first creates a vector some_vector and then gives the two elements a name. The first element is assigned the name Name, while the second element is labeled Profession. Printing the contents to the console yields following output:

```
          Name     Profession 
    "John Doe" "poker player" 
```

```
# Poker winnings from Monday to Friday
poker_vector <- c(140, -50, 20, -120, 240)

# Roulette winnings from Monday to Friday
roulette_vector <- c(-24, -50, 100, -350, 10)

# Assign days as names of poker_vector
names(poker_vector) <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")

# Assign days as names of roulette_vectors
names(roulette_vector) <-c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")

# Poker winnings from Monday to Friday
poker_vector <- c(140, -50, 20, -120, 240)

# Roulette winnings from Monday to Friday
roulette_vector <- c(-24, -50, 100, -350, 10)

# The variable days_vector
days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
 
# Assign the names of the day to roulette_vector and poker_vector
names(poker_vector) <- days_vector
names(roulette_vector) <- days_vector

# Calculating a total vector
A_vector <- c(1, 2, 3)
B_vector <- c(4, 5, 6)

# Take the sum of A_vector and B_vector
total_vector <- A_vector + B_vector
  
# Print out total_vector
total_vector

## Ex 3

# Poker and roulette winnings from Monday to Friday:
poker_vector <- c(140, -50, 20, -120, 240)
roulette_vector <- c(-24, -50, 100, -350, 10)
days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
names(poker_vector) <- days_vector
names(roulette_vector) <- days_vector

# Total winnings with poker
total_poker <- sum(poker_vector)

# Total winnings with roulette
total_roulette <- sum(roulette_vector)

# Total winnings overall
total_week <- total_roulette + total_poker

# Print out total_week
total_week

## Ex 4

# Poker and roulette winnings from Monday to Friday:
poker_vector <- c(140, -50, 20, -120, 240)
roulette_vector <- c(-24, -50, 100, -350, 10)
days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
names(poker_vector) <- days_vector
names(roulette_vector) <- days_vector

# Calculate total gains for poker and roulette
total_poker <- sum(poker_vector)
total_roulette <- sum(roulette_vector)

# Check if you realized higher total gains in poker than in roulette 
total_poker > total_roulette
```

__Vector Selection__

### ---- Vector Selection

# Poker and roulette winnings from Monday to Friday:
poker_vector <- c(140, -50, 20, -120, 240)
roulette_vector <- c(-24, -50, 100, -350, 10)
days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
names(poker_vector) <- days_vector
names(roulette_vector) <- days_vector

# Define a new variable based on a selection
poker_wednesday <- poker_vector[3]

```
# Poker and roulette winnings from Monday to Friday:
poker_vector <- c(140, -50, 20, -120, 240)
roulette_vector <- c(-24, -50, 100, -350, 10)
days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
names(poker_vector) <- days_vector
names(roulette_vector) <- days_vector

# Define a new variable based on a selection
poker_midweek <- poker_vector[c(2,3,4)]
poker_midweek
```
```
# Poker and roulette winnings from Monday to Friday:
> poker_vector <- c(140, -50, 20, -120, 240)
> roulette_vector <- c(-24, -50, 100, -350, 10)
> days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
> names(poker_vector) <- days_vector
> names(roulette_vector) <- days_vector
> 
# Define a new variable based on a selection
> roulette_selection_vector <- roulette_vector[2:5]
```

Another way to tackle the previous exercise is by using the names of the vector elements (Monday, Tuesday, ...) instead of their numeric positions. For example,

poker_vector["Monday"]
will select the first element of poker_vector since "Monday" is the name of that first element.

Just like you did in the previous exercise with numerics, you can also use the element names to select multiple elements, for example:

poker_vector[c("Monday","Tuesday")]

```
# Poker and roulette winnings from Monday to Friday:
> poker_vector <- c(140, -50, 20, -120, 240)
> roulette_vector <- c(-24, -50, 100, -350, 10)
> days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
> names(poker_vector) <- days_vector
> names(roulette_vector) <- days_vector
> 
# Select poker results for Monday, Tuesday and Wednesday
> poker_start <- poker_vector[c("Monday", "Tuesday", "Wednesday")]
>   
# Calculate the average of the elements in poker_start
> mean(poker_start)
[1] 36.66667
```

<div id="vectors3"></div>

### ---- Selection by Comparison

By making use of comparison operators, we can approach the previous question in a more proactive way.

The (logical) comparison operators known to R are:

< for less than
> for greater than
<= for less than or equal to
>= for greater than or equal to
== for equal to each other
!= not equal to each other
As seen in the previous chapter, stating 6 > 5 returns TRUE. The nice thing about R is that you can use these comparison operators also on vectors. For example:

> c(4, 5, 6) > 5
[1] FALSE FALSE TRUE
This command tests for every element of the vector if the condition stated by the comparison operator is TRUE or FALSE

```
# Poker and roulette winnings from Monday to Friday:
> poker_vector <- c(140, -50, 20, -120, 240)
> roulette_vector <- c(-24, -50, 100, -350, 10)
> days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
> names(poker_vector) <- days_vector
> names(roulette_vector) <- days_vector
> 
# Which days did you make money on poker?
> selection_vector <- poker_vector > 0
>   
# Print out selection_vector
> selection_vector
   Monday   Tuesday Wednesday  Thursday    Friday 
     TRUE     FALSE      TRUE     FALSE      TRUE 
```

Working with comparisons will make your data analytical life easier. Instead of selecting a subset of days to investigate yourself (like before), you can simply ask R to return only those days where you realized a positive return for poker.

In the previous exercises you used selection_vector <- poker_vector > 0 to find the days on which you had a positive poker return. Now, you would like to know not only the days on which you won, but also how much you won on those days.

You can select the desired elements, by putting selection_vector between the square brackets that follow poker_vector:

poker_vector[selection_vector]
R knows what to do when you pass a logical vector in square brackets: it will only select the elements that correspond to TRUE in selection_vector.

```
# Poker and roulette winnings from Monday to Friday:
> poker_vector <- c(140, -50, 20, -120, 240)
> roulette_vector <- c(-24, -50, 100, -350, 10)
> days_vector <- c("Monday", "Tuesday", "Wednesday", "Thursday", "Friday")
> names(poker_vector) <- days_vector
> names(roulette_vector) <- days_vector
> 
# Which days did you make money on poker?
> selection_vector <- poker_vector > 0
> 
# Select from poker_vector these days
> poker_winning_days <- poker_vector[selection_vector]
> poker_winning_days
   Monday Wednesday    Friday 
      140        20       240 
```

<div id="matrix"></div>

***

## R-3: Matrices

In R, a matrix is a collection of elements of the same data type (numeric, character, or logical) arranged into a fixed number of rows and columns. Since you are only working with rows and columns, a matrix is called two-dimensional.

You can construct a matrix in R with the matrix() function. Consider the following example:

matrix(1:9, byrow = TRUE, nrow = 3)
In the matrix() function:

The first argument is the collection of elements that R will arrange into the rows and columns of the matrix. Here, we use 1:9 which is a shortcut for c(1, 2, 3, 4, 5, 6, 7, 8, 9).

The argument byrow indicates that the matrix is filled by the rows. If we want the matrix to be filled by the columns, we just place byrow = FALSE.
The third argument nrow indicates that the matrix should have three rows.

```
# Construct a matrix with 3 rows that contain the numbers 1 up to 9
> matrix(1:9, byrow = TRUE, nrow = 3)
     [,1] [,2] [,3]
[1,]    1    2    3
[2,]    4    5    6
[3,]    7    8    9
> matrix
function (data = NA, nrow = 1, ncol = 1, byrow = FALSE, dimnames = NULL) 
{
    if (is.object(data) || !is.atomic(data)) 
        data <- as.vector(data)
    .Internal(matrix(data, nrow, ncol, byrow, dimnames, missing(nrow), 
        missing(ncol)))
}
<bytecode: 0xdabe30>
<environment: namespace:base>
```

__Creating a matrix using variables__

```
# Box office Star Wars (in millions!)
> new_hope <- c(460.998, 314.4)
> empire_strikes <- c(290.475, 247.900)
> return_jedi <- c(309.306, 165.8)
> 
# Create box_office
> box_office <- c(new_hope, empire_strikes, return_jedi)
> 
# Construct star_wars_matrix
> star_wars_matrix <- matrix(box_office, byrow = TRUE, nrow = 3)
> star_wars_matrix
        [,1]  [,2]
[1,] 460.998 314.4
[2,] 290.475 247.9
[3,] 309.306 165.8
```

<div id="matrix2"></div>

### ---- Naming a matrix

Similar to vectors, you can add names for the rows and the columns of a matrix

rownames(my_matrix) <- row_names_vector
colnames(my_matrix) <- col_names_vector
We went ahead and prepared two vectors for you: region, and titles. You will need these vectors to name the columns and rows of star_wars_matrix, respectively.

```
# Box office Star Wars (in millions!)
> new_hope <- c(460.998, 314.4)
> empire_strikes <- c(290.475, 247.900)
> return_jedi <- c(309.306, 165.8)
> 
# Construct matrix
> star_wars_matrix <- matrix(c(new_hope, empire_strikes, return_jedi), nrow = 3, byrow = TRUE)
> 
# Vectors region and titles, used for naming
> region <- c("US", "non-US")
> titles <- c("A New Hope", "The Empire Strikes Back", "Return of the Jedi")
> 
# Name the columns with region
> colnames(star_wars_matrix) <- region
> 
# Name the rows with titles
> rownames(star_wars_matrix) <- titles
> 
# Print out star_wars_matrix
> star_wars_matrix
                             US non-US
A New Hope              460.998  314.4
The Empire Strikes Back 290.475  247.9
Return of the Jedi      309.306  165.8
```

In R, the function rowSums() conveniently calculates the totals for each row of a matrix. This function creates a new vector:

`rowSums(my_matrix)`

```
# Construct star_wars_matrix
> box_office <- c(460.998, 314.4, 290.475, 247.900, 309.306, 165.8)
> star_wars_matrix <- matrix(box_office, nrow = 3, byrow = TRUE,
                             dimnames = list(c("A New Hope", "The Empire Strikes Back", "Return of the Jedi"), 
                                             c("US", "non-US")))
> 
# Calculate worldwide box office figures
> worldwide_vector <- rowSums(star_wars_matrix)
```

You can add a column or multiple columns to a matrix with the cbind() function, which merges matrices and/or vectors together by column. For example:

big_matrix <- cbind(matrix1, matrix2, vector1 ...)

```
# Construct star_wars_matrix
> box_office <- c(460.998, 314.4, 290.475, 247.900, 309.306, 165.8)
> star_wars_matrix <- matrix(box_office, nrow = 3, byrow = TRUE,
                             dimnames = list(c("A New Hope", "The Empire Strikes Back", "Return of the Jedi"), 
                                             c("US", "non-US")))
> 
# The worldwide box office figures
> worldwide_vector <- rowSums(star_wars_matrix)
> 
# Bind the new variable worldwide_vector as a column to star_wars_matrix
> all_wars_matrix <- cbind(star_wars_matrix, worldwide_vector)
```