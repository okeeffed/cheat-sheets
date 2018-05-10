# Introduction to R

<!-- TOC -->

*   [Introduction to R](#introduction-to-r)
    *   [Table of Contents](#table-of-contents)
    *   [R-1: How it Works](#r-1-how-it-works)
        *   [---- Arithmetic with R](#-----arithmetic-with-r)
        *   [---- Variable Assignment](#-----variable-assignment)
        *   [---- Basic data types in R](#-----basic-data-types-in-r)
    *   [R-2: Vectors](#r-2-vectors)
        *   [---- Naming a Vector](#-----naming-a-vector)
        *   [---- Vector Selection](#-----vector-selection)
*   [Poker and roulette winnings from Monday to Friday:](#poker-and-roulette-winnings-from-monday-to-friday)
*   [Define a new variable based on a selection](#define-a-new-variable-based-on-a-selection) - [---- Selection by Comparison](#-----selection-by-comparison)
    *   [R-3: Matrices](#r-3-matrices)
        *   [---- Naming a matrix](#-----naming-a-matrix)
        *   [---- Adding a Row](#-----adding-a-row)
        *   [---- All functions for combining](#-----all-functions-for-combining)
        *   [---- Selection of Matrix Elements](#-----selection-of-matrix-elements)
        *   [---- Matrix Arithmetic](#-----matrix-arithmetic)
    *   [Factors in R](#factors-in-r)
        *   [---- Summarizing a factor](#-----summarizing-a-factor)
        *   [---- Ordered Factors](#-----ordered-factors)
    *   [Data Frames](#data-frames)
        *   [---- Selection of data frame elements](#-----selection-of-data-frame-elements)
        *   [---- Subsets](#-----subsets)
        *   [---- Sorting](#-----sorting)
    *   [Lists](#lists)
        *   [---- Selecting Elements from a List](#-----selecting-elements-from-a-list)
        *   [---- Adding more components to a list](#-----adding-more-components-to-a-list)

<!-- /TOC -->

## Table of Contents

<a href="#1">How it Works</a>

<div id="1"></div>

---

## R-1: How it Works

In the editor on the right you should type R code to solve the exercises. When you hit the 'Submit Answer' button, every line of code is interpreted and executed by R and you get a message whether or not your code was correct. The output of your R code is shown in the console in the lower right corner.

R makes use of the # sign to add comments, so that you and others can understand what the R code is about. Just like Twitter! Comments are not run as R code, so they will not influence your result. For example, Calculate 3 + 4 in the editor on the right is a comment.

You can also execute R commands straight in the console. This is a good way to experiment with R code, as your submission is not checked for correctness.

<div id="2"></div>

### ---- Arithmetic with R

In its most basic form, R can be used as a simple calculator. Consider the following arithmetic operators:

Addition: +
Subtraction: -
Multiplication: \*
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

Decimals values like 4.5 are called **numerics**.
Natural numbers like 4 are called integers. Integers are also **numerics**.
Boolean values (TRUE or FALSE) are called **logical**.
Text (or string) values are called **characters**.
Note how the quotation marks on the right indicate that "some text" is a **character**.

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

---

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

**Vector Selection**

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
> <= for less than or equal to
> = for greater than or equal to
> == for equal to each other
> != not equal to each other
> As seen in the previous chapter, stating 6 > 5 returns TRUE. The nice thing about R is that you can use these comparison operators also on vectors. For example:

> c(4, 5, 6) > 5
> [1] FALSE FALSE TRUE
> This command tests for every element of the vector if the condition stated by the comparison operator is TRUE or FALSE

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

---

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

**Creating a matrix using variables**

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

<div id="addrow"></div>

### ---- Adding a Row

Just like every action has a reaction, every cbind() has an rbind(). (We admit, we are pretty bad with metaphors.)

```
# star_wars_matrix and star_wars_matrix2 are available in your workspace
> star_wars_matrix  
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
> star_wars_matrix2
                        US non-US
The Phantom Menace   474.5  552.5
Attack of the Clones 310.7  338.7
Revenge of the Sith  380.3  468.5
>
# Combine both Star Wars trilogies in one matrix
> all_wars_matrix <- rbind(star_wars_matrix, star_wars_matrix2)
> all_wars_matrix
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
The Phantom Menace      474.5  552.5
Attack of the Clones    310.7  338.7
Revenge of the Sith     380.3  468.5
```

<div id="newSection"></div>

### ---- All functions for combining

```
cbind()
rbind()
colSums()
rowSums()
```

```
> all_wars_matrix
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
The Phantom Menace      474.5  552.5
Attack of the Clones    310.7  338.7
Revenge of the Sith     380.3  468.5
>
# Total revenue for US and non-US
> total_revenue_vector <- colSums(all_wars_matrix)
>
# Print out total_revenue_vector
> total_revenue_vector
    US non-US
2226.3 2087.8
```

<div id="matrixElements"></div>

### ---- Selection of Matrix Elements

Similar to vectors, you can use the square brackets [ ] to select one or multiple elements from a matrix. Whereas vectors have one dimension, matrices have two dimensions. You should therefore use a comma to separate that what to select from the rows from that what you want to select from the columns. For example:

my_matrix[1,2] selects the element at the first row and second column.
my_matrix[1:3,2:4] results in a matrix with the data on the rows 1, 2, 3 and columns 2, 3, 4.
If you want to select all elements of a row or a column, no number is needed before or after the comma, respectively:

my_matrix[,1] selects all elements of the first column.
my_matrix[1,] selects all elements of the first row.

```
> all_wars_matrix
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
The Phantom Menace      474.5  552.5
Attack of the Clones    310.7  338.7
Revenge of the Sith     380.3  468.5
>
# Select the non-US revenue for all movies
> non_us_all <- all_wars_matrix[,2]
>
# Average non-US revenue
> mean(non_us_all)
[1] 347.9667
>
# Select the non-US revenue for first two movies
> non_us_some <- all_wars_matrix[1:2,2]
>
# Average non-US revenue for first two movies
> mean(non_us_some)
[1] 281.15
```

<div id="matrixArithmetic"></div>

### ---- Matrix Arithmetic

Basic arithmetic also works

```
> all_wars_matrix
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
The Phantom Menace      474.5  552.5
Attack of the Clones    310.7  338.7
Revenge of the Sith     380.3  468.5
>
# Estimate the visitors
> visitors <- all_wars_matrix / 5
>
# Print the estimate to the console
> visitors
                           US non-US
A New Hope              92.20  62.88
The Empire Strikes Back 58.10  49.58
Return of the Jedi      61.86  33.16
The Phantom Menace      94.90 110.50
Attack of the Clones    62.14  67.74
Revenge of the Sith     76.06  93.70
```

```
> all_wars_matrix
                           US non-US
A New Hope              461.0  314.4
The Empire Strikes Back 290.5  247.9
Return of the Jedi      309.3  165.8
The Phantom Menace      474.5  552.5
Attack of the Clones    310.7  338.7
Revenge of the Sith     380.3  468.5
> ticket_prices_matrix
                         US non-US
A New Hope              5.0    5.0
The Empire Strikes Back 6.0    6.0
Return of the Jedi      7.0    7.0
The Phantom Menace      4.0    4.0
Attack of the Clones    4.5    4.5
Revenge of the Sith     4.9    4.9
>
# Estimated number of visitors
> visitors <- all_wars_matrix / ticket_prices_matrix
>
# US visitors
> us_visitors <- visitors[,1]
>
# Average number of US visitors
> mean(us_visitors)
[1] 75.01401
```

Those who are familiar with matrices should note that this is not the standard matrix multiplication for which you should use `%*%` in R.

```
> all_wars_matrix[,1] %*% ticket_prices_matrix[,1]
         [,1]
[1,] 11372.72
```

<div id="factors"></div>

---

## Factors in R

The term factor refers to a statistical data type used to store categorical variables. The difference between a categorical variable and a continuous variable is that a categorical variable can belong to a limited number of categories. A continuous variable, on the other hand, can correspond to an infinite number of values.

It is important that R knows whether it is dealing with a continuous or a categorical variable, as the statistical models you will develop in the future treat both types differently. (You will see later why this is the case.)

A good example of a categorical variable is the variable 'Gender'. A human individual can either be "Male" or "Female", making abstraction of inter-sexes. So here "Male" and "Female" are, in a simplified sense, the two values of the categorical variable "Gender", and every observation can be assigned to either the value "Male" of "Female".

To create factors in R, you make use of the function factor(). First thing that you have to do is create a vector that contains all the observations that belong to a limited number of categories. For example, gender_vector contains the sex of 5 different individuals:

```
gender_vector <- c("Male","Female","Female","Male","Male")
```

It is clear that there are two categories, or in R-terms 'factor levels', at work here: "Male" and "Female".

The function factor() will encode the vector as a factor:

```
factor_gender_vector <- factor(gender_vector)
```

```
# Gender vector
> gender_vector <- c("Male", "Female", "Female", "Male", "Male")
>
# Convert gender_vector to a factor
> factor_gender_vector <- factor(gender_vector)
>
# Print out factor_gender_vector
> factor_gender_vector
[1] Male   Female Female Male   Male  
Levels: Female Male
> gender_vector
[1] "Male"   "Female" "Female" "Male"   "Male"
```

There are two types of categorical variables: a nominal categorical variable and an ordinal categorical variable.

A nominal variable is a categorical variable without an implied order. This means that it is impossible to say that 'one is worth more than the other'. For example, think of the categorical variable animals_vector with the categories "Elephant", "Giraffe", "Donkey" and "Horse". Here, it is impossible to say that one stands above or below the other. (Note that some of you might disagree ;-) ).

In contrast, ordinal variables do have a natural ordering. Consider for example the categorical variable temperature_vector with the categories: "Low", "Medium" and "High". Here it is obvious that "Medium" stands above "Low", and "High" stands above "Medium".

```
# Animals
> animals_vector <- c("Elephant", "Giraffe", "Donkey", "Horse")
> factor_animals_vector <- factor(animals_vector)
> factor_animals_vector
[1] Elephant Giraffe  Donkey   Horse
Levels: Donkey Elephant Giraffe Horse
>
# Temperature
> temperature_vector <- c("High", "Low", "High","Low", "Medium")
> factor_temperature_vector <- factor(temperature_vector, order = TRUE, levels = c("Low", "Medium", "High"))
> factor_temperature_vector
[1] High   Low    High   Low    Medium
Levels: Low < Medium < High
```

The `levels()` function allows you to change the levels later.

Watch out: the order with which you assign the levels is important. R would assign them alphabetically by default.

```
# Code to build factor_survey_vector
> survey_vector <- c("M", "F", "F", "M", "M")
> factor_survey_vector <- factor(survey_vector)
>
# Specify the levels of factor_survey_vector
> levels(factor_survey_vector) <- c("Female", "Male")
>
> factor_survey_vector
[1] Male   Female Female Male   Male  
Levels: Female Male
```

<div id="factorSummary"></div>

### ---- Summarizing a factor

`summary(my_var)`

```
> survey_vector <- c("M", "F", "F", "M", "M")
> factor_survey_vector <- factor(survey_vector)
> levels(factor_survey_vector) <- c("Female", "Male")
> factor_survey_vector
[1] Male   Female Female Male   Male  
Levels: Female Male
>
# Generate summary for survey_vector
> summary(survey_vector)
   Length     Class      Mode
        5 character character
>
# Generate summary for factor_survey_vector
> summary(factor_survey_vector)
Female   Male
     2      3
```

Gender Neutral

```
# Build factor_survey_vector with clean levels
> survey_vector <- c("M", "F", "F", "M", "M")
> factor_survey_vector <- factor(survey_vector)
> levels(factor_survey_vector) <- c("Female", "Male")
>
# Male
> male <- factor_survey_vector[1]
>
# Female
> female <- factor_survey_vector[2]
>
# Battle of the sexes: Male 'larger' than female?
> male > female
Warning message: '>' not meaningful for factors
[1] NA
```

<div id="orderedFactors"></div>

### ---- Ordered Factors

Since "Male" and "Female" are unordered (or nominal) factor levels, R returns a warning message, telling you that the greater than operator is not meaningful. As seen before, R attaches an equal value to the levels for such factors.

But this is not always the case! Sometimes you will also deal with factors that do have a natural ordering between its categories. If this is the case, we have to make sure that we pass this information to R...

Let us say that you are leading a research team of five data analysts and that you want to evaluate their performance. To do this, you track their speed, evaluate each analyst as "slow", "fast" or "insane", and save the results in speed_vector.

```
# Create speed_vector
> speed_vector <- c("fast", "slow", "slow", "fast", "insane")
>
# Convert speed_vector to ordered factor vector
> factor_speed_vector <- factor(speed_vector, ordered=TRUE, levels = c("slow", "fast", "insane"))
>
# Print factor_speed_vector
> factor_speed_vector
[1] fast   slow   slow   fast   insane
Levels: slow < fast < insane
> summary(factor_speed_vector)
  slow   fast insane
     2      2      1
```

Then as an example of comparing Ordered Factors

```
# Create factor_speed_vector
> speed_vector <- c("fast", "slow", "slow", "fast", "insane")
> factor_speed_vector <- factor(speed_vector, ordered = TRUE, levels = c("slow", "fast", "insane"))
>
# Factor value for second data analyst
> da2 <- factor_speed_vector[2]
>
# Factor value for fifth data analyst
> da5 <- factor_speed_vector[5]
>
# Is data analyst 2 faster than data analyst 5?
> da2 > da5
[1] FALSE
```

<div id="dataFrames"></div>

---

## Data Frames

When doing a market research survey, you often have questions such as:

'Are your married?' or 'yes/no' questions (logical)
'How old are you?' (numeric)
'What is your opinion on this product?' or other 'open-ended' questions (character)
...
The output, namely the respondents' answers to the questions formulated above, is a data set of different data types. You will often find yourself working with data sets that contain different data types instead of only one.

A data frame has the variables of a data set as columns and the observations as rows. This will be a familiar concept for those coming from different statistical software packages such as SAS or SPSS.

Working with large data sets is not uncommon in data analysis. When you work with (extremely) large data sets and data frames, your first task as a data analyst is to develop a clear understanding of its structure and main elements. Therefore, it is often useful to show only a small part of the entire data set.

So how to do this in R? Well, the function head() enables you to show the first observations of a data frame. Similarly, the function tail() prints out the last observations in your data set.

Both head() and tail() print a top line called the 'header', which contains the names of the different variables in your data set. This is similar to the unix command.

```
> head(mtcars)
                   mpg cyl disp  hp drat    wt  qsec vs am gear carb
Mazda RX4         21.0   6  160 110 3.90 2.620 16.46  0  1    4    4
Mazda RX4 Wag     21.0   6  160 110 3.90 2.875 17.02  0  1    4    4
Datsun 710        22.8   4  108  93 3.85 2.320 18.61  1  1    4    1
Hornet 4 Drive    21.4   6  258 110 3.08 3.215 19.44  1  0    3    1
Hornet Sportabout 18.7   8  360 175 3.15 3.440 17.02  0  0    3    2
Valiant           18.1   6  225 105 2.76 3.460 20.22  1  0    3    1
```

Another method that is often used to get a rapid overview of your data is the function str(). The function str() shows you the structure of your data set. For a data frame it tells you:

*   The total number of observations (e.g. 32 car types)
*   The total number of variables (e.g. 11 car features)
*   A full list of the variables names (e.g. mpg, cyl ... )
*   The data type of each variable (e.g. num)
*   The first observations

Applying the str() function will often be the first thing that you do when receiving a new data set or data frame. It is a great way to get more insight in your data set before diving into the real analysis.

```
# Investigate the structure of mtcars
> str(mtcars)
'data.frame':	32 obs. of  11 variables:
 $ mpg : num  21 21 22.8 21.4 18.7 18.1 14.3 24.4 22.8 19.2 ...
 $ cyl : num  6 6 4 6 8 6 8 4 4 6 ...
 $ disp: num  160 160 108 258 360 ...
 $ hp  : num  110 110 93 110 175 105 245 62 95 123 ...
 $ drat: num  3.9 3.9 3.85 3.08 3.15 2.76 3.21 3.69 3.92 3.92 ...
 $ wt  : num  2.62 2.88 2.32 3.21 3.44 ...
 $ qsec: num  16.5 17 18.6 19.4 17 ...
 $ vs  : num  0 0 1 1 0 1 0 1 1 1 ...
 $ am  : num  1 1 1 0 0 0 0 0 0 0 ...
 $ gear: num  4 4 4 3 3 3 3 4 4 4 ...
 $ carb: num  4 4 1 1 2 1 4 2 2 4 ...

# Check the structure of planets_df
> str(planets_df)
'data.frame':	8 obs. of  5 variables:
 $ name    : Factor w/ 8 levels "Earth","Jupiter",..: 4 8 1 3 2 6 7 5
 $ type    : Factor w/ 2 levels "Gas giant","Terrestrial planet": 2 2 2 2 1 1 1 1
 $ diameter: num  0.382 0.949 1 0.532 11.209 ...
 $ rotation: num  58.64 -243.02 1 1.03 0.41 ...
 $ rings   : logi  FALSE FALSE FALSE FALSE TRUE TRUE ...
```

<div id="selectionFrameElements"></div>

### ---- Selection of data frame elements

Similar to vectors and matrices, you select elements from a data frame with the help of square brackets [ ]. By using a comma, you can indicate what to select from the rows and the columns respectively. For example:

my_df[1,2] selects the value at the first row and select element in my_df.
my_df[1:3,2:4] selects rows 1, 2, 3 and columns 2, 3, 4 in my_df.
Sometimes you want to select all elements of a row or column. For example, my_df[1, ] selects all elements of the first row. Let us now apply this technique on planets_df!

```
> planets_df
     name               type diameter rotation rings
1 Mercury Terrestrial planet    0.382    58.64 FALSE
2   Venus Terrestrial planet    0.949  -243.02 FALSE
3   Earth Terrestrial planet    1.000     1.00 FALSE
4    Mars Terrestrial planet    0.532     1.03 FALSE
5 Jupiter          Gas giant   11.209     0.41  TRUE
6  Saturn          Gas giant    9.449     0.43  TRUE
7  Uranus          Gas giant    4.007    -0.72  TRUE
8 Neptune          Gas giant    3.883     0.67  TRUE

# Print out diameter of Mercury (row 1, column 3)
> planets_df[1,3]
[1] 0.382
>
# Print out data for Mars (entire fourth row)
> planets_df[4, ]
  name               type diameter rotation rings
4 Mars Terrestrial planet    0.532     1.03 FALSE

# Select first 5 values of diameter column
> planets_df[1:5, "diameter"]
[1]  0.382  0.949  1.000  0.532 11.209

# Select the rings variable from planets_df
> rings_vector <- planets_df[,"rings"]
>
# Print out rings_vector
> rings_vector
[1] FALSE FALSE FALSE FALSE  TRUE  TRUE  TRUE  TRUE

# Adapt the code to select all columns for planets with rings
> planets_df[rings_vector, ]
     name      type diameter rotation rings
5 Jupiter Gas giant   11.209     0.41  TRUE
6  Saturn Gas giant    9.449     0.43  TRUE
7  Uranus Gas giant    4.007    -0.72  TRUE
8 Neptune Gas giant    3.883     0.67  TRUE
```

<div id="subsets"></div>

### ---- Subsets

You should see the subset() function as a short-cut to do exactly the same as what you did in the previous exercises.

subset(my_df, subset = some_condition)
The first argument of subset() specifies the data set for which you want a subset. By adding the second argument, you give R the necessary information and conditions to select the correct subset.

The code below will give the exact same result as you got in the previous exercise, but this time, you didn't need the rings_vector!

subset(planets_df, subset = rings)

```
# Select planets with diameter < 1
> subset(planets_df, subset = diameter < 1)
     name               type diameter rotation rings
1 Mercury Terrestrial planet    0.382    58.64 FALSE
2   Venus Terrestrial planet    0.949  -243.02 FALSE
4    Mars Terrestrial planet    0.532     1.03 FALSE

> subset(planets_df, subset = diameter > 1)
     name      type diameter rotation rings
5 Jupiter Gas giant   11.209     0.41  TRUE
6  Saturn Gas giant    9.449     0.43  TRUE
7  Uranus Gas giant    4.007    -0.72  TRUE
8 Neptune Gas giant    3.883     0.67  TRUE
```

<div id="sorting"></div>

### ---- Sorting

In data analysis you can sort your data according to a certain variable in the data set. In R, this is done with the help of the function order().

order() is a function that gives you the ranked position of each element when it is applied on a variable, such as a vector for example:

```
> a <- c(100, 10, 1000)
> order(a)
[1] 2 1 3
```

10, which is the second element in a, is the smallest element, so 2 comes first in the output of order(a). 100, which is the first element in a is the second smallest element, so 1 comes second in the output of order(a).

This means we can use the output of order(a) to reshuffle a:

```
> a <- c(10, 30, 100)
> order(a)
[1] 1 2 3
> b <- c(100, 300, 20)
> order(b)
[1] 3 1 2
> c <- a + b
> order(c)
[1] 1 3 2
> c[order(c)]
[1] 110 120 330
```

```
# planets_df is pre-loaded in your workspace
> planets_df$diameter
[1]  0.382  0.949  1.000  0.532 11.209  9.449  4.007  3.883

# Use order() to create positions
> positions <- order(planets_df$diameter)
> planets_df
     name               type diameter rotation rings
1 Mercury Terrestrial planet    0.382    58.64 FALSE
2   Venus Terrestrial planet    0.949  -243.02 FALSE
3   Earth Terrestrial planet    1.000     1.00 FALSE
4    Mars Terrestrial planet    0.532     1.03 FALSE
5 Jupiter          Gas giant   11.209     0.41  TRUE
6  Saturn          Gas giant    9.449     0.43  TRUE
7  Uranus          Gas giant    4.007    -0.72  TRUE
8 Neptune          Gas giant    3.883     0.67  TRUE

# Use positions to sort planets_df
> planets_df[positions, ]
     name               type diameter rotation rings
1 Mercury Terrestrial planet    0.382    58.64 FALSE
4    Mars Terrestrial planet    0.532     1.03 FALSE
2   Venus Terrestrial planet    0.949  -243.02 FALSE
3   Earth Terrestrial planet    1.000     1.00 FALSE
8 Neptune          Gas giant    3.883     0.67  TRUE
7  Uranus          Gas giant    4.007    -0.72  TRUE
6  Saturn          Gas giant    9.449     0.43  TRUE
5 Jupiter          Gas giant   11.209     0.41  TRUE

> planets_df
     name               type diameter rotation rings
1 Mercury Terrestrial planet    0.382    58.64 FALSE
2   Venus Terrestrial planet    0.949  -243.02 FALSE
3   Earth Terrestrial planet    1.000     1.00 FALSE
4    Mars Terrestrial planet    0.532     1.03 FALSE
5 Jupiter          Gas giant   11.209     0.41  TRUE
6  Saturn          Gas giant    9.449     0.43  TRUE
7  Uranus          Gas giant    4.007    -0.72  TRUE
8 Neptune          Gas giant    3.883     0.67  TRUE
```

<div id="lists"></div>

---

## Lists

**Recap so far**

*   Vectors (one dimensional array): can hold numeric, character or logical values. The elements in a vector all have the same data type.

*   Matrices (two dimensional array): can hold numeric, character or logical values. The elements in a matrix all have the same data type.

*   Data frames (two-dimensional objects): can hold numeric, character or logical values. Within a column all elements have the same data type, but different columns can be of different data type.

**Lists**

A list in R is similar to your to-do list at work or school: the different items on that list most likely differ in length, characteristic, type of activity that has to do be done, ...

A list in R allows you to gather a variety of objects under one name (that is, the name of the list) in an ordered way. These objects can be matrices, vectors, data frames, even other lists, etc. It is not even required that these objects are related to each other in any way.

```
my_list <- list(comp1, comp2, ...)
```

The arguments to the list function are the list components.

```
# Vector with numerics from 1 up to 10
> my_vector <- 1:10
>
# Matrix with numerics from 1 up to 9
> my_matrix <- matrix(1:9, ncol = 3)
>
# First 10 elements of the built-in data frame mtcars
> my_df <- mtcars[1:10,]
>
# Construct list with these different elements:
> my_list <- list(my_vector, my_matrix, my_df)
> my_list
[[1]]
 [1]  1  2  3  4  5  6  7  8  9 10

[[2]]
     [,1] [,2] [,3]
[1,]    1    4    7
[2,]    2    5    8
[3,]    3    6    9

[[3]]
                   mpg cyl  disp  hp drat    wt  qsec vs am gear carb
Mazda RX4         21.0   6 160.0 110 3.90 2.620 16.46  0  1    4    4
Mazda RX4 Wag     21.0   6 160.0 110 3.90 2.875 17.02  0  1    4    4
Datsun 710        22.8   4 108.0  93 3.85 2.320 18.61  1  1    4    1
Hornet 4 Drive    21.4   6 258.0 110 3.08 3.215 19.44  1  0    3    1
Hornet Sportabout 18.7   8 360.0 175 3.15 3.440 17.02  0  0    3    2
Valiant           18.1   6 225.0 105 2.76 3.460 20.22  1  0    3    1
Duster 360        14.3   8 360.0 245 3.21 3.570 15.84  0  0    3    4
Merc 240D         24.4   4 146.7  62 3.69 3.190 20.00  1  0    4    2
Merc 230          22.8   4 140.8  95 3.92 3.150 22.90  1  0    4    2
Merc 280          19.2   6 167.6 123 3.92 3.440 18.30  1  0    4    4
```

**Naming a List**

We can use the name() function to get around this.

```
my_list <- list(name1 = your_comp1,
                name2 = your_comp2)
```

We also alter names later like so...

```
my_list <- list(your_comp1, your_comp2)
names(my_list) <- c("name1", "name2")
```

Continuing on from the above exampe...

```
> names(my_list) <- c("vec", "mat", "df")
>
> # Print out my_list
> my_list
$vec
 [1]  1  2  3  4  5  6  7  8  9 10

$mat
     [,1] [,2] [,3]
[1,]    1    4    7
[2,]    2    5    8
[3,]    3    6    9

$df
                   mpg cyl  disp  hp drat    wt  qsec vs am gear carb
Mazda RX4         21.0   6 160.0 110 3.90 2.620 16.46  0  1    4    4
Mazda RX4 Wag     21.0   6 160.0 110 3.90 2.875 17.02  0  1    4    4
Datsun 710        22.8   4 108.0  93 3.85 2.320 18.61  1  1    4    1
Hornet 4 Drive    21.4   6 258.0 110 3.08 3.215 19.44  1  0    3    1
Hornet Sportabout 18.7   8 360.0 175 3.15 3.440 17.02  0  0    3    2
Valiant           18.1   6 225.0 105 2.76 3.460 20.22  1  0    3    1
Duster 360        14.3   8 360.0 245 3.21 3.570 15.84  0  0    3    4
Merc 240D         24.4   4 146.7  62 3.69 3.190 20.00  1  0    4    2
Merc 230          22.8   4 140.8  95 3.92 3.150 22.90  1  0    4    2
Merc 280          19.2   6 167.6 123 3.92 3.440 18.30  1  0    4    4
```

Another example of naming List components.

```
> shining_list <- list(moviename = mov, actors = act, reviews = rev)
> shining_list
$moviename
[1] "The Shining"

$actors
[1] "Jack Nicholson"   "Shelley Duvall"   "Danny Lloyd"      "Scatman Crothers"
[5] "Barry Nelson"

$reviews
  scores sources                                              comments
1    4.5   IMDb1                     Best Horror Film I Have Ever Seen
2    4.0   IMDb2 A truly brilliant and scary film from Stanley Kubrick
3    5.0   IMDb3                 A masterpiece of psychological horror
```

<div id="listelements"></div>

### ---- Selecting Elements from a List

Your list will often be built out of numerous elements and components. Therefore, getting a single element, multiple elements, or a component out of it is not always straightforward.

One way to select a component is using the numbered position of that component. For example, to "grab" the first component of shining_list you type

`shining_list[[1]]`

A quick way to check this out is typing it in the console. Important to remember: to select elements from vectors, you use single square brackets: [ ]. Don't mix them up!

You can also refer to the names of the components, with [[ ]] or with the $ sign. Both will select the data frame representing the reviews:

```
shining_list[["reviews"]]
shining_list$reviews
```

Besides selecting components, you often need to select specific elements out of these components. For example, with `shining_list[[2]][1]` you select from the second component, actors (`shining_list[[2]]`), the first element (`[1]`). When you type this in the console, you will see the answer is Jack Nicholson.

```
# Print out the vector representing the actors
> shining_list$actors
[1] "Jack Nicholson"   "Shelley Duvall"   "Danny Lloyd"      "Scatman Crothers"
[5] "Barry Nelson"
>
# Print the second element of the vector representing the actors
> shining_list[["actors"]][2]
[1] "Shelley Duvall"
```

<div id="addingelems"></div>

### ---- Adding more components to a list

To conveniently add elements to lists you can use the c() function, that you also used to build vectors:

`ext_list <- c(my_list , my_val)`

This will simply extend the original list, `my_list`, with the component `my_val`. This component gets appended to the end of the list. If you want to give the new list item a name, you just add the name as you did before:

`ext_list <- c(my_list, my_name = my_val)`

```
# We forgot something; add the year to shining_list
> shining_list_full <- c(shining_list, year = 1980)
>
# Have a look at shining_list_full
> str(shining_list_full)
List of 4
 $ moviename: chr "The Shining"
 $ actors   : chr [1:5] "Jack Nicholson" "Shelley Duvall" "Danny Lloyd" "Scatman Crothers" ...
 $ reviews  :'data.frame':	3 obs. of  3 variables:
  ..$ scores  : num [1:3] 4.5 4 5
  ..$ sources : Factor w/ 3 levels "IMDb1","IMDb2",..: 1 2 3
  ..$ comments: Factor w/ 3 levels "A masterpiece of psychological horror",..: 3 2 1
 $ year     : num 1980
```
