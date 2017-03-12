# Pthreads 

## Pthreads API 

- Defined in the ANSI/IEEE Posix 1003.1 - 1995 standard
- Subroutines comprise the Pthreads API can be informally grouped into three major classes:
1. Thread management
2. Mutexes 
3. Condition variables

**Thread Management**

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















