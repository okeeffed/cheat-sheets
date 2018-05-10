# AWS Certified SysOps Administrator

<!-- TOC -->

*   [AWS Certified SysOps Administrator](#aws-certified-sysops-administrator)
    *   [AWSSYS-1: Monitoring, Metrics and Analysis](#awssys-1-monitoring-metrics-and-analysis)
        *   [---- AWSSYS-1.1: CloudWatch Intro](#-----awssys-11-cloudwatch-intro)
        *   [---- AWSSYS-1.2: EC2 Status Troubleshooting](#-----awssys-12-ec2-status-troubleshooting)
    *   [AWSSYS-5: Opsworks](#awssys-5-opsworks)
        *   [---- AWSSYS-5.1: Opsworks Overview](#-----awssys-51-opsworks-overview)
        *   [---- AWSSYS-5.2: Setting up Opsworks](#-----awssys-52-setting-up-opsworks)

<!-- /TOC -->

## AWSSYS-1: Monitoring, Metrics and Analysis

### ---- AWSSYS-1.1: CloudWatch Intro

It's a monitoring service to monitor the resources and what you run on AWS.

*   EC2
*   DynamoDB
*   RDS DB instances etc
*   Log files

**Host Level metrics**

1.  CPU
2.  Network
3.  Disk
4.  Status Check

RAM utilisation is a custom metric. You need to write Perl script for this.

By default, monitoring is 5 minutes. Detailed monitoring is 1 minute.

**How long are metrics stored?**

By default, for 2 weeks. You can use the `GetMetricsStatistics API` or third party tools to have access to data for longer.

You can retrieve data on terminated ELBs or instances for up to 2 weeks after it's termination.

**Metric Granularity**

Many default metrics are 1 minute, but it can be 3 or 5 too. The minimum that you can have it 1 minute.

**Alarms**

You can use this to monitor any metric. You can even use it for something like bills etc too.

You can also set the appropriate action and thresholds.

### ---- AWSSYS-1.2: EC2 Status Troubleshooting

On the console, you can see the status check from the EC2 panel.

There is a `System Status Check` or `Instance Status Check`.

**What is the difference?**

*   System = physical host (the actual physical machine)
*   Instance = VM itself

Difference troubleshooting for the different status checks.

**System status checks**

It will come up as an error if you have:

1.  Loss of network connectivity
2.  Loss of system power
3.  Software issues on the physical host
4.  Hardware issues on the physical host
5.  Best way to resolve issues is to stop and then start the VM again

**Instance status checks**

1.  Failed system status checks
2.  Exhausted memory
3.  Misconfigured networking or startup configuration
4.  Exhausted memory
5.  Corrupted file system
6.  Incompatible kernel
7.  Best way to trouble shoot is by `rebooting the instance` or by making modifications in your operating system

---

## AWSSYS-5: Opsworks

### ---- AWSSYS-5.1: Opsworks Overview

All these groups of related resources are known as a stack.

A stack could be like a Route53 pointing to a load balancer that points to EC2 instances which all point to a DB server.

**Amazon Definition**

An app management service that helps you automate operational tasks using Chef. It gives you the flexibility to define the application architecture.

**Layman Definition**

Chef turns infrastructure into code. You can automate how you build, deploy and manage your infrastructure. Chef server stores all the recipes and the nodes will periodically polls Chef server to bring everything up to date.

OpsWorks is a GUI to deploy and configure your infrastructure quickly. It consists of Stacks and Layers.

A stack is a container (or group) of resources. A layer exists within a stack. When you create a layer, you use OpsWorks to configure that layer for you.

**Layers**

*   1 or more layers in a stack
*   An instance must be assigned to at least 1 layer
*   Which chef layers run are determined by the layer the instance belongs to
*   Preconfigured Layers include: - Applications - Databases - Load Balancers - Caching

### ---- AWSSYS-5.2: Setting up Opsworks

From the AWS dashboard, we're going to create a stack and bring up a webpage without having to SSH.

Jump onto OpsWorks and add a stack. We can choose things like whether or not we want SSH access etc.

After creating a stack, we will be brought back to the main screen. Now, let's create some layers!

**Layers**

We can choose our types! We'll select PHP App Server for now. From here, you can add an instance.

When adding, you can use existing OpsWorks to see how everything looks and use existing EC2 instances etc.

Then you can select to start the instance and go from there.

**Apps**

In the apps section, set up a new app! You need to select the application source (eg git etc) and go from there.

Once the app is live, we will push the app out to the instance.

We can then click deploy and let the app deploy.

Once it has been deployed, you can then see the app running in the browser.

**Deleting**

To teardown the stack, you need to stop the instance and apps first and then remove things like the layers from there.

Also note, you also need to delete all of the security groups after and do it all manually (in the update, you can now do it by selecting the entire security group.)

---
