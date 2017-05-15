# Random Forest Regression

## Intuition

Random forest is a version of ensemble learning.

It's when you take the same algorithm multiple times and create something more powerful.

**Steps**

1. Pick at random K data points from the Training Set.
2. Build the Decision Tree associated to these K data points.
3. Choose the number Ntree of trees you want to build and repeat steps 1 and 2.
4. For a new data point, make each one of your Ntree trees predict the value of `Y` for the data point in question, and assign the new data point the average across all the predicted `Y` values.

