# Title

## Table of Contents

<a href="#intro">title</a>
---- <a href="#subsection">title</a>

<div id="intro"></div>

***

## Intro to Python Collections

Appending and adding to lists.

```python
### a_list=[1,2,3]
### a_list
a_list.append([4,5]) # [1,2,3,[4,5]]
our_list = list(range(10))
### our_list
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
### our_list + [10,11,12]
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
### our_list
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
### our_list=our_list+[10,11,12]
### our_list
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
```

For splitting strings themselves we can use `str.split(str="", num=string.count(str))`

<div id="collections"></div>

### ---- Extending Collections

 Normally cleaner for larger lists than the `+` symbol.

 ```python
>>> our_list
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
>>> our_list.extend(range(13, 20))
>>> our_list
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
```

 How do add new items inside the list?

 ```python
>>> alpha= list('acdf')
>>> alpha
['a', 'c', 'd', 'f']
>>> alpha.insert(1,'b')
>>> alpha
['a', 'b', 'c', 'd', 'f']
>>> alpha.insert(4,'e')
>>> alpha
['a', 'b', 'c', 'd', 'e', 'f']
```

<div id="shoppinglist"></div>

### ---- Shopping List

```
# note - you should use enumerate once you get there
>>> def show_help():
     print("\nDoing a print_")

>>> def show_list():
     count=1
     for item in shopping_list:
             print("{}: {}".format(count, item))
             count+=1
```

Other helpful use cases...

```
while True:
	#do stuff
	new_stuff = input("> ")

	if new_stuff == "DONE":
		print('Done')
		break
	elif
		#do other stuff
		break
	else
		... 
```

<div id="3"></div>

### ---- Removing Items from a List

```
a_list=list('abzde')
a_list.index('z')
del a_list[2]

a_string = "Hello"
# this will delete the string - although the del can't be used to delete within the string
# strings themselves are immutable
del a_string

# remove for the list
my_list = [1,2,3,1]
# remove ONLY removes the first instance from the list
my_list.remove(1)
my_list
# [2,3,1]
```

<div id="4"></div>

### ---- Removing vowels from a list of words and capitalising them

```
names = ["Dennis", "Billy", "Trojan", "Horse"]
vowels = list('aeiou')
output = []

for name in names:
	name_list = list(name.lower())
	
	for vowel in vowels:
		while True:
			try:
				state_list.remove(vowel)
			except:
				break
	output.append(''.join(name_list).capitalize())

print(output)
```

<div id="5"></div>

### ---- Pop an item from the list

pop() removes an item by index but gives us the item.

```
names = ["Dennis", "Billy", "Trojan", "Horse"]
first = names.pop() // gives the first name
another = names.pop(2) // gives index 3
```

```
// Quiz Challenge

// 1. Move the '1' to the front of the list

the_list = ["a", 2, 3, 1, False, [1, 2, 3]]

# Your code goes below here
the_list.insert(0, the_list.pop(3))
```

<div id="slices"></div>

***

## Slices

Slices mean we can get back more than one item from a list. We call this `slicing`.

Something important to not is the useability of have the [:] call for a copy of the list!

```
my_string="Hello there!"
my_string[0:5]

my_list=list(range(1,6))
my_list[0:2] // same as my_list[:2]
my_list[2:len(my_list)]

my_list[1:]
my_list[:] // gets back a copy of the list

my_new_list = [4,2,1,3,5]
my_new_list.sort()
my_new_list
```

<div id="6"></div>

### ---- Slicing with a Step

How can we slice that move backward or that skip items?

```
my_list=list(range(20))

# let's get the even numbers
my_list[::2]
"Testing"[::2]

# reversing
"Slap"[::-1]

# getting the middle slice - must swap positions!
my_list[8:2:-1]

# negative indexes will also give you the positions from the end
my_list[-1]

# example of grabbing the first four iterables through a Python function
def first_4(iter):
    return iter[:4]
```

<div id="7"></div>

### ---- Deleting or Replacing Slices

We can delete and replace with lists.

```
my_list = [1,2, 'a', 'b', 5,6,'f','g']

# what if I just want letters?
my_list[4:7] = ['e','f']
```

__Code Challenge__

```
def sillycase(c):
    return c[:round(len(c) / 2)].lower() + c[round(len(c) / 2):].upper()
```

<div id="dict1"></div>

***

## Dictionaries

Key-Value organisation. They themselves do not have an order.

```
my_dict = {'name': 'Dennis', 'job': 'Software Engineer'}

# to access it, you need to use the key name
my_dict['name']
```

Dictionaries can contain anything - even your own custom classes.

