# Week 3 - Threads

## Processes and Threads 

Processes have two characteristics:

1. Resource Ownership 
	- process includes a virtual address space to hold the process image 
	- the OS performs a protection function to prevent unwanted interference between processes with respect to resources
2. Scheduling/Execution
	- follows an execution path that may be interleaved with other processes 
	- a process has an execution state (Running, Ready, etc.) and a dispatching priority and is scheduled and dispatched by the OS

These two characteristics are treated independently by modern operating systems:
	- the unit of dispatching is referred to as a `thread` or lightweight process 
	- the unit of resource ownership is referred to as a `process` or `task`

## Multithreading 

The ability of an OS to support multiple, concurrect paths of execution within a single process

## Process 

The unit of resource allocation and a unit of protection.

A process is associated with: 
- A virtual address space which holds the process image 
- Protected access to 
	- Processors
	- Other processes 
	- Files 
	- I/O resources 

## Multiple threads in Process 

Each thread has:
- Access to the memory and resources of its process (all threads of a process share this)
- An execution state (running, ready, etc.)
- Saved thread context when not running 
- An execution stack 
- Some per-thread static storage for local variables

## Single-Threaded vs multi threaded 

- Both have `Process Control Block`
- Both have `User Address Space`
- Single thread has a `User Stack` and `Kernel Stack`
- Multithread process has a `User Stack`, `Kernel Stack`, `Thread Control Block` within each thread

## Threads 

In OS that supports threads: scheduling and dispatching done on thread basis 

- Most of the state info dealing with execution is maintained in thread-level data structures 
- Several actions that affect all of the threads in a process and that the OS must manage at the process level