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

**Implementing a Tree using a List of Lists**

```
# define the style of tree with a root and left/right empty child lists
def BinaryTree(r):
	return [r, [], []]

def insertLeft(root, newBranch):
	t = root.pop(1)

	if len(t) > 1:
		root.insert(1, [newBranch, t, []])
	else:
		root.insert(1, [newBranch], [], [])
	return root

def insertRight(root, newBranch):
	t = root.pop(1)

	if len(t) > 1:
		# reordered compared to above
		root.insert(2, [newBranch, [], t)
	else:
		root.insert(2, [newBranch], [], [])
	return root

def getRootVal(root):
	return root[0]

def setRootVal(root, newVal):
	root[0] = newVal

def getLeftChild(root):
	return root[1]

def getRightChild(root):
	return root[2]

r = BinaryTree(3)
insertLeft(r, 4)
# [3, [4, [], []], []]
insertLeft(r, 5)
# [3, [5 [4, [], []], []], []]
insertRight(r, 6)
# [3, [5 [4, [], []], []], [6, [], []]]
insertRight(r, 7)
# [3, [5 [4, [], []], []], [7, [], [6, [], []]]]
l = getLeftChild(r)
print l 
# [5 [4, [], []], []]
setRootVal(1, 9)
# [3, [9 [4, [], []], []], [7, [], [6, [], []]]]
```

## PYDS-16.1: Node and Node References Implementation

- In this case, define a class that has attributes for the root value as well as left and right subtrees 
- Since rep more closely follows OOP, we will continue with this representation

```python 
class BinaryTree(object):
	def __init__(self, rootObj):
		self.key = rootObj 
		self.leftChild = None
		self.rightChild = None 

	def insertLeft(self, newNode):
		if self.leftChild == None: 
			self.leftChild = BinaryTree(newNode)
		else:
			t = BinaryTree(newNode)
			t.leftChild = self.leftChild
			self.leftChild = t

	def insertRight(self, newNode):
		if self.rightChild == None:
			self.rightChild = BinaryTree(newNode)
		else:
			t = BinaryTree(newNode)
			t.rightChild(self.rightChild)
			self.rightChild=(t)
	
	# bring back Object Address values
	def getRightChild(self):
		return self.rightChild 

	def getLeftChild(self):
		return self.leftChild

	def setRootVal(self, obj):
		self.key = obj 

	def getRootVal(self):
		return self.key

r = BinaryTree('a')
r.getRootVal()
# 'a'
print r.getLeftChild() 
# None 
r.insertLeft('b')
r.getLeftChild()
# get address of another binary tree 
r.getLeftChild().getRootVal()
# 'b'
```

## PYDS-16.2: Tree Traversals 

**3 Main Methods**

1. Preorder
2. Inorder 
3. Postorder 

- Commonly used patterns 
- Difference is the order in which nodes are visited
- Preorder
	- We visit the root node first, before a recursive preorder traversal of the left subtree followed by the same for the right subtree
- Inorder 
	- We recursively do an inorder traversal of left subtree, then visit the root node, then a recusive inorder traversal of the right subtree 
- Postorder 
	- Recursively postorder traversal of the left subtree and the right subtree followed by a visit to the root node

**How to use "Preorder"**

- Think of a tree with a Book as the root, Chapters 1 and 2 as the children and sections as the children of the chapters
- Preorder can "read it" from front to book
- Read the "Book" node, then recusively go down the left child eg. Chapter One and each recursive left subtree from there

**Preorder implementation**

- Base case to check if tree exists 
- If parameter is None, then the function returns without taking any action
- This can be implemented as a method of the `BinaryTree` class
	- Must check for the existence of the left and the right children before making the recursive call to preorder
	- In this case, probably better implementing it as an external function
	- The reason is that you rarely just want to traverse the tree 
	- Most cases you want to accomplish something else during traversal


```python
def preorder(tree):
	if tree != None:
		print(tree.getRootVal())
		preorder(tree.getLeftChild())
		preorder(tree.getRightChild())

# implementation as a BinaryTree method 
# generally not what you will want to do
def preorder(self):
	print(self.key)
	if self.leftChild:
		self.leftChild.preorder()
	if self.rightChild:
		self.rightChild.preorder()
```

**Postorder Implementation**

