# Data Structures with Python

## PYDS-12.0: Arrays

- Introduction to Arrays
- Low Level Arrays
- Dynamic Arrays and Amotization
- Array based "mini project"
- Several Array Interview Problems

**Array Sequences**
- List
- Tuple
- String

All of which support indexing.

## PYDS-12.1: Low Level Arrays

- Focus on low level computer theory

**Low-level comp architecture**
- Memory stored in bits, stored in units called bytes
- Stores these bytes in an address
- Just as easy to retrieve or stored in O(1) time
- Arrays can be a contiguous portion of the computers memory
	- eg. String is consecutive
	- each location within the array is a *cell*
	- calcs done by start address + (cellsize * index)

*Referential Arrays*
- 100 student id names, each needs to have the same number of bytes.
	- We can use an array of object _References_
	- This helps the constant time access
- A single list instance may include multiple references to the same objects
- Single object can be an element of two or more lists
	- Changing the element reference to another point

*Copying Arrays*
- `backup = list(primes)`
- This produces a new list that is a `shallow copy` in that it references the same elements as in the first list.
	- If the contents of the list were of a mutable type, a `deep copy`, meaning a new list with new elements, can be produced by using the deepcopy function from the copy module
- counters = [0] * 8
	- All 8 cells reference the same object!
	- We rely on the object being mutable
	- counters[2] += 1 does not change the value of the existing int instances - computes a new integer
- `primes.extend(extras)` will add the references to the first list

*Review*
- Basic computer architecture
- Low-level array representation
- Referential arrays

## PYDS 12.2: Amotization

Using amortization, we can show that performing a sequence of such append operations on a dynamic array is actually quite efficient!

**Amotized Anaylsis**

1. Allocate memory for a larger array of size, typically twice the old array
2. Copy the contents of old array to new array 
3. Free the old array 

Once we hit a full array in items being asserted, we conclude an overflow and we implement the doubling.

With amortization, after we have continually doubled the size at an overflow, cost when we are not in overflow is a cost of 1 whereas the cost with inserting for overflow is the `n`.

```
Amortized Cost = ( 1 + 2 + 3 + 5 + 1 + 1 + 9 + 1 ... ) / n
				= [(1 + 1 + 1 + ... ) + ( 1 + 2 + 4 + ...)]
				= [n + 2n] / n
				= 3
				= O(1)
```

## PYDS-13.0: Stacks, Queues and Deques

**What is a stack?**

- Ordered collection of items where additional and removal occur at the same end
- End is referred to as the "top"
- Opposite is the "base"
- Items near the base have been in the stack the longest
- Recently added are in position to be removed first - LIFO
- Fundamentally important as it can reverse the stack easily
- Similar to a list

**Stack implementation**

```python
# Stack() creates a new empty stack
# push(item) add to stack
# pop() removes item from the top
# peek() shows you the top but does not remove
# isEmpty() bool
# size() return item size

class Stack(object):
	def __init__(self):
		self.items = []

	def isEmpty(self):
		return self.items == []

	def push(self, item):
		self.items.append(item)

	def pop(self):
		self.items.pop()

	def peek(self):
		return self.items[len(self.items)-1]

	def size(self):
		return len(self.items)

s = Stack()
print s.isEmpty() 	# true
s.push('two')
s.peek()
s.push(True)
s.size() 			# 1 
s.isEmpty() 		# false
s.pop() 			# 'two'
```

## PYDS-13.1: Queues Overview

**What are Queues?**

- Ordered collection of items where items addition happens at the end "rear"
- Removal happens from the "front"
- Item entered and waits in queue to be removed
- Longest item at the front - FIFO implementation
- "Enqueue" and "Dequeue" to the adding to the rear and removing the front
- "Push" and "pop" refers to the queue.

**Queue Implementation**

```python
# Queue() to create a queue
# enqueue(item) to add to the rear
# dequeue() removes from the front 
# isEmpty() is the bool 
# size() returns the size 

class Queue(object):
	def __init__(self):
		self.items = []
	
	def isEmpty(self):
		return self.items == []

	def enqueue(self, item):
		self.items.insert(0, item) # insert for FIFO

	def dequeue():
		return self.items.pop()

	def size():
		return len(self.items)

q = Queue()
q.size() 		# 0
q.enqueue(1)
q.enqueue(2)
q.dequeue() 	# 1
```

## PYDS-13.2: Deques Overview

**What is a deque?**

