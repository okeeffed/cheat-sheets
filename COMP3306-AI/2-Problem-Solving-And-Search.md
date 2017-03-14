# Problem Solving and Search 

**Learning Aims**

1. Uninformed Search: BFS, DFS, UCS and IDS 
2. Informed Search: Greedy Best-First

## Search Problem Formulation 

Defined by 4 items:

1. Initial state 
2. Goal state 
3. Operators = actions 
4. Path cost function 

**Choosing States and Actions**

Real problems are too complex, to solve them we need to _abstract_ them! Simplify them by removing unnecessary details.

Eg. If we need to find the path somewhere, we can ignore things such as weather, road conditions, scenary.

Actions need to be suitable specified eg not "turn the steering wheel left by 5 degrees".

The _level of abstraction_ must be appropriate.

- State = set of real states 
- Action = complex combination of real actions 
- Solution = set of real paths that are solutions in the real world

**8-Queens Problem**

1. Incremental - stat with empty space, add 1 queen at a time 
2. Complete-state - start with all 8 queens and move them around 

**For 1:**
- States? Any arrangement of 0 to 8 queens 
- Initial state? No queens on the board 
- Operators? Add any queen to any square 
- State space? 1.8 * 10^14 states (= 64 * 63 * ... * 57)

**For 2:**
- States? Any arrangement of 0 to 8 queens, 1 in each column with no queen attacking each other
- Initial state? No queens on the board
- Operators? Place a queen in the left-most-empty column such that it is not attacked by any other queen 
- State space? 2057 states 

**For 100-queens:**
- 1: 10^400 states 
- 2: 10^52 states (hugh improvement but problem still not tractable)

## Searching for solutions

- Searching the state space 
- Generate a search tree starting from the initial state and applying the operators 
- We can generate a search graph - in a graph the same state can be reached rom multiple paths

## Tree search algorithm - pseudo code 

Basic idea: offline exploration of the state space by generating successors of the explored states (i.e. exapnding states)

**We keep two lists:**
- Expanded - for nodes that have been expanded 
- Fringe - for nodes that bae been generated but not expanded yet

## Nodes vs States 

A `node` is different than a `state`.

**A node:**
- represents a state 
- is a data structure used in the search tree 
- includes `parent`, `children`, and other relevant information e.g. `depth` and `path cost g`

## Search Strategies 

- A `search strategy` defines which node from the fringe is most promising and should be expanded next
- We always keep the nodes in the fringe orded based on the search strategy and always expand the first one 

**Evaluation Critera**

Term				| Definition
---					| ---
Completeness 		| is it guaranteed to find a solution if one exists?
Optimality			| is it guaranteed to find an `optimal (least cost path)` solution?
Time complexity		| How long does it take to find the solution? (measured as no. of generated nodes)
Space complexity	| what is the max number of nodes in memory?

**Time and space complexity**

Measured in terms of:
- b: max branching factor of the search tree (we can assume that it is finite)
- d: depth of the optimal (least cost) solution 
- m: maximum depth of the state space (can be finite or not finite)

**There are two types of search methods:**

1. Uninformed (blind)
2. Informed (heuristic)

## Uninformed (Blind) Search Strategies 

**Uninformed strategies:**

- Generate children in a systematic way eg level by level, from left to right 
- Know if a child node is a goal or non-goal node 
- Do not know if one non-goal child is better (more promising) than another one. By contrast, informed (heuristic) search strategies know this

**5 uninformed search strategies:**

- Breadth first 
- Uniform-cost 
- Depth-first 
- Depth-limited 
- Iterative deepening

## BFS - Breadth First Search

```
Is the first node in the fringe a goal node?
	Yes => stop and return solution
	No => expand it:
		- Move it to the expanded list
		- Generate its children and put them in the fringe in a order defined by the search strategy
```

**Properties**

- Complete? Yes
- Optimal? Not optimal in general; Yes, if step cost is the same, e.g. =1
- Time? generated nodes = `1+b+b^2+ ... + b^d = O(b^d)`, exponential
- Space? O(b^d) (keeps every node in memory)
- Both time and space are problems as they grow exponentially with depth but space is the bigger problem!

## UCS - Uniform Cost Search

- Complete? Yes ( if step cost>0 )
- Optimal? Yes
- Time? # nodes with g  cost of optimal solution O(bd)
- Space? # nodes with g  cost of optimal solution O(bd)

UCS is equivalent to BFS if the step cost is 1 or the same

## DFS - Depth-Firth Search 

- Expands deepest unexpanded node
- Implementation: insert children at the front of the fringe Fringe: A
Expanded: none

## IDS - Iterative Deepening Searh (IDS)

- Sidesteps issue o choosing the best depth limit by trying all possible depth limits in turn (0, 1, 2, etc.) and applying DFS.

- Depth-limited search = DFS with depth limit l
	- i.e. it imposes a cutoff on the maximum depth
- Properties - similar to DFS
	- Complete? Yes (as the search depth is always finite)
	- Optimal? No
	- Time? 1+b^2+b^3+b^4 + ... +b^l = O(b^l)
	- Space? O(bl)

**Overhead of multiple expansion**

- May seem wasteful as many nodes are expanded multiple times
- But for most problems the overhead of this multiple expansion is small!

**Common properties of IDS**

```
b - branching factor 
d - depth of least cost solution 
m - max depth 
```

- Combines the benefits of DFS and BFS
- Complete? As BFS:
	- Yes [DFS: yes, if m is finite; no otherwise]* 
- Optimal? As BFS:
	- No in general; Yes if step cost=1 [DFS: not optimal, even if step cost=1] *
- Time? As BFS:
	- `(d+1)b^0+db^1+(d-1)b^2+ ... +bd = O(b^d) [DFS: O(bm)] *`
- Space? As DFS: O(bd), linear
- Where are the improvements of IDS in comparison to DFS? - in completeness, optimality and time (shown with *)
- Can be modified to explore uniform-cost tree

## Informed vs Uninformed Search

- A search strategy defines the order of node expansion

**Uniformed**
- Uninformed search strategies do not use problem specific knowledge beyond the definition of the problem, i.e. they do not use heuristic knowledge.
	- expand nodes systematically 
	- know if node is goal or non-goal
	- cannot compare two non-goal nodes (do not know if one goal node is better than another)
	- typically inefficient

**Informed**
- Informed search strategies use problem-specific heuristic knowledge to select the order of node expansion. They:
	- can compare non-goal nodes – they know if one non-goal node is better than another one
	- are typically more efficient

## Best First Search 

How can informed strategies compare non-goal nodes?






