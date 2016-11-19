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