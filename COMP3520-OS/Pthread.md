# Pthreads 

## Pthreads API 

- Defined in the ANSI/IEEE Posix 1003.1 - 1995 standard
- Subroutines comprise the Pthreads API can be informally grouped into three major classes:
1. Thread management
2. Mutexes 
3. Condition variables

# 1: Thread Management

- first class of functions work directly on threads - creating, detatching, joining etc 
- also include funcs to set/query thread attributes (joinable, scheduling etc)

**Create Threads**

- initially, single default thread - others must be explicitly created

```
pthread_create(thread, attr, startRoutine, arg)
// thread - unique identifier for the new thread (pthread_t)
// attr - attr object used to set thread attributes (pthread_attr) - you can specify a thread attributes object, or NULL for the default values
// startRoutine - C routine that the thread will execute 
// arg - single arg that may be passed to startRoutine - it must be passed by reference (pointer to struct) and NULL may be used if no arg is to be passed

/*
	If successful, the pthread_create() function shall return zero; otherwise, an error number shall be returned to indicate the error
 */
```

**Thread Attributes**

By default, a thread is created with certain attributes.

pthread_attr_init(attr) and pthread_attr_destroy(attr) are used to initialize/destroy the thread attribute object.

Other routines are then used to query/set specific attributes in the thread attribute object.

**Terminating Thread**

1. Thread makes call to the pthread_exit() subroutine 
2. Thread is cancelled by another thread via pthread_cancel() routine 
3. Entire process is terminated due to call to exit subroutine 

Routine: `pthread_exit(status)`

- used to explicitly exit the thread
- programmer may optionalyl specify a termination status, which is stored as a void pointer for any thread that may join the calling thread

Cleanup: `pthread_exit()` does not close files; any files opened inside the thread will remain open after the thread is terminated.

**Example**

```c 
#include <pthread.h>
#include <stdio.h>
#include <stdlib.h>
#define NUM_THREADS 5

void *PrintHello(void *threadid) {
	int *tid;
	tid = (int *)threadid;
	printf("Hello World! It's me, thread #%d!\n", *tid);
	pthread_exit(NULL);
}

int main(int argc, char *argv[]) {
	pthread_t threads[NUM_THREADS];
	int rc, t, tids[NUM_THREADS];
	for (t=0; t< NUM_THREADS; t++) {
		printf("In main: creating thread %d\n", t);
		tids[t] = t;
		rc = pthread_create(&threads[t], NULL, PrintHello, (void *)&tids[t]);

		if (rc) {
			printf("ERROR; return code from pthread_create() is %d\n", rc);
			exit(-1);
		}
	}
	pthread_exit(NULL);	
}
```

## Passing Arguments to Threads

`pthread_create()` routine permits the programmer to pass one argument to the thread start routine.

For cases where multiple args must be passed, we can create a struct and use the reference pointer as an arg.

All args passed by reference must be cast to (void *)

```c 
struct two_args {
	int arg1;
	int arg2;	
};

void *needs_2_args(void *ap) {
	struct two_args *argp;
	int a1, a2;

	argp = (struct two_args *) ap;

	// do stuff here
	
	a1 = argp->arg1;
	a2 = argp->arg2;
	
	// do stuff here 

	free(argp);
	pthread_exit(NULL);
}

int main(int argc, char *argv[]) {
	pthread_t t;
	struct two_args *ap;
	int rc;

	// do stuff here 

	ap = (struct two_args *)malloc(sizeof(struct two_args));
	ap->arg1 = 1;
	ap->arg2 = 2;
	rc = pthread_create(&t, NULL, needs_2_args, (void *) ap);

	// do stuff here 

	pthread_exit(NULL);
}
```

## Joining and Detatching Threads

**Routines**

1. pthread_join(threadid, status)
2. pthread_detach(threadit, status)
3. pthread_attr_setdatachstate(attr, detachstate)
4. pthread_attr_getdetachstate(attr, detachstate)

