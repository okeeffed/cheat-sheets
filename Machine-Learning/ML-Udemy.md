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

**In R**

For R, we just need to factor the way we want to.

Since we have the factor function, the number encoding themselves don't need to be setup in the same way that it was for Python.

```r
# Encoding catergorical data
# remember c() is a Vector!
dataset$Country = factor(dataset$Country,
							levels = c('France', 'Spain', 'Germany'),
							labels = c(1,2,3))

dataset$Purchased = factor(dataset$Purchased,
							levels = c('No', 'Yes')
							labels = c(0, 1))
```

### Splitting the data into a Training Set and Test Set

With any model, we should split the data into the training set and the test set.

We need to build our models on the set and then test it on a new set against which we used certain data for that model.

The performance should not differ too much.

For this section, we use `from sklearn.model_selection import train_test_split` to do the training, testing and splitting.

`train_test_split(*arrays, test_size, train_size)`

```python
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, train_size=0.8, random_state=0)

# use below if using python-shell in node
res = X_train.tolist()
send(res, 0)
res = X_test.tolist()
send(res, 0)
```

### Feature Scaling

With two variables, we can find the Euclidean Distance between point one and point two as `sqroot((x[1] - x[0])^2 + (y[1] - y[0])^2)`

However, with two very contrasting sizes of variables, the difference may be so ridiculous due to the square difference. Basically, the smaller, less dominant one may not exist.

```python
#
# FEATURE SCALING
#

from sklearn.preprocessing import StandardScaler

sc_X = StandardScaler()
X_train = sc_X.fit_transform(X_train)
X_test = sc_X.transform(X_test)
```

How about the Dummy Variables? It won't break the Model if you don't scale it, but you might lose how we can intepret which country is which.

Even when no Euclidean distance is required, Feature scaling allows the execution to be much faster.

### Templating Data Preprocessing

```python
# Importing the libraries
import numpy as mp
import mapplotlib.pypot as plt
import pandas as pd

# Importing the dataset
dataset = pd.read_csv('Data.csv')
x = dataset.iloc[:, :-1].values
y = dataset.iloc[:, 3].values

# Taking care of missing data
# Not compulsary - only if data is missing
from sklearn.preprocessing import Imputer
imputer = Imputer(missing_values = 'NaN', strategy = 'mean', axis = 0)
imputer = Imputer.fit(X[: 1:3])
X[: 1:3] = imputer.transform(X[:, 1:3])

# Encoding categorical data
# Not compulsary - only if we need to convert the data
from sklearn.preprocessing import LabelEncoder, OneHotEncoder

# Encode Strings
# Think example of countries to [0|1] matrix
# Encoding the Independent Variable
labelencoder_X = LabelEncoder()
# put in index for country column
X[:, 0] = labelencoder_X.fit_transform(X[:, 0])
onehotencoder = OneHotEncoder(categorical_features = [0])
# ensure that X is transformed
# details here http://scikit-learn.org/stable/modules/generated/sklearn.preprocessing.OneHotEncoder.html
X = onehotencoder.fit_transform(X).toarray()
# Encoding the Dependent Variable
labelencoder_y = LabelEncoder()
y = labelencoder_y.fit_transform(y)

#
# SPLITTING THE SET INTO THE TRAINING AND TEST SET
#
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size = 0.2)

#
# FEATURE SCALING
#

from sklearn.preprocessing import StandardScaler

sc_X = StandardScaler()
X_train = sc_X.fit_transform(X_train)
X_test = sc_X.transform(X_test)
```

## Part 2: Regression

Regression models (both linear and non-linear) are used for predicting a real value, like salary for example. If your independent variable is time, then you are forecasting future values, otherwise your model is predicting present but unknown values. Regression technique vary from Linear Regression to SVR and Random Forests Regression.

In this part, you will understand and learn how to implement the following Machine Learning Regression models:

Simple Linear Regression
Multiple Linear Regression
Polynomial Regression
Support Vector for Regression (SVR)
Decision Tree Classification
Random Forest Classification

## 2.1: Simple Linear Regression

Looking at years of experience vs salary.

The issue - what is the correlation between `Years of experience` and `Salary`.

Ask the questions, what are the values that we get from this model? We could have a business go back to this model and apply it to help get an idea of salaries you are willing to give out.

### Intuition

Simple linear regression is basically `y = b[0] + b[1]*x[1]` (even y = mx + c)

```
# Example - How does salary change with years of experience?
y - dependent variable (DV) eg. (y = salary change)
x - independent variable(IV) eg. years of experience
b[1] - coefficient of IV (unit changes in x[1] how it affects y)
b[0] - constant
```

Regression - look at the hard facts.

The simple linear regression will basically be a best fit for the data.

In the case of `b[0]`, that will be the `y-intercept`. `b[1]` being the point at y.

On the `XY Graph` the datapoints will all end up being the independent variables. If we draw lines from these points to the model linear regression line, we can see where that person should be sitting. If `y[i]` is the data point, `y[hat][i]` is the point is modelled that is should be.