- Nearly identical to preorder except that we move the call to print to the end 

```python
def postorder(tree):
	if tree != None:
		preorder(tree.getLeftChild())
		preorder(tree.getRightChild())
		print(tree.getRootVal())
```

**Inorder Implementation**

- In inorder traversal we visit the left subtree, followed by the root and finally the right subtree 
- Notice that in all three of the traversal functions we are simply changing the position of the print statement with respect to the two recursive function calls

```python
def inorder(tree):
	if tree != None:
		inorder(tree.getLeftChild())
		print(tree.getRootVal()) 				# print root for Proof of Concept
		inorder(tree.getRightChild())
```

## PYDS-16.3: Priority Queues with Binary Heaps

**What are Binary Queues?**

- One important variation of a queue is called a *Priority Queue*
- A priority queue acts like a queue in that you dequeue an item by removing it from the front
- However, the logical order of items inside a queue is determined by their priority 
- The classic way to implement this is using a *Binary Heap* 
- Binary heap allows us both enqueue and dequeue items in O(log n) time!

**What are Binary Heaps**

- Two common variations 
	- "min heap": the smallest key is always at the front 
	- "max heap": in which the largest key value is always at the front 

**Implementing a Binary Heap**

- to make the heap work efficiently, we use logarithmic nature of binary tree 
- must keep the tree balanced
	- we do this by creating a *complete binary tree* 
	- if we know it is a complete list, we can find the parent/child relationship `2p` and `2p+1` - we can use this to make an efficient implementation of the tree
	- index 0 is set as 0 and then that math operation works
- heap will init with one element 0, but the current size will be 0
- most efficient way is to append to the list
	- likely violate the heap structure property by comparing with the parent
	- if new item is less than parent, we can swap the parent and child and repeat!

```python
# BinaryHeap() - create new heap 
# insert(k) - adds a new item to the heap 
# findMin() - returns the item with the minimum key value, leaving item in the heap 
# delMin() - returns the item with the minimum key value, removing item from the heap 
	# requires that we take the last position and set it to the root
	# restore order by pushing down new root node
	# swap new root with smallest child recursively
# isEmpty() 
# size
# buildHeap(list) builds a new heap from a list of keys
	# we can build a heap in O(n) operations

class BinaryHeap(object):
	def __init__(self):
		self.heapList = [0]
		self.currentSize = 0

	def percUp(self, i):
		while i // 2 > 0:
			if self.heapList[i] < self.heapList[i // 2]:
				tmp = self.heapList[i//2]
				self.heapList[i//2] = self.heapList[i]
				self.heapList[i] = tmp 
			i = i // 2

	def insert(self, k):
		self.heapList.append(k)
		self.currentSize = self.currentSize + 1 
		self.percUp(self.currentSize)

	def percDown(self, i):
		while (i * 2) <= self.currentSize:
			mc = self.minChild(i)
			if self.heapList[i] > self.heapList[mc]:
				tmp = self.heapList[i]
				self.heapList[i] = self.heapList[mc]
				self.heapList[mc] = tmp 
			i = mc

	def minChild(self, i):
		if i * 2 + 1 > self.currentSize:
			return i * 2
		else:
			if self.heapList[i*2] < self.heapList[i*2+1]:
				return i * 2 
			else:
				return i * 2 + 1 

	def delMin(self):
		retVal = self.heapList[1]
		self.heapList[1] = self.heapList[self.currentSize]
		self.currentSize = self.currentSize - 1 
		self.heapList.pop()
		self.percDown(1)
		return retVal

	def buildHeap(self, aList):
		i = len(aList) // 2 
		self.currentSize = len(aList)
		self.heapList = [0] + aList[:]
		while (i > 0):
			self.percDown(i)
			i = i - 1
```

## PYDS-16.4: Binary Search Trees

- We've seen two different ways to get key-value pairs in a collection 
- These collections implement the `map abstract data type`
- Two implementations talked about so far were binary search on a list and hash tables.

**Implementation of Binary Search Trees**

- relies on the property that keys that are less than the parent are found in the left subtree, while those greater are in the right subtree.
	- left/right subtree implementation is the `bst` property 
	- refers just to direct parent
	- understand when something becomes to left and right tree