- "joining" is one way to accomplish synchronization between threads
- the `pthread_join()` subroutine blocks the calling thread until the specified threadid thread terminates
- The programmer is able to obtain the target thread's termination return status if it was specified in the target thread's call to `pthread_exit()`
- When a thread if created, one of its attributes defines whether it is joinable or detached.
- Only threads that are create as joinable can be joined.

To explicitly create a thread as joinable or detached, the attr argument in the `pthread_create()` routine is used:

1. Declare a pthread attribute ariable of the `pthread_attr_t data` type 
2. Initialize the attribute ariable with `pthread_attr_init()`
3. Set the attribute detached status with `pthread_attr_setdetachedstate()`
4. When done, ree library resources used by the attribute with `pthread_attr_destroy()`

**Example**

```c
void *BusyWork(void *null) {
	// do stuff 
	pthread_exit((void *) 0);
}

int main(int argc, char *argv[]) {
	pthread_attr_t attr;
	int rc, t;
	void *status;

	/* init and set thread detached attribute */
	pthread_attr_init(&attr);
	pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_JOINABLE);

	/* free attribute and wait for the other threads */
	pthread_attr_destory(&attr);
	for (t=0; t< NUM_THREADS; t++) {
		rc = pthread_join(thread[t], &status);
		// do stuff 
		printf("Completed join with thred %d status = %ld\n", t, (long)status);
	}
	pthread_exit(NULL);
}
```

## Syncronisation Issues 

When multiple threads attempt to manipulate the same data item, the results can often be incoherent if proper care is not take ie. race conditions.

# 2: Mutexes

The second class of functions deal with synchronization - called a "mutex", which is an abbreviation for mutual exclusion.

## Creating and Destroying Mutexes

Routines
---
`pthread_mutex_init(mutex, attr)`
`pthread_mutex_destroy(mutex)`
`pthread_mutexattr_init(attr)`
`pthread_mutexattr_destroy(attr)`

A mutex must be declared with type `pthread_mutex_t`, and must be initialized before they can be used.

There are two ways to init a mutex variable:
1. Statically, when declared eg `pthread_mutex_t mymutex = PTHREAD_MUTEX_INITIALIZER`
2. Dynamically, with the `pthread_mutex_init()` routine. This method permits setting mutex object attributes, `attr` (which my be specified as NULL to accept defaults).

The mutex is initially unlocked.

## Locking & Unlocking Mutexes

Routines
---
`pthread_mutex_lock(mutex)`
`pthread_mutex_unlock(mutex)`
`pthread_mutex_trylock(mutex)`

- `pthread_mutex_lock(mutex)` will lock the specified mutex
- `pthread_mutex_unlock(mutex)` will unlock a mutex if called by the owning thread
	- throws an error if already unlocked or owned by another thread
- `pthread_mutex_trylock(mutex)` will attempt to lock a mutex, however if the mutex is already locked it will return a "EBUSY" error code. 
	- May be useful to prevent deadlocks!

**Example 1**

We can now write our previously incorrect code segment as...

```c 
pthread_mutex_t min_value_lock;

main() {
	...
	pthread_mutex_init(&min_value_lock, NULL);
	...
}

void *find_min(void *list_ptr) {
	...
	pthread_mutex_lock(&min_value_lock);
	if (my_cost < best_cost) {
		best_cost = my_cost;
	}	
	pthread_mutex_unlock(&min_value_lock);
}
```

**Example 2**

The `producer-consumer` scenario imposes the following constraints:

1. The producer thread must not overwrite the shared buffer when the previous task has no been picked up by a consumer thread.
2. The consumer threads must not pick up tasks until there is something present in the shared data structure.
3. Individual consumer threads should pick up tasks one at a time.