To get the best fitting line, we just `sum(y - y[hat])^2` to get the `min`.

### IN PYTHON

In this example, `YourExperience` is the independent value and `Salary` is the dependent value.

```python
# Importing the libraries
import sys, json
import numpy as np
import matplotlib.pyplot as plt
import pandas as pd

def send(arg, type):
	if type == 1:
		print json.dumps(json.loads(arg))
	elif type == 2:
		print arg
	else:
		print json.dumps(arg)

# Importing the dataset
dataset = pd.read_csv('data/Salary_Data.csv')
X = dataset.iloc[:, :-1].values
y = dataset.iloc[:, 1].values
send(X.tolist(), 0);
send(y.tolist(), 0);

# Splitting the dataset into the Training set and Test set
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size = 0.2, random_state = 0)
```

If we run the above, we may get an error from `sklearn.preprocessing` that is that 1d arrays need to be reshaped.

In simple linear regression, we also don't need to worry about `Feature Scaling`.

**Fitting Simple Linear Regression to the Training Set**

- `fit` the `regressor`

```python
# Add to the above code
# Fitting simple ;inear Regression to the Training Set
from sklearn.linear_model import LinearRegression
regressor = LinearRegression()
regressor.fit(X_train, y_train)
send(str(regressor), 0);
```

Now that we have the `regressor`, we can start making basic predictions! With the Linear Regression object, we can now do this using the `predict` method.

```python
# Add to code above

# Prediciting the test set results
y_pred = regressor.predict(X_test)
# send(X_test.tolist(), 0) # see test set years for IV
# send(y_test.tolist(), 0) # check what the results were
# send(y_pred.tolist(), 0) # check the predictions
```

**Visualizing the Model**

This will be training set to train a line and now we can see how it goes against first - the training set, and then secondly, the test set!

Note the blue line being the prediction while the red dots are what give the actual plot points.

```python
# Visualizing the Training Set results
plt.scatter(X_train, y_train, color = 'red')
plt.plot(X_train, regressor.predict(X_train), color = 'blue')
plt.title('Salary vs Experience (Training Set)')
plt.xlabel('Years of Experience')
plt.ylabel('Salary')
plt.show()
# plt.savefig('plot.png')
```

As for checking the test set:

```python
# Visualizing the Test Set results
plt.scatter(X_test, y_test, color = 'red')
# We do not change this since the regressor is already trained
# with the training set
plt.plot(X_train, regressor.predict(X_train), color = 'blue')
plt.title('Salary vs Experience (Test Set)')
plt.xlabel('Years of Experience')
plt.ylabel('Salary')
plt.show()
# plt.savegit('plot.png')
```

## 2.2 Multiple Linear Regression

The challenge: you have 50 companies that all have extracts from `Profit` and the independent variables that it depends on `R&D Spend`, `Administration`, `Markerting Spend`.

### Intuition

Multiple where there are multiple IVs of causation.

```
# Simple Linear Regression
y = b[0] + b[1]*x[1]

# Multiple Linear Regression
y = b[0] + b[1]*x[1] + b[2]*x[2] + ... + b[n]*x[n]

# Multiple Linear Regression after replacing categorical data
y = b[0] + b[1]*x[1] + b[2]*x[2] + ... + b[n]*x[n] + b[n+1]*D[1] + ... + b[n+m]*D[m]
```

**The Assumptions of Linear Regression**

1. Linearity
2. Homoscedasticity
3. Multivariate normality
4. Independence of errors
5. Lack of mulicollinearity

**Dummy Variables**

With the data that has categorical data, we actually use the `LabelEncoder` and `OneHotEncoder` to allow the expansion of the column into the total different values of of `state` and make a binary matrix for those columns and rows.

**Note:** There is a dummy variable trap we will talk about later.

We can also think this to be biased, however by default we will have the correct coefficient for the category that will help alter the state to be for the correct category.

You cannot have the default b[0] + all dummy varibles. You should always omit one dummy varible.

### How to build MLR models (step-by-step)

Back with one IV and one DV, life was great, but now that we have many columns we need to decide what we can use as useful predictors.

**Why throw out columns and use everything?**

1. Garbage in -> Garbage out. If you throw everything in, you may also add in garbage.
2. Shows an understanding of variables

**5 Methods of Building Models**

1. All-in
2. Backward Elimination
3. Forward Selection
4. Bidirectional Elimination
5. Score Comparison

`2, 3 and 4` are sometimes referred to as `Stepwise Regression` or sometimes just `4`.

**All in**

Throw in `everything`. When to do it?
- You have prior knowledge that these are the true predictors
- You have to: maybe a framework where you have to use them
- Preparing for `Backward Elimination` type of regression

**Backward Elimination**

1. Select a significance level to stay in the model (eg SL = 0.05)
2. Fit the full model with all possible predictors
3. Consider the predictor with the `highest P-value` - if `P > SL`, go to step 4, else fin
