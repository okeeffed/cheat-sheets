# Linux Essentials

<!-- TOC -->

*   [Linux Essentials](#linux-essentials)
    *   [LINUX-2: Finding Your Way on a Linux Systems](#linux-2-finding-your-way-on-a-linux-systems)
        *   [---- LINUX-2.1: Command Line Basics](#-----linux-21-command-line-basics)
            *   [++++ ---- uname](#------uname)
            *   [++++ ---- History and completion](#------history-and-completion)
            *   [++++ ---- cd and pwd](#------cd-and-pwd)
            *   [++++ ---- Shell config files](#------shell-config-files)
            *   [++++ ---- Variables: Env/Sys Variables](#------variables-envsys-variables)
            *   [++++ ---- Variables: User Defined vars](#------variables-user-defined-vars)
            *   [++++ ---- Globbing](#------globbing)
            *   [++++ ---- Quoting](#------quoting)
            *   [++++ ---- Formatting Commands](#------formatting-commands)
            *   [++++ ---- Working with Options](#------working-with-options)
        *   [---- LINUX-2.2: Using the Command Line to Get Help](#-----linux-22-using-the-command-line-to-get-help)
            *   [++++ ---- Man](#------man)
        *   [---- LINUX-2.3: Using Directories and Listing Files](#-----linux-23-using-directories-and-listing-files)
            *   [++++ ---- The Linux File System](#------the-linux-file-system)
        *   [---- LINUX-2.4: Creating, Moving and Deleting Files](#-----linux-24-creating-moving-and-deleting-files)
            *   [++++ ---- Files and Directories](#------files-and-directories)
    *   [LINUX-3: The Power of the Command Line](#linux-3-the-power-of-the-command-line)
        *   [---- LINUX-3.1: Archiving Files on the Command Line](#-----linux-31-archiving-files-on-the-command-line)
        *   [++++ ---- Files, Directories](#------files-directories)
    *   [LINUX-5: The Linux Operating System](#linux-5-the-linux-operating-system)
        *   [---- LINUX-5.3: Where Data is Stored](#-----linux-53-where-data-is-stored)
            *   [++++ ---- LINUX-5.3.1: Kernel](#------linux-531-kernel)
            *   [++++ ---- LINUX-5.3.2: Processes](#------linux-532-processes)
            *   [++++ ---- LINUX-5.3.3: syslog, klog, dmesg](#------linux-533-syslog-klog-dmesg)
            *   [++++ ---- LINUX-5.3.4: /lib, /usr/lib, /etc, /var/log](#------linux-534-lib-usrlib-etc-varlog)
            *   [---- LINUX-5.4: Your Computer on the Network](#-----linux-54-your-computer-on-the-network)
            *   [++++ ---- LINUX-5.3.1: Internet, Network, Routers](#------linux-531-internet-network-routers)

<!-- /TOC -->

<div id="2"></div>

---

## LINUX-2: Finding Your Way on a Linux Systems

<div id="newSection"></div>

### ---- LINUX-2.1: Command Line Basics

#### ++++ ---- uname

```
okeeffe_d@dok ~$ uname
Darwin

okeeffe_d@dok ~$ uname -n  
dok.gateway

okeeffe_d@dok ~$ uname -r
15.6.0

okeeffe_d@dok ~$ uname -m
x86_64

okeeffe_d@dok ~$ uname -p
i386

okeeffe_d@dok ~$ uname -a                                    1 ↵
Darwin dok.gateway 15.6.0 Darwin Kernel Version 15.6.0: Thu Jun 23 18:25:34 PDT 2016; root:xnu-3248.60.10~1/RELEASE_X86_64 x86_64
```

#### ++++ ---- History and completion

All commands are kept in the history file eg. `.bash_history`

You can cycle through with the arrows.

ENV variables can allow us to control history. We can also change the history file length (default 500) by we could go `export HISTFILESIZE=99999` to make our History file far longer.

We can also `tab` to autocomplete things.

#### ++++ ---- cd and pwd

cd - change directory
pwd - print working directory

#### ++++ ---- Shell config files

This will vary depending on what kind of shell we are using eg. login or not login.

We can configure it to boot automatically (run level 5).

`/etc/.bash_rc` is set up to run different commands and ENV vars for our enviornment.

`/etc/.bash_profile` and other hidden `.bash_name` run at certain times etc. which can be used for login shells etc.

If you run a login shell, `.bash_profile` will be the first to run. No distribution will use all of these files.

There is also a certain order to how these files are called upon. Call order is also dependent on the OS.

```
// dependent on non login shells or login shells - eg booting into a machine
.bash_profile
.bash_login || .bash_rc // it will use the first that it finds and use that
```

Every file is also user specific. If you can change `/etc/profile` you can change the settings for every single user.

#### ++++ ---- Variables: Env/Sys Variables

There are user defined and system defined variables. It is stored in the systems RAM that is reserved for this sort of operation.

**Environment Variables**

These are named and defined by the OS. This is generally run from our shell prompt. Eg. the tilda key will always move us to our Home directory.

**User Variables**

These can be defined by the user themselves.

Adding a PATH for a new application.

`PATH=$PATH:/var/opt/` - this will append the folder to a new env variable. Now we can add new scripts that we want to run here!

To make it apply to all of our login shells, we then go `export PATH`.

To keep it automatically when we start our system, we will need to edit our `.bash_profile` and adjust the path var.

Note: Interactive shells are ones that you can interact with.

#### ++++ ---- Variables: User Defined vars

`var=value`

So how do we create this?

```
awesome="dennis"
echo $awesome
```

To use this in other shells, again, we need to export the variable.

Variable names can container letters and numbers but cannot start with numbers.

#### ++++ ---- Globbing

Globbing is the process of expanding a non-specific file name using a wildcard variable.

Globbing - Global Command. Historically, it came from the /etc/glob program.

**Commands**

```
// find all .txt files
ls *.txt

// list files that start with test
ls test*

// replace the ? with an char
ls ????.txt

// find file based on something you know with the ? wildcard
ls Monday-file?.txt

// find files that begin with F
ls [F]*.txt

// specify letter you think might come one way or another
ls f[igh][lfz]*
```

#### ++++ ---- Quoting

*   Double quotes allow us to still use the value of variables and commands
*   Single quotes preserve the literaly meaning of each character of a given string
*   Backslash is an escape character

#### ++++ ---- Formatting Commands

We can use the backslash so that we can continue writing the command on the new line.

#### ++++ ---- Working with Options

The commands parameters can be roughly divided in parameters starting with a dash (_options_) and no dashes (_arguments_)

### ---- LINUX-2.2: Using the Command Line to Get Help

#### ++++ ---- Man

### ---- LINUX-2.3: Using Directories and Listing Files

#### ++++ ---- The Linux File System

### ---- LINUX-2.4: Creating, Moving and Deleting Files

#### ++++ ---- Files and Directories

---

## LINUX-3: The Power of the Command Line

<div id="3"></div>

### ---- LINUX-3.1: Archiving Files on the Command Line

### ++++ ---- Files, Directories

We can archive multiple files into a single file and then compress them.

We can use `Tar` to compress and `zip` which is generally for windows. `tar` is a Linux utility that archives things. It does not compress or compact files. It just sticks them together.

It was originally used to create tape backups. Tar stands for `Tape Archive`.

```
# inside of a folder that contains a folder with three files
# if we want to archive this folder
# tar -cf creates the file name.tar
# tar -xf extracts the file name.tar

tar -cf folder1tar.tar folder1

# this would archive folder1

tar -xf folder1tar.tar

# extracting this, we will have folder1 back

# tar multiple archive files at once
# ls
# file1.txt file2.txt file3.txt

tar -cf files.tar file1.txt file3.txt

# now we will have files.tar with those two files

tar -xf files.tar

# extracts those two files
```

---

## LINUX-5: The Linux Operating System

### ---- LINUX-5.3: Where Data is Stored

#### ++++ ---- LINUX-5.3.1: Kernel

The Linux Kernel is a Unix-like OS.

The Linux is the core of any Linux installation.

The Linux kernel is responsible for managing every other piece of software on a running Linux computer.

*   It is responsibile for all of the interfacing of all the applications down to hardware between the interprocess communication system.
*   Provides critical low level tasks.
*   Loaded very early on in the boot process.

We could change the program that runs as the first process by adding it to the boot loader option command line.

```
# run bash first after boot
init=/bin/bash
```

First program is the `sbininit` process. This will run programs as child processes for things such as login etc.

Processes can leave behind children process that will be adopted. It's a tree like Hierarchy of processes.

There could be dozens to hundreds of processes. The kernel is at the top. We can then use commands like `ps` and `top` to directly see and manipulate these processes.

---

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

---

#### ++++ ---- LINUX-5.3.3: syslog, klog, dmesg

Most background programs (daemon) write log files for being to show info about Linux Administration.

You can even tell these programs to log even more verbose message if you're looking for an issue.

Linux normally stores it in the `/var/log` directory.

We can see some interesting programs here.

*   `cron` is a linux scheduling service.
*   `syslog` (mailbox) is the general purpose log files.
*   `secure` log is here when something requires root privilege.

Most of the log files are easy to reading using things is `tail` and `less`.

If we use commands like `grep sshd /var/log/*` to actually look through all the log files!

Files in `/etc/sys` will show us some config files. This changes with each different Linux Distributions.

Once the log daemon is running, it will push messages towards a specific log file. The ring buffer is a log file for the kernel, which is stored on memory as opposed to a disk.

We can use `dmesg` tool! Instead, if we pipe it to `tail` or `less`, we can check out the dynamic log.

If there issues that you don't understand, you can still check this out and find answers through a search engine.

If we jump to `/etc/rc.d/rc.local` file, we can set up dmesg > /var/log/dmesg, we can start logging the dmesg file to this file on reboot.

---

#### ++++ ---- LINUX-5.3.4: /lib, /usr/lib, /etc, /var/log

**Data Locations**

*   `/lib` : Linked library files used by binaries in /bin and /usr/bin - Dynamic libraries and files used for the boot process. - Kernel modules also live here.
*   `/usr/lib` : Linked library files used by binaries in /bin and /usr/bin - Dynamic libraries and support static files for executables. - You can create your own helper files by creating more subdirectories here for things such as plugins and extensions.

These two folders are similar to Windows .dll - the binaries or executables on the Mac are store in the above folders.

*   `/etc` : Configuration files for our Linux OS

This stores things for our Configuration. Things like mySql, Apache etc are stored here. For different daemons on the program, they will have a subdirectory in the etc folder directory.

*   `/var/log` : Log files for our Linux OS

This is used for the log files from the different daemons which we can use for trouble shooting down the track.

---

#### ---- LINUX-5.4: Your Computer on the Network

#### ++++ ---- LINUX-5.3.1: Internet, Network, Routers
