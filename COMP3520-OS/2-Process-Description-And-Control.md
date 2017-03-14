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