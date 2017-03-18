# Week 3 - A* Algorithm

**Aims**

- A* search algorithm 
- How to invent admissible heuristics

## A* Search

- UCS minimizes the cost so far `g(n)`
- GS minimizes the estimated cost to the goal `h(n)`
- A* combining UCS and GS
- Evaluation function: `f(n)=g(n)+h(n)`
	- `g(n) = cost so far to reach n`
	- `h(n) = est. cost from n to goal`
	- `f(n) = est. total cost of path through n to the goal`

The idea is that we take into account both the cost and estimated cost and combine them to decide which nodes to add to the fringe queue!

**BFS Special Case**

Result when each node at level n has the same f(n) total.