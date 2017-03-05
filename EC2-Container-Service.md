# Amazon EC2 Container Services

**Goals**

1. Create a User and Look at Security Settings
2. Create a Role and Generate a Key Pair
3. Create a VPC for our Cluster 
4. Create a Security Group for our Cluster 
5. Install and Configure the AWS CLI

**Components and Usage**

- Clusters 
- Container instances (how to register too)
- The Agent
- Scheduling Tasks
- Repositories 
- IAM Policies and Roles

## 1.0: Container Architecture 

## 1.1: Amazon EC2 Introduction

Highly scalable and fast container management service. Easily can start, stop and manage containers on a cluster comprised of Amazon EC2 instances.

**What makes up the ECS?**

1. Clusters - the grouping of container instances that we 'do stuff' on.
2. Container instances - EC2 Instances running the ECS agent and registered in a cluster.
3. Task Definitions - Description of an application with one or more container definitions.
4. Scheduling - How we get our tasks on the container instances.
5. Servies - An ECS service allows us to run or maintain a number o instances of a task definition.
6. Tasks - an instance of a Task definition 
7. Containers - A Linux Container (Docker for example) created as part of a Task.

***

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















