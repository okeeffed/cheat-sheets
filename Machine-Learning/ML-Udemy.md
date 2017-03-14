# Machine Learning - Udemy A-Z

***

## Part 1 - Data Preprocessing

## 1.0: The initial data

Dataset		| Example set 
---			| ---
Country		| String 
Age			| Int
Salary		| Int
Purchased 	| Boolean

This dataset also has `independent vs dependent` variables, with the `dependent` variable being the Purchased data.

So using the first three variables, we will predict the fourth column.

### Importing the Libraries

**In Python**

Libraries		| What for?
---				| ---
matplotlib 		| Has a bunch of very useful and intuitive tools
numpy			| Help with math 
pandas			| Imports and manages data sets 

```python
import numpy as np
import matplotlib.pyplot as plt
import pandas as pd
```

**In R**

Here, we don't need to import any libraries since R Studio comes with a bunch of them!

### Importing the Dataset

Here, we will import the variables and create a matrix of observations.

**In Python**

Set the working directory to where we need to be.

```python
# given the pandas import
dataset = pd.read_csv('Data.csv')
# iloc[lines, columns] -> :-1 all columns except last
X = dataset.iloc[:, :-1].values
# if we print X, it will create a matrix of the data and give a datatype
y = dataset.iloc[:, 3].values
# printing y will give the last column values
```

**In R**

REMEMBER - R Arrays begin from 1

```r 
#importing the dataset
dataset = read.csv('Data.csv');
```

### Missing Data 

How can handle the problem when there is null data for where the is missing data?

One way to get around this is to take the mean of the columns.

For these dataset in `Age`, we will replace that data with the mean.

**In Python**

The library will will use is `sklearn`.

`sklearn` is SideKick learn and is an amazing library. We import Imputer to help with the preprocessing.

```python 
from sklean.preprocessing import Imputer
# set NaN and we will see that the missing values are NaN
# strategy default is mean anyway but we'll be verbose
# axis = 0
imputer = Imputer(missing_values = 'NaN', strategy = 'mean', axis = 0)
# lowerbound included, upperbound is excluded
imputer = imputer.fit(X[:, 1:3])
# tranform method replaces the missing data
X[:, 1:3] = imputer.tranform(X[:, 1:3])
```

**In R**

```r 
# ifelse is like a ternary
# is.na is to check if value is missing or not
dataset$Age = ifelse(is.na(dataset$Age), 
						ave(dataset$Age, FUN = function(x) mean(x, na.rm = TRUE)),
						dataset$Age)

dataset$Salary = ifelse(is.na(dataset$Salary), 
						ave(dataset$Salary, FUN = function(x) mean(x, na.rm = TRUE)),
						dataset$Salary)
```

### Catagorical Variables 

What happens when we have strings instead of numbers for defining data? We must convert them to numbers. Example, we have country strings and a bool column in the data given.

```python 
# encoding catagorical data
from sklearn.preprocessing import LabelEncoder
labelencoder_X = LabelEncoder()
# put in index for country column
X[:, 0] = labelencoder_X.fit_transform(X[:, 0])
```

However, the problem is that since the encodings are of int values, we could actually have the computer consider that the higher integer is of greater importance where it is not.

Instead, what we will do is essentially set up three columns that work like an `adjacency list`.

`1` where the country is correlated to the row, `0` otherwise.

```python 
# encoding catagorical data
from sklearn.preprocessing import LabelEncoder, OneHotEncoder
labelencoder_X = LabelEncoder()
# put in index for country column
X[:, 0] = labelencoder_X.fit_transform(X[:, 0])
onehotencoder = OneHotEncoder(catergorical_features = [0])
# ensure that X is transformed
X = onehotencoder.fit_transform(X).toarray()
```

However, we will need to understand which variable we know are which.

Let's look at the encoding for the `dependent` variable, where we only need the LabelEncoder.

```python
# ...
labelencoder_y = LabelEncoder()
y = labelencoder_y.fit_transform(y)
```

In the case of the boolean, we basically want to numbers to be encoded to 0 and 1.

```r 

```
