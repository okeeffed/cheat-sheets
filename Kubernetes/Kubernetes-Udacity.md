# Kubernetes Udacity Course

## Introduction to Microservices

Microservices helps the method for "always on" apps.

Distributed systems will be taught to add ontop of tools we may already use like Chef etc.

Order:

1. Understanding the basics
2. How to package and distribute apps
3. Running applications using a distributed platform that can scale

### The Evolution of Applications

Why was it designed this way?

Years ago, applications were huge and it would take hours just for a build. Typically you would release software infrequently.

Recently, the idea of microservices is to break down these large applications which allow for faster deployments.

The main reason for microservices is to speed up development. Breaking things down into microservices allow you have many releases or few releases.

If we think of a simple setup being done through things like Chef. Co-ordination of many things will need to compose them all together like a Docker compose or a kubernetes setup.

### Microservices

What does it mean? It's just an architectual approach. It's goes for:
- Modularity
- Scalability
- Ease of deployment

The design pattern applies to any application. It just refers to rapid deployments and continuous delivery. it pushes the automation tools to their limits.

### The app on Google Cloud

The app on the Gcloud console is a basic server which gives a JWT and allows you to use this to access a secure route.

### 12 factor apps

You can think of the 12 factors as quintessential to building an app that deals with `portability`, `deployability` and `scalability`.

The 12 factor manifesto can be found (here)[https://12factor.net/].

```
I. Codebase
One codebase tracked in revision control, many deploys

II. Dependencies
Explicitly declare and isolate dependencies

III. Config
Store config in the environment

IV. Backing services
Treat backing services as attached resources

V. Build, release, run
Strictly separate build and run stages

VI. Processes
Execute the app as one or more stateless processes

VII. Port binding
Export services via port binding

VIII. Concurrency
Scale out via the process model

IX. Disposability
Maximize robustness with fast startup and graceful shutdown

X. Dev/prod parity
Keep development, staging, and production as similar as possible

XI. Logs
Treat logs as event streams

XII. Admin processes
Run admin/management tasks as one-off processes
```

### Refactor to MSA

All the monolithic stuff we wish to break down into smaller systems.

Splitting up the application doubles the complexity. This complexity is what drives the use of management systems like Kubernetes.

The idea is that the MSA will deal with `tightly coupled components` and `maintenance`.

### JSON Web Tokens

JWTs (pronounced lie jot). Super useful and compact means to encode and decode. The fact that they can be signed is for things like auth.

Since they can be signed, you can ensure safety and that things are not being tampered with.

They work through a client/server relationship. The server knows a client cannot be trusted - it only wants to give something to someone they trust. As the client sends data, the server replies with a token. The client then stores the data and sends it along with the JWT.

So the server verifies the token and checks that it hasn't been tampered with.

## Lesson 2: Building the Containers with Docker

The packaging of things seems like a bunch of difficult work.

We use container images, as it is a packaging format that knows and has all of your dependencies.

Things like Docker make container service APIs nice and easy to run on your own servers.

### What is Docker?

Opensournce tool that builds container images with all the dependencies already installed on it. They startup and shutdown quickly and benef

## Lesson 3: Kubernetes

If you look at the history of large systems in the data center, you'd buy, depreciate them etc etc. What we want to do is essentially the "cow paddock" where we want to know that if the cattle goes, we still have milk.

If we think of this as herds of machines, containers come in nicely. We could use VMs, but that take plenty of setup and config time.
