# Decision Trees

<!-- TOC -->

*   [Decision Trees](#decision-trees)
    *   [Intuition](#intuition)
    *   [Decision Tree Regression in Python](#decision-tree-regression-in-python)

<!-- /TOC -->

## Intuition

**CART: Classification and Regression Trees**

We speak about both types, but for now - focus on regression trees.

Regression trees are a bit more complex than classification trees.

Imagine a scatter plot with two IV and we are predicting an DV y (which you wouldn't be able to see on the chart). Essentially the DV would sit on the z axis.

Once you run the regression decision tree algorithm, the scatter plot will be split up into segments.

For example, x1 might be split at 20. Another split may happen for x2 at 170, 200 etc.

The question, are the splits adding value to way we want to group our points?

Each split itself is known as a leaf.

The algorithm can handle mathematical issues and we can focus on the practical element of the algorithm.

**Splitting**

If we split `x[1] < 20`, we have two options (y/N). If we then split `x[2] < 170`, we add a child node to `x[1] < 20` that checks y/N. If we then set ``x[2] < 200`.

After having a two child tree, if we set `x[1] < 40` such that `x[1] < 20` is not true and `x[2] < 170` is true, we can then set `x[1] < 40` as the child to `x[2] < 170`.

Once we start this tree, what do we populate into those boxes? Well, we decide how we predict `y` with a new observation added to the plane x[1] and x[2].

Key note: `Adding splits adds information`.

What we do is that for each terminal leaf, we take the average and assign the value that we give to any new element that falls into that leaf.

Now, if we have a new value, we check the decision tree where it falls and then assign the new element the value of where it falls as a prediction.

## Decision Tree Regression in Python

Warning for the decision tree, because we need to consider the entropy and split the result into data points. If we stick to one dimension, how do we have a line that is not horizontal? If the splits are made, they should remain a constant.

Either the intervals are infinite (which they are not), or the model has an issue.

The reason the issue came up, is because of what we have used to create the plot since this is no longer linear.

This is now a non-linear, non-continuous regression model.

What is the best way to view something non-continuous?

```python
# Visualising the Decision Tree results
X_grid = np.arange(min(X), max(X), 0.01)
X_grid = X_grid.reshape(len(X_grid), 1)
plt.scatter(X, y, color = 'red')
plt.plot(X_grid, regressor.predict(X_grid), color = 'blue')
plt.title('Truth or Bluff (Decision Tree Regression)')
plt.xlabel('Position level')
plt.ylabel('Salary')
plt.savefig('decision-tree.png')
plt.show()
```

As for getting the decision tree code to run:

```python
# Prediciting the Decision Tree results
# Create the Regressor
from sklearn.tree import DecisionTreeRegressor
regressor = DecisionTreeRegressor(random_state=0)
regressor.fit(X, y)

y_pred = regressor.predict(6.5)
```

Ensure you have a higher resolution in order to visualize the splits. Given that the example in the tutorial has just 1 DV and 1 IV, it will come out like steps as the only splits will occur on the x axis.

The model itself is not necessarily that interesting in 1D, but over many dimensions it becomes far more interesting.

**What happens when you use a random forest?**

A Random Forest is a team of decision trees. What happens with a team of 10 trees? 50 trees? 500 trees?
