# Classification: Logistic Regression

## Logistic Regression Intuition

This section can be quite difficult - there will be some **math**.

We know about `linear regression`, `multiple linear regression` etc. (DV on y, IV on x).

What happens if we classify things along a graph? Eg. 0 and 1 on the y axis and age on the x axis. This one is very black and white, but at the same time we can intuitive see some correlation.

In the example given above, we wouldn't use a linear model (as you could imagine). How about instead, you were able throw in probabilies between 0 and 1. The could be a probability between the x intercept and the y-intecept at x[hat]. You could interpret the above and below 100% and 0% respectively. This would be a VERY basic but sensicle attempt to describe the model.

### The scientific approach

If we take the linear `y = b[0] + b[1]*x` and take that into the sigmoid function `p = 1 / (1 + pow(e, -y)` and then we through that into `ln(p/(1-p)) = b[0] + b[1]*x` then we can get the y. Therefore the last equation is the one for logistical regression.

```
# MAIN FORMULA
ln(p/(1-p)) = b[0] + b[1]*x
```

Based on the above formula and plugging in the example data, we will get the best fitting line.

If we now take any particular ages along the x axis of `20, 30, 40, 50` etc, we can then find y[hat] to get the predicted value that it will be a `1` or `0` - the higher the probability, the higher the chance of a `1`.
