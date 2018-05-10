# Amazon EC2 Container Services

<!-- TOC -->

*   [Amazon EC2 Container Services](#amazon-ec2-container-services)
    *   [1.0: Container Architecture](#10-container-architecture)
    *   [1.1: Amazon EC2 Introduction](#11-amazon-ec2-introduction)
    *   [2.0: Creating an ECS User and Group](#20-creating-an-ecs-user-and-group)
    *   [2.1: Logging into the Console](#21-logging-into-the-console)
    *   [2.2: Create Instance Key-Pairs](#22-create-instance-key-pairs)
    *   [2.3: Create a Cluster Virtual Private Cloud](#23-create-a-cluster-virtual-private-cloud)
    *   [2.4: Security Groups and ECS Clusters](#24-security-groups-and-ecs-clusters)
    *   [2.5: Installing AWS CLI](#25-installing-aws-cli)
    *   [3.0: Using the Wizard for Sample Cluster Creation](#30-using-the-wizard-for-sample-cluster-creation)
    *   [3.1: Exploring the Sample Cluster](#31-exploring-the-sample-cluster)
    *   [3.2: Customizing the EC2 Cluster](#32-customizing-the-ec2-cluster)
    *   [3.3: Cluster Security Group Customization](#33-cluster-security-group-customization)
    *   [3.4: Container Instance Scaling](#34-container-instance-scaling)
    *   [3.5: ELB - Container Registration and Config](#35-elb---container-registration-and-config)
    *   [3.6: ECS - Creating a Custom Container](#36-ecs---creating-a-custom-container)
    *   [3.7: Creating a Custom Task Definition for our Containers in ECS](#37-creating-a-custom-task-definition-for-our-containers-in-ecs)
    *   [3.8: Running Multiple Container Types in the Cluster](#38-running-multiple-container-types-in-the-cluster)
    *   [4.0: Troubleshooting](#40-troubleshooting)

<!-- /TOC -->

**Goals**

1.  Create a User and Look at Security Settings
2.  Create a Role and Generate a Key Pair
3.  Create a VPC for our Cluster
4.  Create a Security Group for our Cluster
5.  Install and Configure the AWS CLI

**Components and Usage**

*   Clusters
*   Container instances (how to register too)
*   The Agent
*   Scheduling Tasks
*   Repositories
*   IAM Policies and Roles

## 1.0: Container Architecture

## 1.1: Amazon EC2 Introduction

Highly scalable and fast container management service. Easily can start, stop and manage containers on a cluster comprised of Amazon EC2 instances.

**What makes up the ECS?**

1.  Clusters - the grouping of container instances that we 'do stuff' on.
2.  Container instances - EC2 Instances running the ECS agent and registered in a cluster.
3.  Task Definitions - Description of an application with one or more container definitions.
4.  Scheduling - How we get our tasks on the container instances.
5.  Servies - An ECS service allows us to run or maintain a number of instances of a task definition.
6.  Tasks - an instance of a Task definition
7.  Containers - A Linux Container (Docker for example) created as part of a Task.

---

## 2.0: Creating an ECS User and Group

In the console, go to Identity and Access Management.

If you create the secret access key, make sure you download it and provide it for login.

Ensure that you also create a group for this that is specific to the EC2 Container service.

Normally we wouldn't recommend Admin access, but you want to assign a group security policy so future users added can get these group policies and we can manage it at a group level.

## 2.1: Logging into the Console

From the AWS IAM panel, we can just into the new `ecsadmin` group and now we can create some sign in passwords from `Security Credentials`.

Now with the alias link we have from the main dashboard, we can use that give other users a chance to log in.

It is very important that we want the alias used wherever possible instead of your account number.

Now, once the user signs in, they have a chance to see a new password.

**THIS IS HOW WE MAINTAIN THE SECURITY WITH GRANUAL PERSMISSIONS FOR OTHERS TO USE**

## 2.2: Create Instance Key-Pairs

Head to `EC2 Virtual Servers > Network and Security > Key Pairs` - you can import a key pair or create a key-pair. This is used to SSH in securely.

Create and save that file and store it somewhere securely.

If we use `ssh-agent bash`, that will launch a shell where we can run `ssh-add key-pair.pem` added to the key exchange, and now we can `ssh -i key-pair.pem ec2-user@ip.address.0.0` (ensure an instance is running).

```
ssh-agent bash
ssh-add key-pair.pem
ssh -i key-pair.pem ec2-user@ip.address.0.0
```

## 2.3: Create a Cluster Virtual Private Cloud

In the VPC section of AWS, in the list of VPCs you can see a list of the VPCs and there can be allocated a default if you haven't named one.

Create a VPC, give is a name tag, the CIDR block is the network range eg. `10.17.0.0/16` (16 is as large as we can make our VPC) and we can choose the VPC to be `Default` or `Dedicated`.

Once the instance config is up, we can choose `Actions > Edit DHCP Options` which will edit how those addresses/options are set. Currently the /16 address range will be `10.17.0.1` but the config will basically assign ranges between .2 and .253. We can change that range with `DHCP Options Set` if we want to.

DHCP means `Dynamic Host Configuration Protocol`.

We can also assign a DNS resolution if we didn't want them publicly available by name, we can say don't do it.

Now we can go back and apply a security group.

## 2.4: Security Groups and ECS Clusters

Back in the `EC2 > Network and Security > Security Groups`, we can now create a security group.

As you create this, you will give it a name and choose the VPC associated! This will be where we select the `ECS_VPC` we created.

As for the inbound and outbound rules, we add an inbound SSH rule for TCP, port 22, Anywhere which will allow in SSH connections.

As a second option, we choose HTTPS and a HTTP role as well.

For the `Outbound`, we want SSH to anywhere and HTTP and HTTPS as well. After configuring our services, we may want to choose a more restricive kind of traffic.

Again, from here, we can edit the inbound and outbound rules too.

We recommend that you only open up SSH to a few IP ranges.

## 2.5: Installing AWS CLI

`pip3 install awscli` which will give us access to using the command line.

`aws configure` allows us to put in our id and secret key, and commands such as `aws ec2 describe-regions` allow us to see available regions for instances.

---

## 3.0: Using the Wizard for Sample Cluster Creation

In the ECS Wizard, let's click `Get Started`.

This will deploy an EC2 Container Service in a particular region.

We want to add some information about `Tasks` which is how we get things to run on ECS.

Give the task a definition name `ecs-sample-web-app-static` as an example.

Container name we want to run could be `ecs-sample-web`.

Image is the image format we want to run.

The ports can be configured depending on what ports we have exposed on the security settings.

If we look at the advanved settings, we can look at environment, network settings etc.

We can also mount additional volumes external from the container.

---

On the next step, we can edit the Service name and we can also have a multiple number of tasks running.

We can also do elastic load balancing too.

These containers also run in a cluster. We can choose what instance type we want, and a number of instances.

Key-Pairs are also region specific and you'll need a new key-pair for another cluster in a different region.

We need to make sure `ecsinstanceRole` IAM policy is also currently allowed.

---

In the review, you will get an overview of what is being created and the cluster configuration.

If we now view this service in `Clusters`, it will show us our cluster and the current task that is running.

If we look at `Task Definition` we can use actions to do thingsl like run tasks.

## 3.1: Exploring the Sample Cluster

When we launched the cluster, we had 2 instances running EC2 instances.

If we now go to `EC2 > Instances`, we should be able to now see our running instances!

If we grab the IP, we can now use that pem file and AWS CLI. Again, run the `ssh-agent` and `ssh-add` etc.

At the IP itself, we can see that the website is now running, but the second instance isn't running the container... why? Because it is a cluster. Even though we have two INSTANCES running we only configured ONE service running ONE task with ONE task definition.

A lot of this is because we haven't set the ELB. Since we didn't add a ELB, we will only see the container on the first EC2 we launched.

What we can do for our security groups is edit the settings that need to be changed or deploy a cluster and do that manually.

## 3.2: Customizing the EC2 Cluster

In the previous lessons, we quickly went through the ECS Wizard.

Let's take a look at how we can set up a cluster with a basic web app.

If we head back to the EC2 container service, let's walk through how we can customize our cluster initially and can use it in a manner more enterprise ready.

**Task Definition**

*   give a solid name about least definition to a task definition
*   again, select the mappings etc that you want

Now, in the advaned options, we want to make some changes.

Handy inclusions will be our environment variables.

Now, when the host starts, the container will start this image.

In this case, we will also define a load balance on a particular port.

Since we still have a very restricive security group, we still cannot SSH in. Why is that? We can configure our security groups.

## 3.3: Cluster Security Group Customization

How can we connect using SSH even when we have a key pair already?

The reason we cannot, is that during the initial launch, we don't have a way to apply another security group to another instance.

So in the `EC2 > Instances`, we can view the Security Group being used as the source. If we click onto it, it will take us to the container security group.

Now if we look at the inbound and outbound rules!

There is a `ECSAllowedPorts` and the `ELBAllowedPorts`, and we are allow to enter one if we allowed in the ELB security group. Effectively, the ELB permissions are imported directly to the ECS allowed ports.

So we can in fact now add in the SSH IP that we want to use. As soon as we save, it immediately applies to our instance!

If we now run `ps aux | grep http` we can now see the shell script we have run to launch the container.

## 3.4: Container Instance Scaling

We have the ability in the EC2 instances live into our cluster.

In `ECS > Clusters > ECS Instance > Scale ECS Instances` we can choose what we are scaling. If will load it with reference to the ELB but it won't be auto setup.

If we head to `EC2 > Instances` is our new instane configured exactly the same way as the original one.

Once the EC2 is up, the container won't be showing up on the IP just yet. If we SSH into that address, we can see that it is running but no `http` service is running.

Head back to `ECS` and we can see in the clusters that we only have one running task.

Now, if we select `Clusters > Task`, we run a new task and choose our task definition. We still only need to run 1 task, since we just ran 1 additional instance. It's a 1-to-1 relationship.

Something that is cool, is that just because we are running a new task, we don't have to choose the same definition eg. like how we are running a database to support the cluster.

Once that task is running, if we now check that IP, we can now see the website is actually running.

## 3.5: ELB - Container Registration and Config

Now that we have two instances running, but the load balancer on has 1 of 1 instances.

What we have to do in `EC2 > Load Balancers > Status`, we click on it and edit the instances. The the ELB has already registered that there is another container instance (as you'll be able to see) so we click on it and then we select save.

Now we have multiple nodes, and the ELB will now use round robin to choose the node to use.

Load balancers do not currently store session state by default, which can be a trouble if you are running with round robin. You need to turn on Stickiness on the Port Configuration in order to keep sessions.

We can enabled `Load Balancer` generated cookies or appliation generated cookie stickiness. Application will look for a cookie you set.

Generally you just want 5 minutes or so or you could suffer from `affinity overload` if one server gets overloaded.

## 3.6: ECS - Creating a Custom Container

What we can do for loading containers is run from Docker Hub.

If you are going to use a propriatary system, use a private Docker Hub repo.

This example is given from AWS Labs.

The Dockerfile will be used to get a base image we want it built on and then we can declare variables that we want associated with it.

In this example, we will run `docker build -t username/name-of-repo` and it will work from the Dockerfile and line everything up.

After the build, it will now be another image we can run against.

`docker run -p 80:80 latest123/amazon-ecs-sample:latest`

We can run `docker ps` to ensure it is running and then we should be able to check localhost and see it all running.

`docker login` will sign us into our Docker account and the credentials will be saved.

Now if we `docker push`, we can push that image.

We can now see that our repo has been pushed up to the account.

## 3.7: Creating a Custom Task Definition for our Containers in ECS

With the repo available for a docker pull, what we can now do is create a new task definition that will apply to a running task definition.

**Creating the task definition**

*   Can be done by either console or CLI

Select `ECS > Task Definitions > Create a new definition`.

Example `console-task-def-latest-sampleweb`.

What we can do is now add a container! We can also do a configure via JSON.

How do we do that? We can add a `config.json` file that has all of the details.

In the example config that we paste in here from the AWSLabs example, we just need to change the Image that we wish to change.

Once we have created that task definition, we can head back to Clusters and see the task there.

## 3.8: Running Multiple Container Types in the Cluster

Now that the task definition is done, how can we use that in our cluster? As we've seen before, we can scale the cluster with the additional instances.

Before we can apply a task to, we need to scale the instances.

Once the new EC2 instance is up, we can again check that it isn't running if we check the Public IP.

Back in `ECS > Clusters > ECS Instances`, we have two tasks running and we can now run a new task.

One thing to notice is that the task definition list cannot be removed.

Once the task has run, get the IP that is provisioned and see if you can head to it - which you can!

---

## 4.0: Troubleshooting

*   Service Health is important to decide if it's with the cluster and not AWS.
*   Another option is to check events.
*   Check the instances, which also has deeper information
*   Check the Load Balancer have the in service status. - Health checks here can be configured.
*   We can check the cluster itself - Check primary service is `ACTIVE` - Check the instances and the tasks
