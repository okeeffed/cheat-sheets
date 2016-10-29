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

