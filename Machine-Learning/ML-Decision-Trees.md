# Decision Trees

## Intuition

CART: Classification and Regression Trees

We speak about both types, but for now - focus on regression trees.

Regression trees are a bit more complex than classification trees.

Imagine a scatter plot with two IV and we are predicting an DV y (which you wouldn't be able to see on the chart). Essentially the DV would sit on the z axis.

Once you run the regression decision tree algorithm, the scatter plot will be split up into segments.

For example, x1 might be split at 20. Another split may happen for x2 at 170, 200 etc.

The question, are the splits adding value to way we want to group our points?

Each split itself is known as a leaf.

The algorithm can handle mathematical issues and we can focus on the practical element of the algorithm.
