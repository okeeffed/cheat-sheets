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
	- The estimate to reach the goal is smaller or equal to the true cost to reach the goal
- Admissible heuristics are `optimistic` - they think that the cost of solving the problem is less than it actually is.
	- heuristic never overestimates actual cost -> it is admissible

**Theorem**

If `h` is an `admissible heuristic` than A* is complete and optimal.

How to check?

See if the estimated cost for a node is <= the actual cost from that node to the goal node.

## Optimality of A* - Proof

Compare f(G2) and f(G)

1. f(G2)=g(G2)+h(G2) (by definition) = g(G2) as h(G2)=0, G2 is a goal
2. f(G)=g(G)+h(G) (by definition) = g(G) as h(G)=0, G is a goal
3. g(G2)>g(G) as G2 is suboptimal
4. => f(G2)>f(G) by substituting 1) and 2) into 3)
5) f(n)=g(n)+h(n) (by definition)
6) h(n) <= h*(n) where h*(n) is the true cost from n to G (as h is admissible)
7) => f(n)<=g(n) + h*(n) (5 & 6)
8) = g(G) path cost from S to G via n
9) g(G) = f(G) as f(G)=g(G)+h(G)=g(G)+0 as h(G)=0, G is a goal 
10) => f(n)<=f(G) (7,8,9)
	- Thus f(G)<f(G2) (4) & f(n)<=f(G) (10)
11) f(n)<=f(G)<f(G2) (10, 4)
12) f(n)<f(G2) => n will be expanded not G2; A* will not select G2 for expansion