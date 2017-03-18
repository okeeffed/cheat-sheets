# Week 3 - A* Algorithm

**Aims**

- A* search algorithm 
- How to invent admissible heuristics

## A* Search

- UCS minimizes the cost so far `g(n)`
- GS minimizes the estimated cost to the goal `h(n)`
- A* combing UCS and GS
- Evaluation function: `f(n)=g(n)+h(n)`