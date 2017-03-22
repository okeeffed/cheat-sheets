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