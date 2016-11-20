# Python Intro to Data Science

***

## Numpy

Once we know about lists, how do we analyse data in R?

We can instead use a Numpy array - which is both easy and fast!

```
>>> import numpy as np
>>> height = [181.5,182.4,183,165.4]
>>> np_height = np.array(height)
>>> np_height
array([ 181.5,  182.4,  183. ,  165.4])
>>> np_height ** 2
array([ 32942.25,  33269.76,  33489.  ,  27357.16])

>>> np_height > 170
array([ True,  True,  True, False], dtype=bool)

>>> np_height[np_height < 170]
array([ 165.4])
```

Numpy for lists that have more than one data type however should be noted that it will convert the list to strings.

Numpy arrays are just another Python type that comes with their own methods.

```
# Create list baseball 
baseball = [180, 215, 210, 210, 188, 176, 209, 200]

# Import the numpy package as np
import numpy as np

# Create a Numpy array from baseball: np_baseball
np_baseball = np.array(baseball)

# Print out type of np_baseball
print(type(np_baseball))

<script.py> output:
    [180 215 210 210 188 176 209 200]

<script.py> output:
    <class 'numpy.ndarray'>
```

```
# height is available as a regular list

# Import numpy
import numpy as np

# Create a Numpy array from height: np_height
np_height = np.array(height)

# Print out np_height
print(np_height)

# Convert np_height to m: np_height_m
np_height_m = np_height * 0.0254

# Print np_height_m
print(np_height_m)

<script.py> output:
    [74 74 72 ..., 75 75 73]
    [ 1.8796  1.8796  1.8288 ...,  1.905   1.905   1.8542]

# height and weight are available as a regular lists

# Import numpy
import numpy as np

# Create array from height with correct units: np_height_m
np_height_m = np.array(height) * 0.0254

# Create array from weight with correct units: np_weight_kg 
np_weight_kg = np.array(weight) * 0.453592

# Calculate the BMI: bmi
bmi = np_weight_kg / np_height_m**2

# Print out bmi
print(bmi)

<script.py> output:
    [ 23.11037639  27.60406069  28.48080465 ...,  25.62295933  23.74810865
      25.72686361]
```

```
# height and weight are available as a regular lists

# Import numpy
import numpy as np

# Calculate the BMI: bmi
np_height_m = np.array(height) * 0.0254
np_weight_kg = np.array(weight) * 0.453592
bmi = np_weight_kg / np_height_m ** 2

# Create the light array
light = bmi < 21

# Print out light
print(light)

# Print out BMIs of all baseball players whose BMI is below 21
print(bmi[light])

<script.py> output:
    [False False False ..., False False False]
    [ 20.54255679  20.54255679  20.69282047  20.69282047  20.34343189
      20.34343189  20.69282047  20.15883472  19.4984471   20.69282047
      20.9205219 ]
```

Printing out Array Values

```
# height and weight are available as a regular lists

# Import numpy
import numpy as np

# Store weight and height lists as numpy arrays
np_weight = np.array(weight)
np_height = np.array(height)

# Print out the weight at index 50
print(weight[50])

# Print out sub-array of np_height: index 100 up to and including index 110
print(np_height[100:111])

<script.py> output:
    200
    [73 74 72 73 69 72 73 75 75 73 72]
```

### ---- 2D Numpy Arrays

```
>>> array_2d = np.array([[1,2,3,4,5],[6,7,8,9,10]])
>>> array_2d
array([[ 1,  2,  3,  4,  5],
       [ 6,  7,  8,  9, 10]])
>>> array_2d[1][3]
9
>>> array_2d[1][:]
array([ 6,  7,  8,  9, 10])
>>> array_2d[1]
array([ 6,  7,  8,  9, 10])
>>> array_2d[1:]
array([[ 6,  7,  8,  9, 10]])
>>> array_2d[1:2]
array([[ 6,  7,  8,  9, 10]])
>>> array_2d[0:1]
array([[1, 2, 3, 4, 5]])
>>> array_2d[0:]
array([[ 1,  2,  3,  4,  5],
       [ 6,  7,  8,  9, 10]])
>>> array_2d[0:2]
array([[ 1,  2,  3,  4,  5],
       [ 6,  7,  8,  9, 10]])
```

```
# Create baseball, a list of lists
baseball = [[180, 78.4],
            [215, 102.7],
            [210, 98.5],
            [188, 75.2]]

# Import numpy
import numpy as np

# Create a 2D Numpy array from baseball: np_baseball
np_baseball = np.array(baseball)

# Print out the type of np_baseball
print(type(np_baseball))

# Print out the shape of np_baseball
print(np_baseball.shape)

<script.py> output:
    <class 'numpy.ndarray'>
    (4, 2)

# baseball is available as a regular list of lists

# Import numpy package
import numpy as np

# Create a 2D Numpy array from baseball: np_baseball
np_baseball = np.array(baseball)

# Print out the shape of np_baseball
print(np_baseball.shape)

<script.py> output:
    (1015, 2)
```

```
# Import numpy package
import numpy as np

# Create np_baseball (2 cols)
np_baseball = np.array(baseball)

# Print out the 50th row of np_baseball
print(np_baseball[49,:])

# Select the entire second column of np_baseball: np_weight
np_weight = np_baseball[:,1]

# Print out height of 124th player
print(np_baseball[123,0])

<script.py> output:
    [ 70 195]
    [ 73 194]

<script.py> output:
    [ 70 195]
    75
```

```
# baseball is available as a regular list of lists
# update is available as 2D Numpy array

# Import numpy package
import numpy as np

# Create np_baseball (3 cols)
np_baseball = np.array(baseball)

# Print out addition of np_baseball and update
print(np_baseball + update)

# Create Numpy array: conversion
conversion = [0.0254, 0.453592, 1]

# Print out product of np_baseball and conversion
print(np_baseball*conversion)

<script.py> output:
    [[  75.2303559   168.83775102   23.99      ]
     [  75.02614252  231.09732309   35.69      ]
     [  73.1544228   215.08167641   31.78      ]
     ..., 
     [  76.09349925  209.23890778   26.19      ]
     [  75.82285669  172.21799965   32.01      ]
     [  73.99484223  203.14402711   28.92      ]]
    [[  1.8796   81.64656  22.99   ]
     [  1.8796   97.52228  34.69   ]
     [  1.8288   95.25432  30.78   ]
     ..., 
     [  1.905    92.98636  25.19   ]
     [  1.905    86.18248  31.01   ]
     [  1.8542   88.45044  27.92   ]]
```