- implementation will use two classes! *BinarySearchTree* and *TreeNode* 
	- since we need to be able to create and work with an empty tree
	- *BinarySearchTree* has a reference to the *TreeNode* that is the root of the binary search tree

```python
# order of insert data = [70,31,93,94,14,23,73]
# put moethod - check if tree already has a root 
	# if not, create a new TreeNode and install it as the root of the tree
	# if root node in place, call private, helper function put
		# start at root of tree, search tree comparing new key to key in current node 
		# if less, search left, if more, search right

# get method is easier since it searches tree recursively until it gets to a non-matching leaf node of finds a matching key 
	# when matching key found, the value stored in the payload of the node is returned

# delete is more difficult
	# if tree has more than one node, we search using the _get method to find the TreeNode that needs to be removed
	# if single node, remove root but must check if root key == param key
	# if we find node, 3 options to consider 
		# does node to delete have children?
			# remove reference to parent -> set [left|right] child to None
		#  does node to delete have single child?
			# slightly more complex -> promote child to take parent

class BinarySearchTree:
	def __init__(self):
		self.root = None 
		self.size = 0 

	def length(self): 
		return self.size 

	# allows to call len(<BST object>)
	def __len__(self):
		return self.size 

	def __iter__(self):
		return self.root.__iter__()

	def _put(self, key, val, currentNode):
		if key < currentNode.key:
			if currentNode.hasLeftChild():
				self._put(key,val,currentNode.leftChild)
			else:
				currentNode.leftChild = TreeNode(key,val,parent=currentNode)
		else:
			if currentNode.hasRightChild():
				self._put(key,val,currentNode.rightChild)
			else:
				currentNode.rightChild = TreeNode(key, val, parent = currentNode)

	def __setitem__(self, k, v):
		self.put(k,v)

	def put(self, key, val):
		if self.root:
			self._put(key, val, self.root)
		else:
			self.root = TreeNode(key, val)
		self.size = self.size + 1 

	# _ for code refactoring reasons as help
	def _put(self, key, val, currentNode):
		if key < currentNode.key:
			if currentNode.hasLeftChild():
				self._put(ley, val, currentNode.leftChild)
			else:
				currentNode.leftChild = TreeNode(key, val, parent = currentNode)
		else:
			if currentNode.hasRightChild():
				self._put(key, val, currentNode.rightChild)
			else:
				currentNode.rightChild = TreeNode(key, val, parent = currentNode)

	def get(self, key):
		if self.root:
			res = self._get(key,self.root)
			if res:
				return res.payload 
			else:
				return None 
		else:
			return None 

	def _get(self, key, currentNode):
		if not currentNode:
			return None 
		elif currentNode.key == key:
			return currentNode 
		elif key < currentNode.key:
			return self._get(key, currentNode.leftChild)
		else:
			return self._get(key, currentNode.rightChild)

	def __getitem__(self, key):
		return self.get(key)

	def __contains__(self, key):
		if self._get(key, self.root):
			return True 
		else:
			return False 

	def delete(self, key):
		if self.size > 1:
			nodeToRemove = self._get(key, self.root)
			if nodeToRemove:
				self.remove(nodeToRemove)
				self.size = self.size-1 
			else:
				raise KeyError('Error, key not in tree')
		elif self.size == 1 and self.root.key == key: 
			self.root = None 
			self.size = self.size - 1 
		else:
			raise KeyError('Error, key not in tree')

	def __delitem__(self, key):
		self.delete(key)

	def spliceOut(self):
		if self.isLeaf():
			if self.isLeftChild():
				self.parent.leftChild = None 
			else:
				self.parent.rightChild = None 
		elif self.hasAnyChildren():
			if self.hasLeftChild():
				if self.isLeftChild():
					self.parent.leftChild = self.leftChild 
				else:
					self.parent.rightChild = self.leftChild
					self.leftChild.parent = self.parent 
		else:
			if self.isLeftChild():
				self.parent.leftChild = self.rightChild 
			else:
				self.parent.rightChild = self.rightChild 
				self.rightChild.parent = self.parent 

	def findSuccessor(self):
		succ = None 
		if self.hasRightChild():
			succ = self.rightChild.findMin()
		else:
			if self.parent:
				if self.isLeftChild():
					succ = self.parent 
				else:
					self.parent.rightChild = None 
					succ = self.parent.findSuccessor()
					self.parent.rightChild = self 
		return succ

	def findMin(self):
		current = self 
		while current.hasLeftChild():
			current = current.leftChild 
		return current 

	def remove(self, currentNode):
		if currentNode.isLeft(): #Leaf 
			if currentNode == currentNode.parent.leftChild:
				currentNode.parent.leftChild = None
			else:
				currentNode.parent.rightChild = None 
		elif currentNode.hasBothChildren(): #interior 
			succ = currentNode.findSuccessor()
			succ.spliceOut()
			currentNode.key = succ.key 
			currentNode.payload = succ.payload 
		else: # this node has one child 
			if currentNode.hasLeftChild():
				if currentNode.isLeftChild():
					currentNode.leftChild.parent = currentNode.parent 
					currentNode.parent.leftChild = currentNode.leftChild 
				elif currentNode.isRightChild():
					currentNode.leftChild.parent = currentNode.parent 
					currentNode.parent.rightChild = currentNode.leftChild 
				else: 
					currentNode.replaceNodeData(currentNode.leftChild.key,
							currentNode.leftChild.payload,
							currentNode.leftChild.leftChild,
							currentNode.leftChild.rightChild)
			else:
				if currentNode.isLeftChild():
					currentNode.rightChild.parent = currentNode.parent 
					currentNode.parent.leftChild = currentNode.rightChild 
				elif currentNode.isRightChild():
					currentNode.rightChild.parent = currentNode.parent 
					currentNode.parent.rightChild = currentNode.rightChild 
				else:
					currentNode.replaceNodeData(currentNode.rightChild.key,
							currentNode.rightChild.payload,
							currentNode.rightChild.leftChild,
							currentNode.rightChild.rightChild)

class TreeNode:
	def __init__(self, key, val, left=None, right=None, parent=None):
		self.key=key 
		self.val=val 
		self.left=left 
		self.right=right 
		self.parent=parent 

	def hasLeftChild(self):
		return self.leftChild 

	def hasRightChild(self):
		return self.rightChild 

	def isLeftChild(self):
		return self.parent and self.parent.leftChild == self 

	def isRightChild(self):
		return self.parent and self.parent.rightChild == self 

	def isRoot(self):
		return not self.parent 

	def isLeaf(self):
		return not (self.rightChild or self.leftChild)

	def hasAnyChildren(self):
		return self.rightChild or self.leftChild 

	def hasBothChildren(self):
		return self.rightChild and self.leftChild

	def replaceNodeData(self, key, value, lc, rc):
		self.key = key 
		self.payload = value 
		self.leftChild = lc 
		self.rightChild = rc 
		if self.hasLeftChild(): 
			self.leftChild.parent = self 
		if self.hasRightChild():
			self.rightChild.parent = self 
```

