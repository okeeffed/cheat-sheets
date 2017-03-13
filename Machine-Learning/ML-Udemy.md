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
```