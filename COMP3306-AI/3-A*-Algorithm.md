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

**BFS and UCS Special Case**

- BFS is a special case of A* when f(n)=depth(n)
- BFS is also a special case of UCS when g(n)=depth(n)
- UCS is a special case of A* when h(n)=0

## Admissible Heauristic 

- Heuristic `h(n)` is admissible if for every node n:
	- `h(n) <= h*(n)` where `h*(n)` is the true cost to reach a goal from `n`
	- The estimate to reach the goal is smaller or equal to the true cost to reach the ogal