- A deque is a double-ended queue
- Also has a front and an end and the items are position within the collection
- Unrestrictive nature for adding items - add to front OR rear!
- Same for removal
- Does not require LIFO/FIFO enforced data structure design

**Implement a deque**

```python
# Deque() create a deque 
# addFront(item)
# addRear(item)
# removeFront()
# removeRear()
# isEmpty()
# size()

class Deque(object):
	def __init__:
		self.items = []

	def isEmpty(self):
		return self.items == []

	# rear is the first index
	def addRear(self, item):
		self.items.insert(0, item)

	# front is the len(self.items) index
	def addFront(self, item):
		self.items.append(item)

	def removeFront(self):
		return self.items.pop()

	def removeRear(self):
		return self.items.pop(0)

	def size(self):
		return len(self.items)

d = Deque()
d.addFront('hello')
d.addRear('world')
d.size() 										# 2
print d.removeFront() + ' ' + d.removeRear() 	# 'hello world'
d.size() 										# 0
```

## PYDS-14.0: Singly Linked Lists

**What is a singly linked list?**

- Singly Linked List is a collection of nodes that form a linear sequence 
- Each node stores a reference to the next node
- The first and last node of the list are known as the "head" and the "tail" of the list
- Process of moving through the list is "traversing"
- Each node stores a reference to the element and the next node (except the tail)
- How do we add a new element?
- Example to append to the Head (inverse can be done for appending to the Tail)
	- We create a new node 
	- Set its element to the new element 
	- Set the next link to refer to the current head 
	- Set the list's head to point to the new node
- Removing an element from the Head is essentially the reverse operation to adding the item
- We cannot easily remove the last node - to do so efficiently requires a `doubly linked list`
- O(k) time to access elements
- Constant time insertions and deletions in any position, arrays require O(n) time
- Linked Lists can expand without having to specify their size ahead of time!

**Implementation of a singly linked list**

```python
class Node(object):
	def __init__(self, value):
		self.value = value 
		self.nextNode = None

a = Node(1)
b = Node(2)
c = Node(3)

# how to link the nodes?
a.nextNode = b 
b.nextNode = c 
```

## PYDS-14.1: Doubly Linked Lists

**What is a doubly linked list?**

- `next` and `prev` for references to nodes that are both next and what precedes it
- "dummy" nodes are known as the header sentinel and trailer sentinel for both the beginning and end of a list respectively
- Each insertion happens between a pair of existing nodes
	- eg. Add between header and what is after to add to the front

**Implementation of a Doubly Linked List**

```python
class Node(object):
	def __init__(self, value):
		self.value = value
		self.nextNode = None
		self.prevNode = None

a = Node(1)
b = Node(2)
c = Node(3)

a.nextNode = b 
b.prevNode = a 
b.nextNode = c 
c.prevNode = b 
```

## PYDS-15.0: Recursion

**What is recursion?**
- Two instances 
	- First when recursion is used a technique in which a func makes one or more calls to itself 
	- Second is when data structures use smaller instances of the exact type of DS when it represents itself
- Powerful alternative to repetitive tasks in which a loop is not ideal
- Great tool for building out particular DS

## PYDS-15.1: Memoization
- Remembers results of method calls based on the method inputs and then remembering them again.

## PYDS-16.0: Trees

**Tree Section**

1. Tree Data Structures 
2. Implementing with Lists 
3. Implement with OOP 
4. Implemenet with priority queue
5. Only covers ADT (Abstract Data Types)

**What are trees?**

- Has a root, branches and leaves 
- Root at the top, leaves at the bottom
- Children of one node are independent of children of another
- Each leaf node is unique
- File systems are structured as a tree
- Consists of a set of nodes and edges that connect pairs of nodes
- Trees that have a max of two children are referred to as a *binary tree*

**Nodes in the tree**

- Can have a name "key"
- May also have additional "payload" info
- One incoming edge, 0-to-many outgoing
- Path: Order list of nodes connected by edges
- Level "n" refers to number of edges from the root node
- Height of the tree is maxHeight(Tree)

**Recursive Definition of a tree**

- either empty or consists of a root and zero or more subtrees which are also a tree 
- the root of each subtree is connected to the root of the parent by an edge

## PYDS-16.1: Implementing a Tree as a List of Lists

- Store value of root node as first element 
- Second element will be a list that represents the left subtree 
- Third element will be a list of another list representing the right subtree 

```python
# what we are aiming for 
myTree = ['a', 		# root 
		['b',		# left subtree 
			['d', [], []],
			['e', [], []],
		], 
		['c', [], []] 	# right subtree
]
```