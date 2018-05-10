# DevOps-Essentials

<!-- TOC -->

*   [DevOps-Essentials](#devops-essentials)
    *   [1.0 Traditional Responsibility Silos](#10-traditional-responsibility-silos)
*   [Terminology](#terminology)
    *   [2.0: IaaS - Infrastructure as a Service](#20-iaas---infrastructure-as-a-service)
    *   [2.1: PaaS - Platform as a Service](#21-paas---platform-as-a-service)
    *   [2.2: SaaS - Software as a Service](#22-saas---software-as-a-service)
    *   [3.0: Build Automation](#30-build-automation)
    *   [3.1: CI and CD](#31-ci-and-cd)
    *   [4.0: Jenkins](#40-jenkins)

<!-- /TOC -->

**What is DevOps?**

A software development method that stresses communication, collaboration, integration, automation and a measurement of cooperation between software devs and other IT professionals.

It acknowledges the interdependence of software dev, quality assure and IT operations.

You'll hear things like CI, build automation and treating the infrastructure like code.

It addresses short comings and obstacles that we come across in our careers.

## 1.0 Traditional Responsibility Silos

IT Operations are usually broken into the following:

1.  Infrastructure and Monitoring
2.  Architecture and Planning
3.  Maintenence
4.  Support

This is the traditional operations stack.

IT Dev is broken down into methodologies like the following:

1.  Prototyping
2.  Waterfall
3.  Agile
4.  Rapid

Hardware and networking were not necessarily well understood by skilled software developers and vice versa.

# Terminology

## 2.0: IaaS - Infrastructure as a Service

*   Setting up a service for using IT Infrastructure
*   "Stack" involved includes things from hardware to the operating system and applications that sit on top.
*   Virtualisation is almost indistinguishable in speed when compared to standard infrastructure is

## 2.1: PaaS - Platform as a Service

Further down the rabbit hole! Next step in the redefinition of IT was looking at how the platform was provided.

This delivers a "computer platform" for consumption. It generally includes all of IaaS + a few additions.

In addition to before, this also addings in `runtime` and `middleware`. Services like `Azure` and `App Engine` were some of the first to offer the underlying computer and storage resources that could scale automatically to match application demand so manual allocation of resources was no longer necessary.

It converged developer and operations skillsets even more.

## 2.2: SaaS - Software as a Service

Skills needed in this area has completely converged.

It is an important driving force behind DevOps. A ton of autoscaling code was written to deal with this.

Here, we need traditional software AND hardware personnel that need the same skills to operate within this space.

---

## 3.0: Build Automation

Historically, this referred to software development. The process of "building" or compiling software that can then be deployed via script or cron jobs to various environments, including production systems.

It is about minimizing the deployment without manual intervention.

Generally the entire stack will look like the flow from top to bottom:

```
Dev Environment
|
Source Repo
|
Build Server
|
Integration Server
|
Test Server
|
Production Server
```

It includes automated testing and rollback capabilities. This build is consistent and can reduce the troubleshooting when there are problems as a result.

## 3.1: CI and CD

*   CI means the practise of mergine dev working copies with the shared source main branch multiple times per day.
*   CD is an approach where valuable software is produced in small delivery cycles and ensures that those features can be reliably and consistenly released at any point in time.

CI has more to do with how the software code is managed throughout the development lifecycle, whereas CD is how valuable and how quickly that software can be released when it is determined that the aggregate features are valuable enough.

Although related, they are different in what they accomplish.

DevOps uses each one and in term feeds the other in the chain.

---

## 4.0: Jenkins

Jenkins is build automation on steroids. It can be considered a CI but often considered a CD tool as well.

Used normally for build deployments, but can do anything from deploying scripts to launching virtual machines through VMWare or Vagrant to Docker.

It helps create a basic build job to the custom direction of containers with unit testing etc.
