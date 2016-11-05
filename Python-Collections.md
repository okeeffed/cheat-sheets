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

<div id="newSection"></div>

### ---- Slicing with a Step






















