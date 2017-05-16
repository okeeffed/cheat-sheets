# Regression Model Performance

## R-Squared Intuition

Interesting parameter and most people use it without understanding the underlying principles.

We spoke about the `simple linear regression` model being the result of the `ordinary least squares` method. This is also known as `sum of squares residuals` and is given as `SS[res]`.

If we instead took `SUM(y[i] - y[avg])^2`, we get the `total sum of squares SS[tot]`. To get our regression, we get `R^2 = 1 - (SS[res]/SS[tot])`.

As you minimize the SS[res], it becomes smaller, and as we get  `1 - (SS[res]/SS[tot])` we actually start to get closer to 1. The closer we get to 1, the better. Can R^2 be negative? Yes. It can if the SS[res] fits the line worse. In that case it would be better to use the average than the model - although it would be hard to do!

## Adjusted R-Squared Intuition

This is the fun part!
