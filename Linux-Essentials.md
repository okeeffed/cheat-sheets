# Linux Essentials

## LINUX-5: The Linux Operating System

#### ---- LINUX-5.3: Where Data is Stored

#### ++++ ---- LINUX-5.3.1: Kernel

The Linux Kernel is a Unix-like OS.

The Linux is the core of any Linux installation.

The Linux kernel is responsible for managing every other piece of software on a running Linux computer.

- It is responsibile for all of the interfacing of all the applications down to hardware between the interprocess communication system.
- Provides critical low level tasks.
- Loaded very early on in the boot process.

We could change the program that runs as the first process by adding it to the boot loader option command line.

```
# run bash first after boot
init=/bin/bash
```

First program is the `sbininit` process. This will run programs as child processes for things such as login etc.

Processes can leave behind children process that will be adopted. It's a tree like Hierarchy of processes.

There could be dozens to hundreds of processes. The kernel is at the top. We can then use commands like `ps` and `top` to directly see and manipulate these processes.

#### ++++ ---- LINUX-5.3.2: Processes

All processes have a PID.

Each process has an id which starts with one. There is also a PPID associated for the parents ID. We can identify these with utilities like `ps`

The following command will allow you to see the processes with flags -a for all users, -u for showing users that are running the process, and -x for displaying processes which do not have a controlling terminal.

```
ps aux | grep <name>
```

`top` is an interactive version of `ps`. It shows a live visual. You can use options like `top -o CPU` to order usage by things like CPU etc.

Top can also provide a load average. A load average of 0 is a system that no programs are demanding CPU time. An average of 1 is a system with one program running a CPU intensive task.

Load averages can reach a number of cores. Eg. a load average of 4.0 would be a quad core system where a program requires all cores.

The term `hung` refers to an unresponsive program.

You cannot say a process is consuming too much memory just because it is at the top of the list. Sometimes, this could actually be a result of things such as a memory leak. This could be due to a bug, but at least you can kill a program in the mean time.

The kernel also grants program access to sets of memory address. Once the program is done, it should give that memory back.

There is also a `free` command in some linux systems where you can see how much memory is used.

Swap space is used for when the system runs out of RAM. It is generally low. If it rises too much, you'll suffer from performance loss.

#### ++++ ---- LINUX-5.3.3: syslog, klog, dmesg

Most background programs (daemon) write log files for being to show info about Linux Administration.

You can even tell these programs to log even more verbose message if you're looking for an issue.

Linux normally stores it in the `/var/log` directory.

We can see some interesting programs here.

- `cron` is a linux scheduling service.
- `syslog` (mailbox) is the general purpose log files.
- `secure` log is here when something requires root privilege.

Most of the log files are easy to reading using things is `tail` and `less`.

If we use commands like `grep sshd /var/log/*` to actually look through all the log files!

Files in `/etc/sys` will show us some config files. This changes with each different Linux Distributions.

Once the log daemon is running, it will push messages towards a specific log file. The ring buffer is a log file for the kernel, which is stored on memory as opposed to a disk.

We can use `dmesg` tool! Instead, if we pipe it to `tail` or `less`, we can check out the dynamic log.

If there issues that you don't understand, you can still check this out and find answers through a search engine.

If we jump to `/etc/rc.d/rc.local` file, we can set up dmesg > /var/log/dmesg, we can start logging the dmesg file to this file on reboot.

#### ++++ ---- LINUX-5.3.4: /lib, /usr/lib, /etc, /var/log
