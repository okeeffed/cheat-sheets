# Docker and Elastic Beanstalk

<!-- TOC -->

*   [Docker and Elastic Beanstalk](#docker-and-elastic-beanstalk)
    *   [DOCKED-1: Introduction](#docked-1-introduction)
        *   [---- DOCKED-1.1: Syllabus](#-----docked-11-syllabus)
        *   [---- DOCKED-1.2: Container Discussion](#-----docked-12-container-discussion)
        *   [---- DOCKED-1.3: Container Architecture](#-----docked-13-container-architecture)
        *   [---- DOCKED-1.4: Introduction to Docker](#-----docked-14-introduction-to-docker)
        *   [---- DOCKED-1.5: Introduction to Elastic Beanstalk](#-----docked-15-introduction-to-elastic-beanstalk)
    *   [DOCKED-2: Setup and Config](#docked-2-setup-and-config)
        *   [---- DOCKED-2.1: Install and Configure](#-----docked-21-install-and-configure)
        *   [---- DOCKED-2.2: Docker Command Line Basics](#-----docked-22-docker-command-line-basics)
        *   [---- DOCKED-2.3: Installing AWS CLI and EB CLI Tools](#-----docked-23-installing-aws-cli-and-eb-cli-tools)
        *   [---- DOCKED-2.4: Elastic Beanstalk Accounts and Groups](#-----docked-24-elastic-beanstalk-accounts-and-groups)
    *   [DOCKED-3: Components and Usage](#docked-3-components-and-usage)
        *   [---- DOCKED-3.1: The First App Using the EB Wizard](#-----docked-31-the-first-app-using-the-eb-wizard)

<!-- /TOC -->

## DOCKED-1: Introduction

### ---- DOCKED-1.1: Syllabus

*   What is Elastic Beanstalk?
*   What is a container?
*   Container Architecture
*   Introduction to Docker

Docker itself is a wrapper around containers.

It has managed to get containers to a point where it is reusable and consistent.

We'll also...

*   Install and configure Docker
*   The Docker Hub
*   Install the AWS CLI and EB CLI
*   Create an account and assign privileges
*   Configure the EB CLI
*   Verify the EB CLI

**Components and Usage**

*   Managing applications
*   Configure and Manage the Environment
*   Monitoring
*   AWS Integration
*   The Local Development Environment
*   Deploying with Docker

### ---- DOCKED-1.2: Container Discussion

**What is a container?**

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

**Docker Main Components**

*   Daemon
*   Client
*   Docker io registery - local and remote (Docker Hub)

The container architecture is generic - nothing itself is related to Docker specifically. The Docker engine is not necessarily unique itself.

You only need disk and CPU appropriate to the application and its libraries and binaries.

**Containers vs VMs**

_VM_

App A App A' App B
| | |
| | |
Bins/libs Bins/libs Bins/libs
| | |
Guest OS Guest OS Guest OS
| | |
| | |
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

**Summary**

The architecture of Docker and the containers that it relies on are not new concepts, having been around since the early part of this century. However, hardware virtualization performance has now become almost indistinguishable from bare metal so that further virtualization on the technology stack can be realized.

### ---- DOCKED-1.4: Introduction to Docker

Now that we know what containers are, let's focus more on Docker.

It's a tool that packages up an application and its dependencies in a "virtual container" so that it can be run on any Linux system or distribution.

To run it on Windows/OSX, you need a lightweight VM like Vagrant.

For Docker, you will build an instance of an OS container. You can then distribute that system on anything that runs on a Linux kernel.

**Why Docker?**

*   Configuration Simplification
*   Enhance Developer Productivity
*   Server Consolidation and management
*   Application isolation
*   Rapid Deployment
*   Build Management

You no longer have to worry about translating or re-compiling. You just have it run on that container on top of the OS.

If you deploy this as just one image, and if there are any issues, you just take it off and deploy another.

Build management therefore becomes easy.

**Summary**

Isolate applications, standardize the build and deployment process.

### ---- DOCKED-1.5: Introduction to Elastic Beanstalk

What is it? It's a service that allows the quick deployment and easy deployment of applications without getting bogged down with the infrastructure details.

What is EBs workflow.

Create Application
|
|
Upload Version <-----
| |
| |
Launch Environment |
| |
| |
Manage Environment <-

It helps us automatically look after all of our AWS resources.

Once an app is deployed, you get info about it. The app can be configured to use persistent storage etc or databases services or as part of another container.

One of the best parts of it is, there are no additional charges for EB services. It simply uses other parts of the AWS resources and it is that which you pay for.

Amazon has put a lot of emphasis on containers - especially with the wide adoption of Docker.

---

## DOCKED-2: Setup and Config

### ---- DOCKED-2.1: Install and Configure

Installing onto Ubuntu

```shell
# to search for results
sudo apt-cache search dock

# to download
sudo apt-get install docker.io

# to check status
sudo service docker status

# to find the docker.sock
ls -al var run

# to add test user to the /etc group
sudo usermod -a -G docker test

#logout and log back in
su - test

# hopefully this should work now - on Ubuntu, it creates the c group and docker groups and then ensure the file is owned by the docker group
# we just have to run the usermod to add the users to the group
docker images
```

This will be all we need on the Ubuntu system installation for this course's purposes. Alternatively, check the `Docker Deep Dive` for more info.

### ---- DOCKED-2.2: Docker Command Line Basics

Docker is getting ready for Docker 2.0, however we are running 1.12.0 at the time of writing.

`docker images` shows us the base images in our local repository that we can instantiate containers from. The image is a fully inclusive list of what is in the container.

Everything is contained in the snapshots that can be committed to other images. Easier to see in action.

To pull down latest copy of CentOS from as an example from with Ubuntu.

```
docker pull centos:latest
```

We can also search through the Docker hub to check out what we can pull in.

The image from a container stand point is what we need for the container to run. That will be why things like centos will be so small size compared to expectation.

How do I create an instance from it?

This below will open up centos in the terminal running running a bash script

```
# -i interactive, -t terminal
docker run -it centos:latest /bin/bash
```

**hint:** `docker ps` will show you docker processes.

When you actually within the container, you can start installing things and it runs it separately to your computer... It's running within the container!

`exit` will stop the container if we run it from the process.

To see previous run containers, we can use `docker ps -a`

Another way to stop it from outside the container

```
docker stop [name]
```

You can also start, but it will start the process and not auto log you in. If you know the name you can log in using `docker attach high_brattain`

If you run the centos version again, it will start the image WITHOUT the installs, but we can create a new image from this!

`docker commit high_brattain mylynx:centos`

It will now take the container ID it gives back, and it will create a new image from this!

Now we can `docker run -it mylynx:centos /bin/bash`

To remove images:

```
docker rmi mylynx:centos
```

If this image is required by others, it won't allow you to delete.

`rmi` - remove image, `rm` - remove container.

Once the dependent containers are gone, you can remove the images.

### ---- DOCKED-2.3: Installing AWS CLI and EB CLI Tools

Before we can start deploying, we need to set up the command line interfaces for AWS and EB.

You need pip (Python package service) in order to have AWS CLI run.

`which pip` to ensure things are installed.

`sudo pip install awscli` to install AWS.

`sudo pip install awsebcli` to install EB.

For Mac, `brew install`.

### ---- DOCKED-2.4: Elastic Beanstalk Accounts and Groups

We need to now create a security group associated with beanstalk. We can do this from the AWS console using IAM.

From an enterprise perspective, ensure that you aren't installing using root. Ensure you set the alias and create a user. In this case, it's probably more important to create a role. Give `administrator access` for this role.

---

## DOCKED-3: Components and Usage

### ---- DOCKED-3.1: The First App Using the EB Wizard

It will launch EC2, ELBs etc and can take up to 5-10 minutes to launch a full environment.

In the console under Elastic Beanstalk, you will select Docker.

This will deploy a sample application.
