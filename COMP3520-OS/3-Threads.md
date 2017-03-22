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

## User-Level Threads 

Thread management all done by application.
- Multithreading is managed by a runtime threads lib 

The kernel is not aware of the existence of threads 
- Only schedule the process as a unit and assigns a single execution state to that process 

## Disadvantages of ULT 

In a typical OS many system calls are blocking 
- as a result, when a ULT executes a system call, not only is the thread blocked, but all within the process are blocked 

In a pure ULT strategy, multithreaded applications cannot take advantage of multiprocessing.

## Kernel-Level Threads 

Kernel maintains context information for the process and the threads. 
- No thread management done by application 

Scheduling is done on a thread basis.

Windows is an example of this approach.

## Advantages of KLT 

The kernel can simultaneously schedule multiple threads from the same process on multiple processors.

If one thread is blocked, the kernel schedules another thread of the same process.

Kernel routines themselves can be multithreaded.

## Multicore & Multithreading 

Achieves concurrency without the overhead of using multiple processes.

Threads within the same process can exchange information through their common address space and have access to the shared resources of the process.

- Threads of any process can run on any processor
- Soft affinity:
	- dispatcher tries to assign a ready thread to the same processor it last ran on 
	- helps reuse data still in that processor's memory caches from the previous execution of the thread 
- Hard affinity:
	- an application restricts thread execution to certain processors

## Multicore Challenges 

- Dividing activities 
- Balance 
- Data splitting 
- Data dependency 
- Testing and debugging 
