# Kubernetes Udacity Course

<!-- TOC -->

*   [Kubernetes Udacity Course](#kubernetes-udacity-course)
    *   [Introduction to Microservices](#introduction-to-microservices)
        *   [The Evolution of Applications](#the-evolution-of-applications)
        *   [Microservices](#microservices)
        *   [The app on Google Cloud](#the-app-on-google-cloud)
        *   [12 factor apps](#12-factor-apps)
        *   [Refactor to MSA](#refactor-to-msa)
        *   [JSON Web Tokens](#json-web-tokens)
    *   [Lesson 2: Building the Containers with Docker](#lesson-2-building-the-containers-with-docker)
        *   [What is Docker?](#what-is-docker)
    *   [Lesson 3: Kubernetes](#lesson-3-kubernetes)
        *   [How to learn k8s](#how-to-learn-k8s)
        *   [Kubernetes Intro](#kubernetes-intro)
        *   [Pods](#pods)
        *   [Monitoring and Health Checks](#monitoring-and-health-checks)
        *   [App Config and Security Overview](#app-config-and-security-overview)
        *   [Create a service](#create-a-service)
        *   [Adding labels to pods](#adding-labels-to-pods)
    *   [Lesson 4: Deploying Microservices](#lesson-4-deploying-microservices)
        *   [Deployment](#deployment)

<!-- /TOC -->

## Introduction to Microservices

Microservices helps the method for "always on" apps.

Distributed systems will be taught to add ontop of tools we may already use like Chef etc.

Order:

1.  Understanding the basics
2.  How to package and distribute apps
3.  Running applications using a distributed platform that can scale

### The Evolution of Applications

Why was it designed this way?

Years ago, applications were huge and it would take hours just for a build. Typically you would release software infrequently.

Recently, the idea of microservices is to break down these large applications which allow for faster deployments.

The main reason for microservices is to speed up development. Breaking things down into microservices allow you have many releases or few releases.

If we think of a simple setup being done through things like Chef. Co-ordination of many things will need to compose them all together like a Docker compose or a kubernetes setup.

### Microservices

What does it mean? It's just an architectual approach. It's goes for:

*   Modularity
*   Scalability
*   Ease of deployment

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

`serverless` also comes from this idea of running a container from start to finish and shutting down again.

One of the problems that people come into is keeping older practises or organisations.

Because you also know a bunch of automation is required, logging etc becomes super important.

### How to learn k8s

Info overload, so many tools - what is the fastest way to become productive? The reply was Kubernetes. Kubernetes was an abstraction of containers that made sense.

So what is Kubernetes?

Packaging the containers is like 5% of the problem. We still need to deal with:

1.  App configuration
2.  Service discovery
3.  Managing updates
4.  Monitoring

While we build all those things on Docker, we're better off leveraging a platform to manage all that complexity for us.

Kubernetes provides a new set of abstractions and allow you to focus on the big picture. You can treat the cluster like a single, logical machine.

We can describe a set of applications with Kubernetes and let it do the hardwork.

### Kubernetes Intro

The easiest way to start is to use `kubectl`.

```
kubectl run nginx --image=nginx:1.10.0
kubectl get pods
kubectl export deployments nginx --port 80 --type LoadBalancer
kubectl get services
```

Kubernetes just creating a load balancer and exposed it to port 80.

### Pods

Pods are a logical application.

*   one of more containers eg. having an nginx and monolith containers
*   volumes that are data divs, they can be used by any containers in the pod - this allows the containers within the pod to communicate with each other.
*   there is also one IP per pod

**Creating Pods**

You can use a .yaml pod configuration file.

```
# files contain specs like containers, ports expose etc.
...
spec:
	containers:
		...
```

`kubectl describe pods monolith` commands like this will give you information for troubleshooting.

Pods by default are giving a private IP - use `kubectl port-forward <pod> 10080:80` to forward this on.

### Monitoring and Health Checks

`Readiness` checks will check if something is ready to be added to the load balancer.

On a node we have a Pod with an app and a Kubelet. Since the Kubelet is responsible for making sure that a pod is healthy, it will perform the live check.

If in the example, the app is dead, the Kubelet will restart the container and check again. If the response is then successful, then we are ready to roll.

### App Config and Security Overview

One problem is that people want to bake in their configs and put onto Docker. Don't do it. There are Configmaps and Secrets to deal with these problems.

Creating Secrets is an easy problem. We can use `kubectl create secret` - such as `kubectl create secret generic tls-certs --from-file=tls/`.

The Kubernets Master will then know the secret. Now we a pod is created, the secret is then also mounted onto the pod.

**Creating Secrets**

Before we can serve HTTPS we need a self-signed TLS cert. So give the certs that we have (in the .pem files) can be used to secure traffic on the monolith server with other keys to secure traffic. Another can be used by HTTP clients as a CA to trust.

Assuming the four `.pem` files (ca-key.pem, ca.pem, cert.pem, key.pem) are stored in a `./tls` folder we can run `kubectl create secret generic tls-certs --from-file=tls` to store the certs.

`kubectl` will create a key for each dile. We can use the `kubectl describe secrets tls-certs`.

We can also then create a `configmap` usin `kubectl create configmap nginx-proxy-conf --from-file nginx/proxy.conf`. Again, we can use `kubectl describe config map nginx-proxy-conf` to get more details about it after. At this point, we are ready to attach these things to the monolith pod.

In creating a .yaml file for configuration, you can add these certs and conf files we added as a secret and configmap using `volumeMounts` when decribing a container.

Something to note is that forwarding of `10080` and `10443` is not by accidenta and relates to http and https.

### Create a service

We create a Kubernetes service to expose things such as the logs. We can use `nodePort` to help forward on these new details. If we allow traffic to the expose tcp:31000 port, we should be able to hit it from outside the cluster.

### Adding labels to pods

Currently, the service does not have any in ports. `kubectl label pods secure-monolith "secure=enabled"` allows us to add labels and then we will be able to try hitting the exposed port.

## Lesson 4: Deploying Microservices

### Deployment

What we are interested in is production.

Deployments drive current state towards desired state.