Notes:
- Deletion is one of the more difficult things we can do for a binary search tree 
- If both children are present, then we need to decide on a successor
- The successor is guaranteed to have no more than one child, so we know how to remove it using the two cases for deletion that we have already implemented 
- Once the successor has been removed, we simply put it in the tree in place of the node to be deleted
- This is an inorder traversal from largest to smallest
	- If right child, the successor is the findMin() of that right subtree 
	- If no right child, then successor is the parent
- Remember, left most child will be the smallest of a BST
- The iterator method itself takes a bit more work
	- yield keyword freezes the state of the function
	- iterators vs generators in Python

## PYDS-16.5: Common Tree Questions

Given a binary tree, check whether it's a binary search tree or not.

- Tree traversal should lead to sorted order
- Another solution is to keep track of the min and max values a node can take

```
# Solution 1 
tree_vals = []
# traversal should lead to sorted order
def inorder(tree):
	if tree != None:
		inorder(tree.getLeftChild())
		treeVals.append(tree.getRootVal())
		inorder(tree.getRightChild())

def sortCheck(treeVals):
	return treeVals == sorted(treeVals)

inorder(tree)
sortCheck(treeVals)

# Solution 2
# class Node
	# def treeMax - if not node, return -inf 
	# def tree Min - not node, return inf 
	# def verify
		- if not node, return True 
		- if tree.max and tree.min and verify(node.right) return True 
		- else return False
```














