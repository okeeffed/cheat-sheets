# Classification: Logistic Regression

<!-- TOC -->

*   [Classification: Logistic Regression](#classification-logistic-regression)
    *   [Logistic Regression Intuition](#logistic-regression-intuition)
        *   [The scientific approach](#the-scientific-approach)
    *   [Implementation in Python](#implementation-in-python)
        *   [Fitting the logistic regression model to the Training Set](#fitting-the-logistic-regression-model-to-the-training-set)
        *   [Checking the fit predictions using the Confusion Matrix](#checking-the-fit-predictions-using-the-confusion-matrix)
        *   [Visualising the predictive power using a graph](#visualising-the-predictive-power-using-a-graph)
        *   [How do we interpret the graph?](#how-do-we-interpret-the-graph)
        *   [What is the point of the classifiers?](#what-is-the-point-of-the-classifiers)
        *   [Checking the results when applied to the Test Set](#checking-the-results-when-applied-to-the-test-set)

<!-- /TOC -->

## Logistic Regression Intuition

This section can be quite difficult - there will be some **math**.

We know about `linear regression`, `multiple linear regression` etc. (DV on y, IV on x).

What happens if we classify things along a graph? Eg. 0 and 1 on the y axis and age on the x axis. This one is very black and white, but at the same time we can intuitive see some correlation.

In the example given above, we wouldn't use a linear model (as you could imagine). How about instead, you were able throw in probabilies between 0 and 1. The could be a probability between the x intercept and the y-intecept at x[hat]. You could interpret the above and below 100% and 0% respectively. This would be a VERY basic but sensicle attempt to describe the model.

### The scientific approach

If we take the linear `y = b[0] + b[1]*x` and take that into the sigmoid function `p = 1 / (1 + pow(e, -y))` and then we through that into `ln(p/(1-p)) = b[0] + b[1]*x` then we can get the y. Therefore the last equation is the one for logistical regression.

```
# MAIN FORMULA
ln(p/(1-p)) = b[0] + b[1]*x
```

Based on the above formula and plugging in the example data, we will get the best fitting line.

If we now take any particular ages along the x axis of `20, 30, 40, 50` etc, we can then find y[hat] to get the predicted value that it will be a `1` or `0` - the higher the probability, the higher the chance of a `1`. Any probability that is less than 0.5 is `projected down` whereas anything else is `projected up`.

After applying to model, we can start drawing conclusions.

## Implementation in Python

Using our standard setup, we want to predict whether or not we can get a correlation between the `purchase` of something using their `age` and `salary`.

For accurate predictions, we do use feature scaling and we will also create a classification test and training set.

```python
# Data Preprocessing Template

# Importing the libraries
import sys, json
import numpy as np
import matplotlib.pyplot as plt
import pandas as pd

# send() for Node.js Python Shell lib
def send(arg, type = 0):
	if type == 1:
		print json.dumps(json.loads(arg))
	elif type == 2:
		print arg
	else:
		print json.dumps(arg)

# Importing the dataset
dataset = pd.read_csv('data/Social_Network_Ads.csv')
# We jut want the estimate of purchase using the Age and Estimated Salary
X = dataset.iloc[:, 2:4].values
y = dataset.iloc[:, 4].values

send(X.tolist());
send(y.tolist());

# Splitting the dataset into the Training set and Test set
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size = 0.25, random_state = 0)

# Feature Scaling
from sklearn.preprocessing import StandardScaler
# we use this here for accurate predicition
sc_X = StandardScaler()
X_train = sc_X.fit_transform(X_train)
X_test = sc_X.fit_transform(X_test)

send(X_train.tolist());
```

### Fitting the logistic regression model to the Training Set

```python
# Fitting Logistic Regression to the Training Set
# Create the Regressor
from sklearn.linear_model import LogisticRegression
classifier = LogisticRegression(random_state=0)
classifier.fit(X_train, y_train)
```

In order to make a prediction on the X_test:

```python
# y_pred will be the vector of predictions
y_pred = classifier.predict(X_test)
send(y_pred.tolist())
```

### Checking the fit predictions using the Confusion Matrix

We do this by making a `Confusion Matrix`.

```python
# Create the confusion matrix
from sklearn.metrics import confusion_matrix
cm = confusion_matrix(y_test, y_pred);
send("\nConfusion Matrix")
send(cm.tolist())
```

### Visualising the predictive power using a graph

There is a lot of code required to visualise this:

```python
# Visualising the Training Set results
from matplotlib.colors import ListedColormap
X_set, y_set = X_train, y_train
X1, X2 = np.meshgrid(np.arange(start = X_set[:, 0].min() - 1, stop = X_set[:, 0].max() + 1, step = 0.01),
					np.arange(start = X_set[:, 1].min() - 1, stop = X_set[:, 1].max() + 1, step = 0.01))
plt.contourf(X1, X2, classifier.predict(np.array([X1.ravel(), X2.ravel()]).T).reshape(X1.shape),
			alpha = 0.75, cmap = ListedColormap(('red', 'green')))
plt.xlim(X1.min(), X1.max())
plt.ylim(X2.min(), X2.max())
for i, j in enumerate(np.unique(y_set)):
	plt.scatter(X_set[y_set == j, 0], X_set[y_set == j, 1],
			c = ListedColormap(('red', 'green'))(i), label = j)
plt.title('Logistical Regression Training Set')
plt.xlabel('Age')
plt.ylabel('Estimated Salary')
# plt.savefig('logistical-regression.png')
plt.show()
plt.close()
```

### How do we interpret the graph?

The red points are the training set observations for when the IV purchased = 0, and 1 for green.

In our example, red did not buy the SUV, green are those who did.

Given the x,y axis, those with the lower salary who also didn't have red are also those who didn't but the SUV. We can see those with the higher salaries are more likely to have bought the SUV.

Another observation is that the older above the average even with the lower salary were more likely to buy the SUV.

### What is the point of the classifiers?

The goal is to classify the right users into the right categories. We do this by plotting the `prediction regions` - in the case of the graph, it's the red prediction and the green region is where the classifier does by the SUV.

The data point is the result, the region is the estimate.

When we have a linear classifier, the boundary will always be a straight line.

### Checking the results when applied to the Test Set

The results that we can see from this actually come from the same confusion matrix that we saw before.

```python
# Visualising the Test Set results
from matplotlib.colors import ListedColormap
X_set, y_set = X_test, y_test
X1, X2 = np.meshgrid(np.arange(start = X_set[:, 0].min() - 1, stop = X_set[:, 0].max() + 1, step = 0.01),
					np.arange(start = X_set[:, 1].min() - 1, stop = X_set[:, 1].max() + 1, step = 0.01))
plt.contourf(X1, X2, classifier.predict(np.array([X1.ravel(), X2.ravel()]).T).reshape(X1.shape),
			alpha = 0.75, cmap = ListedColormap(('red', 'green')))
plt.xlim(X1.min(), X1.max())
plt.ylim(X2.min(), X2.max())
for i, j in enumerate(np.unique(y_set)):
	plt.scatter(X_set[y_set == j, 0], X_set[y_set == j, 1],
			c = ListedColormap(('red', 'green'))(i), label = j)
plt.title('Logistical Regression Test Set')
plt.xlabel('Age')
plt.ylabel('Estimated Salary')
# plt.savefig('logistical-regression.png')
plt.legend()
plt.show()
plt.close()
```
