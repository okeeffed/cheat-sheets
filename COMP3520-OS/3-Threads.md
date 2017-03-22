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
	- Suspending process means all threads of a process 
	- Terminates a process terminates all threads within the process 
- Similar to processes, threads have execution states and may synchronize with one another.


## Thread Execution States 

Three basic states

1. Running 
2. Ready 
3. Blocked 

Operations associated with a change in thread state 
- Spawn (another thread)
	- allocate register context and stacks 
- Block 
	- move to an event queue waiting for the event 
	- issue: will blocking a thread block other, or all, threads within the same process?
- Unblock 
	- moved the the `Ready` queue for execution
- Finish (thread)
	- de-allocate register context and stacks 

## Thread Synchronization 

Necessity to sync activities of all threads and prevent interference between each other.

- all threads of a process share the same address space and other resources 
- any alteration of a resource by one thread affects the other threads in the same process 

In general, the techniques used for thread sync are the same as those for process sync.

## Types of Threads 

1. User Level Thread (ULT)
2. Kernel Level Thread (KLT) 
	- also called kernel-supported threads or lightweight threads