```
named_dict = { 'name' : { 'first' : 'Dennis', 'last': 'OKeeffe'} }
named_dict['name']['first']

# tuple game dict
game_dict = {(1,2) : True}
game_dict[(1,2)]
```

Challenge: Check if a dict key is in the list 

```
def members(dict, keys):
    counter = 0
    for key in dict:
        if key in keys:
            counter = counter + 1
    return counter
```

<div id="dict2"></div>

### ---- Managing Keys

We can `del` keys etc similar to the way we do it for keys.

```
>>> my_dict['test'] = 'value'
>>> my_dict
{'test': 'value', 'job': 'Software Engineer', 'name': 'Dennis'}
>>> del my_dict['test']
>>> my_dict
{'job': 'Software Engineer', 'name': 'Dennis'}

# we can use update for multiple keys etc
>>> my_dict.update({'job': 'Developer', 'age': 24, 'state': 'New South Wales'})
>>> my_dict
{'job': 'Developer', 'name': 'Dennis', 'age': 24, 'state': 'New South Wales'}
```

Challenge: Create a function named word_count() that takes a string. Return a dictionary with each word in the string as the key and the number of times it appears as the value.

```
def word_count(sentence):
    new_dict = {}
    word_list = sentence.split()
    count = 0

    for original_word in word_list:
        if original_word not in new_dict:
            count = 0
            for comparison_word in word_list:
                if original_word == comparison_word:
                    count += 1
                    new_dict.update({original_word: count})
    return new_dict
```

<div id="dict3"></div>

### ---- Unpacking Dictionaries

You can give placeholders a name and use dictionaries to make it a little easier.

```
>>> my_string = "Hi my name is {name} and I live in {state}"
>>> my_string
'Hi my name is {name} and I live in {state}'
>>> my_string.format('Dennis', 'Sydney')
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
KeyError: 'name'
>>> my_string.format('name'='Dennis', state='Sydney')
  File "<stdin>", line 1
SyntaxError: keyword can't be an expression
>>> my_string.format(name='Dennis', state='Sydney')
'Hi my name is Dennis and I live in Sydney'

# how do we make this programmatic?
>>> test_dict = {'name':'Dennis', 'state':'Sydney'}
>>> my_string.format(**test_dict)
'Hi my name is Dennis and I live in Sydney'
```

Code Challenge: Create a function named string_factory that accepts a list of dictionaries and a string. Return a new list built by using .format() on the string, filled in by each of the dictionaries in the list.

```
dicts = [
    {'name': 'Michelangelo',
     'food': 'PIZZA'},
    {'name': 'Garfield',
     'food': 'lasanga'},
    {'name': 'Walter',
     'food': 'pancakes'},
    {'name': 'Galactus',
     'food': 'worlds'}
]

string = "Hi, I'm {name} and I love to eat {food}!"

def string_factory(list_of_dict, str):
    new_list = []
    for ind_list in list_of_dict:
        new_list.append(str.format(**ind_list))
    return new_list
```

<div id="dict4"></div>

### ---- Dictionary Iteration

Again, Dictionaries in Python do not have a set order, but we can still iterate over them.

```
>>> my_dict
{'job': 'Developer', 'name': 'Dennis', 'age': 24, 'state': 'New South Wales'}
>>> for thing in my_dict:
...     print(thing)
...
job
name
age
state

>>> for key in my_dict:
...     print(my_dict[key])
...
Developer
Dennis
24
New South Wales

>>> for value in my_dict.values():
...     print(value)
...
Developer
Dennis
24
New South Wales
```

Create a function named most-classes that takes a dictionary of teachers. Each key is a teacher's name and their value is a list of classes they've taught. most-classes should return the teacher with the most classes.

Next, create a function named num_teachers that takes the same dictionary of teachers and classes. Return the total number of teachers.

Now, create a function named stats that takes the teacher dictionary. Return a list of lists in the format [<teacher name>, <number of classes>]. For example, one item in the list would be ['Dave McFarland', 1].

Great work! Finally, write a function named courses that takes the teachers dictionary. It should return a single list of all of the courses offered by all of the teachers.

```
def most_classes(teachers):
    highest_value = 0
    teacher_name = ""
    for teacher in teachers:
        if len(teachers[teacher]) > highest_value:
            highest_value = len(teachers[teacher])
            teacher_name = teacher
    return teacher_name

def num_teachers(teachers):
    return len(teachers)

def stats(teachers):
    return_list = []
    for teacher in teachers:
        return_list.append([teacher, len(teachers[teacher])])
    return return_list

def courses(teachers):
    single_courses = []
    for courses in teachers.values():
        for course in courses:
            if course not in single_courses:
                single_courses.append(course)
    return single_courses
```