# Random Forest Regression

## Intuition

Random forest is a version of ensemble learning.

It's when you take the same algorithm multiple times and create something more powerful.

**Steps**

1. Pick at random K data points from the Training Set.
2. Build the Decision Tree associated to these K data points.
3. Choose the number Ntree of trees you want to build and repeat steps 1 and 2.
4. For a new data point, make each one of your Ntree trees predict the value of `Y` for the data point in question, and assign the new data point the average across all the predicted `Y` values.

Doing this allows you to improve the accuracy of your prediction.

**Example**

How many lollies in a jar? Imagine taking notes of every guess - getting around 1000 and then beginning to average them out or take the median. Statistically speaking, you have a highly likelihood of being closer to the truth.

Once you hit the middle of the normal distribution, you are more likely to be on the money for the guess.

## PYTHON

This is the last regression model. If you understand decision tree regression, you'll understand random forest.

From decision tree, we know that we will need the visualisation using the non-continuous result.

For the regressor, we use RandomForestRegressor library.

```python
# Prediciting the Random Forest results
# Create the Regressor
from sklearn.ensemble import RandomForestRegressor
regressor = RandomForestRegressor(random_state=0)
regressor.fit(X, y)
```
