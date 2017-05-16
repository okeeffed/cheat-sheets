# Regression Model Performance

## R-Squared Intuition

Interesting parameter and most people use it without understanding the underlying principles.

We spoke about the `simple linear regression` model being the result of the `ordinary least squares` method. This is also known as `sum of squares residuals` and is given as `SS[res]`.

If we instead took `SUM(y[i] - y[avg])^2`, we get the `total sum of squares SS[tot]`. To get our regression, we get `R^2 = 1 - (SS[res]/SS[tot])`.

As you minimize the SS[res], it becomes smaller, and as we get  `1 - (SS[res]/SS[tot])` we actually start to get closer to 1. The closer we get to 1, the better. Can R^2 be negative? Yes. It can if the SS[res] fits the line worse. In that case it would be better to use the average than the model - although it would be hard to do!

## Adjusted R-Squared Intuition

This is the fun part!

Here we have our `simple linear regression` regression from before. We, the same concepts apply for multiple linear regression.

R^2 - goodness of fit. The closer the one, the better - BUT the problem is when we start adding more DVs into the model. What we can look at is whether the R^2 getting better or worse, but because of SS[res] the minimum will never decrease. **THIS IS IMPORTANT**.

Once you add a new variable, it will affect what the variable looks like. Either the new variable will help minimize the SS[res]. If you cannot decress SS[res], the new variable would be zero (unlikely).

Therefore, `R^2` will never decrease when you add in more variables. That being said, if the DV has zero correlation or causation with the IV, there randomly will be a slight correlation - therefore R^2 might slightly increase even though the variable is not helping the model.

This is where `adjusted R^2` comes in.

```
Adj R^2 = 1 - (1-R^2)*((n - 1)/(n - p - 1))
p - number of regressors
n - sample size
```

This formula will penalise you for adding in IVs that have no correlation.

## Evaluating Regression Models Performance

Reflecting back on the `Backward Elimination` process that we used, we actually came to a feeling that we shouldn't have excluded the last value of `Marketing Spend`.

