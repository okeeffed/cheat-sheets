# Python - Intermediate Data Science

<!-- TOC -->

*   [Python - Intermediate Data Science](#python---intermediate-data-science)
    *   [PYINT-1: Matplotlib](#pyint-1-matplotlib)
        *   [---- PYINT-1.1: Basic plots](#-----pyint-11-basic-plots)

<!-- /TOC -->

## PYINT-1: Matplotlib

### ---- PYINT-1.1: Basic plots

Using `pyplot`

```python
# import pyplot
import matplotlib.pyplot as plt

year = [1950, 1970, 1990, 2010]
pop = [2.519, 3.692, 5.263, 6.972]

# make a plot
plt.plot(year, pop)

# show a plot
plt.show()
```

How do we create a scatter plot?

```python
# import pyplot
import matplotlib.pyplot as plt

year = [1950, 1970, 1990, 2010]
pop = [2.519, 3.692, 5.263, 6.972]

# make a plot
plt.scatter(year, pop)

# show a plot
plt.show()
```

The basic ingredients of pyplot

```
import matplotlib.pyplot as plt
plt.plot(x,y)
plt.show()
```

You can use certain commands to show a different scale

```
plt.xscale('log')
```