```c 
pthread_mutex_t task_queue_lock;
int task_available;

main() {
	task_available = 0;
	pthread_mutex_init(&task_queue_lock, NULL);
}

void *producer(void *producer_thread_data) {
	...
	while (!done()) {
		inserted = 0;
		create_task(&my_task);
		while (inserted == 0) {
			pthread_mutex_lock(&task_queue_lock);
			if (task_available == 0) {
				insert_into_queue(my_task);
				task_available = 1;
				inserted = 1;
			}
			pthread_mutex_unlock(&task_queue_lock);
		}
	}
}

void *consumer(void *consumer_thread_data) {
	...
	while (!done()) {
		extracted = 0;
		while (extracted == 0) {
			pthread_mutex_lock(&task_queue_lock);
			if (task_available == 1) {
				extract_from_queue(&my_task);
				task_available = 0;
				extracted = 1;
			}
			pthread_mutex_unlock(&task_queue_lock);
		}
		process_task(my_task);
	}
}
```

## Overheads of Locking 

- Locks represent serialization points since critical sections must be executed by threads one after another.
- Encapsulating large segments of the program within locks can lead to significant performance degradation.
- It is often possible to reduce the idling overhead associated with locks using `pthread_mutex_trylock`.

**Alleviating Locking Overhead**

```c 
pthread_mutex_t tryLock_lock = PTHREAD_MUTEX_INITIALIZER;

lock_status = pthread_mutex_trylock(&tryLock_lock)
if (lock_status == EBUSY) {
	/* do something else */
	...
} else {
	/* do one thing */
	...
	pthread_mutex_unlock(&tryLock_lock);
}
```

## Monitors

Mutexes provide powerful sync tools, but...
- lock() and unlock() are scatteed among several threads, therefore it is difficult to understand their effects
- usage must be correct in all the threads 
- one bad thread (or one programming error) can kill the whole system

A `monitor` is a high-level abstraction that may provide a convenient and effective mechanism for thread synchronization.

- local data variables are accessible only by the monitor 
- thread enters monitor by invoking one of its procedures 
- only one thread may be executing in a the monitor at a time

**Monitor and Condition Variables**

- Monitor does not need to code certain sync constraints explicitly.
- However, it is not sufficiently powerful for modeling some other synchronization schemes.
- An additional sync mechanism ie `condition variable` is required.

**Condition Variables**

- The third class of functions address communications between threads that share a mutex
- A condition variable allows a thread to block itself until specified data reaches a predefined state.
- A condition variable indicates an event and has no value
	- One cannot store a value into nor retrieve a value from a condition variable.
	- If a thread must wait for an event to occur, that tread waits on the corresponding condition variable.
	- A condition variable has a queue for those threads that are waiting the corresponding event to occur to wait on.
	- If another thread causes the event to occur, that thread simply signal the corresponding condition variable.
- This class includes funcs to `create`, `destroy`, `wait` and `signal` based on specified variable values.
- Funcs to set/quey cond variable attrs are also included.
- Cond variable is always used in conjunction with a `mutex lock`

## Create & Destroying Cond Variables

Routines
---
pthread_cond_init(condition, attr)
pthread_cond_destroy(condition)
pthread_condattr_init(attr)
pthread_condattr_destroy(attr)

Condition variables must be declared with type `pthread_cont_t`, and must be initialized before they can be used.

2 Ways to declare:
1. Statically
2. Dynamically 

## Waiting and Signaling on Condition Variable

`pthread_cond_signal()` is used to signal (or wake up) another thread which is waiting on the condition variable and should be called after the `mutex` is locked.

It must unlock `mutex` in order for `pthread_cond_wait()` routine to complete.

`pthread_cond_broadcast()` routine unlocks all of the threads blocked on the condition variable.

- Proper locking and unlocked of mutex is essential for these routines
	- Failing to lock may cause it NOT to block 
	- Failing to unlock the mutex may not allow a matching `pthread_cond_wait()` routine to complete (it will remain blocked)

## Producer-Consumer Using Condition Variables 

```c 
pthread_cond_t cond_queue_empty, cond_queue_full;
pthread_mutex_t task_queue_cond_lock;
int task_available;
// other data structures here 

main() {
	// declarations and initializations 
	task_available = 0;
	pthread_cond_init(&cond_queue_empty, NULL);
	pthread_cond_init(&cond_queue_full, NULL);
	pthread_mutex_init(&task_queue_cond_lock, NULL);
	// create and join producer and consumer threads
}













