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

***

## DOCKED-2: Setup and Config


***

## DOCKED-3: Components and Usage
