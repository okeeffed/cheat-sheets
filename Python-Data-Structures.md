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

What is a stack?

- Ordered collection of items where additional and removal occur at the same end
- End is referred to as the "top"
- Opposite is the "base"