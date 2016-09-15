# Docker and Elastic Beanstalk

## DOCKED-1: Introduction

### ---- DOCKED-1.1: Syllabus

- What is Elastic Beanstalk?
- What is a container?
- Container Architecture
- Introduction to Docker

Docker itself is a wrapper around containers.

It has managed to get containers to a point where it is reusable and consistent.

We'll also...

- Install and configure Docker
- The Docker Hub
- Install the AWS CLI and EB CLI
- Create an account and assign privileges
- Configure the EB CLI
- Verify the EB CLI

__Components and Usage__

- Managing applications
- Configure and Manage the Environment
- Monitoring
- AWS Integration
- The Local Development Environment
- Deploying with Docker

### ---- DOCKED-1.2: Container Discussion

__What is a container?__

What is a virtual machine? A virtual machine is an emulation of a specific computer system type. They operate based on the architecture and functions of that real computer.

The VM has to emulate the instruction of the machine that it is trying to support. There is a Hypervisor that sits between the hardware and the virtual machine. It handles the communication.

So what is a container? It's an entirely isolated set of packages, libraries and applications that are completely separate from it's environment. Think of a lunch container on the table. What is the environment? How are they related? The container simply uses the table.

Virtualization has become more granular that are virtual servers that are heavy on system requirements since they require the memory, CPU etc of a full OS.

Containers are far more light weight. They used shared OS and the container only contains enough in it for the application to run and then relies on the OS hosting it for the rest of the hardware accessibility. This does mean that containers are essentially limited to Linux (at this time of writing).

While differences may seem suttle, you'll see the many differences between them throughout this article.

### ---- DOCKED-1.3: Container Architecture

How does Container Architecture relate to Docker? Docker and container are used synonymously, however they have been around far longer. Remember, Docker is a wrapper to how we use containers.

Docker is a client/server application where both the daemon and the client can be run on the same system. You can have them split, but less usually.

Docker clients and daemons communicate via sockets or through a RESTful API (xml file that has details for it).

__Docker Main Components__

- Daemon
- Client
- Docker io registery - local and remote (Docker Hub)

The container architecture is generic - nothing itself is related to Docker specifically. The Docker engine is not necessarily unique itself.

You only need disk and CPU appropriate to the application and its libraries and binaries.

__Containers vs VMs__

_VM_

App A		App A'		App B
|			|			|
|			|			|
Bins/libs 	Bins/libs 	Bins/libs  		
|			|			|
Guest OS	Guest OS	Guest OS
|			|			|
|			|			|
<--Hypervisor (type 2)-->
|
|
<--------Host OS-------->
|
|
<---------Server-------->

_Container_

Not separation between in the above image. Containers are isolated, but share OS (no guest OS) and where appropriate, share the bins/libs. Docker Engine replaces Hypervisor in that set up also.

Containers do not virtualize hardware. They rest on top of a single Linux instance. This allows Docker (or generic LXC) to leave behind a lot of the bloat associated with a full hardware hypervisor.

Don't mistake the Docker Engine (or the LXC process) as the equivalent of a hypervisor. It is simply the encapsulating process on the underlying system. It's a process, not a full blown hypervisor and does not have the overhead. Has this already been done? Yes, containers are not new in technology. Docker has made the most of it. It's also very similar to git in it's command line and config set up. Other examples as were Jails, Zones, LMCTFY, OpenVZ etc.

Well, for VMs, do we need the guest OS? Depends on the architecture you are trying to run. For the containers, we have this lightweight Docker engine to help the communication between the app and the Host OS. We no longer have to do it through a guest OS.

__Summary__

The architecture of Docker and the containers that it relies on are not new concepts, having been around since the early part of this century. However, hardware virtualization performance has now become almost indistinguishable from bare metal so that further virtualization on the technology stack can be realized.

***

## DOCKED-2: Setup and Config


***

## DOCKED-3: Components and Usage
