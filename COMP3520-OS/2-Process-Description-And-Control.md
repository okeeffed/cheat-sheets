# Process Description and Control

**Objectives**

- How are processes represented and controlled by the OS
- `Process states` which characterize the behaviour of processes 
- `Data structures` used to manage processes
- Ways in which the OS uses these data structures to control process execution

## Operating System 

Program that controls the execution of application programs.
- Interface between applications and hardware.
- Frequently relinquishes control and must depend on the processor to allow it to regain control – events driven

## System Calls
- Typically high-level language (C or C++)
- Access of programs through API rather than direct system call use 
- 3 common APIs are Win32, POSIX and Java API for JVM

**Types of system calls**
1. Process control 
2. File management 
3. Device management 
4. Information maintenance 
5. Communications

**Key elements of an OS**
- Service call Handler (<- service call to process)
- Interrupt Handler (<- interrupt from Process/IO)
- Short-Term Scheduler (-> Pass Control to Process)
- Long-Term, Short-Term and I/O Queues

**System Call Implementation**
- Typically a number associated with each sys call
	- sys-call interface maintains table indexed accordingly
- Call invoked by interface in OS kernel and returns status of the system call and any return values
- Caller need no nothing about implementation of call

**Shell Strategy**
1. Read keyboard 
2. Shell Process 
3. Fork a process 
4. Process to execute command 
5. f3 read file

**Process**
Fundamental to the structure of operating systems

A process can be defined as:
1. A program in execution 
2. An instance of a running program 
3. The entity that can be assigned to, and executed on, a processor 
4. Unit of activity characterized by a single sequential thread of execution, a current state and an associated set of system resources

**Uniprogramming**
Processor must wait for I/O instruction to complete before proceeding.

**Multiprogramming**
When one job needs to wait for I/O, the processor can switch to the other job

**Time Sharing Systems**
- Using multiprogramming to handle multiple interactive jobs 
- Multiple users simultaneously access system through terminal 
- Processor's time shared among multiple users 
- Timesharing (multitasking): CPU switches jobs so frequently that users can interact with each job while it is running, creating interactive computing
	- Resp time < 1s
	- Each user has at least one program executing in memory -> `process` 
	- If several jobs ready to run at the same time -> `CPU Scheduling`
	- To ensure orderly execution -> `Synchronization` and `Communication`
	- `Virtual memory` allows execution of processes not completely in memory 
	- Also need mechanisms for `Security and Protection`

**Process Management**
- `The fundamental task`
- OS must... 
	- Allocate resources to processes and protect the resources of each process from others 
	- Interleave the execution of multiple processes 
	- Enable proc. to share and exchange info 
	- Enable sync. among processes

**Process elements**

Process can be uniquely charactized by a number of attributes:

1. Identifier 
2. State
3. Priority 
4. Program counter 
5. Memory pointers 
6. Context data 
7. I/O status info 
8. Accounting info 

**Process control block**

- Most important Data Structure in the OS

## Process Tables 

OS tables must be linked or cross-referenced.

**Process Execution**

- `Dispatcher` is a small program which switches the processor from one process to another

**Modes of Execution**

1. User mode 
	- Less priviledge 
	- User programs typically execute in this mode 
2. System (or kernel mode)
	- More priviledges 
	- Kernel of the OS

**Two-State Process Model**

- State of a process may be defined by the current activity of that process
	- Used to describe the behaviour that we would like each process to exhibit







