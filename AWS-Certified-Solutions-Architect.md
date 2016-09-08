# Certified Solutions Architect - Associate 2016

## AWSCSA-1: Introduction Amazon

- Fastest growing cloud computing platform on the planet
- Also the largest
- More and more organisations are outsourcing their IT to AWS
- Certifications started in 2013

__How the exams fit together__

1. The Associate Tier
- Certified Solutions Architect Associate
- Certified Developer Associate
- Certified Sysops Administrator Associate

2. Professional Tier
- CSA Professional
- Sysops Pro

[Acloud Guru](https://acloud.guru)

## AWSCSA-2: Exam Blueprint and what you'll need

__The Exam__

__60%__ Designing highly available, cost efficient, fault tolerant, scaleable systems
__10%__ Implementing/Deploying
__20%__ Data Security
__10%__ Troubleshooting

80 minutes in length
60 questions

All Multiple Choice
Pass mark is on a bell curve

Qualification is valid for two years

__What you need__

1. An account - [An AWS Free Tier Account](https://aws.amazon.com/free/)
2. A computer with a SSH terminal
3. A domain name (optional)

## AWSCSA-3: 10,000 Foot Overview

Each of the AWS Components

Tier 1: AWS Global Infrastructure
Tier 2: Networking
Tier 3: Compute, Storage, Databases
Tier 4: Analytics, Security and ID, Management Tools
Tier 5: App Services, Dev Tools, Mobile Services
Tier 6: Enterprise Applications. Internet of things

There are a number of different regions spread across the world for AWS.

What's a region? Geographical area.

Each have two availability zones. These are data centers.

What are edge locations? CDN locations for CloudFront. CloudFront is AWS CDN service. Currently over 50 edge locations.

__Networking__

VPC: Virtual Private Cloud - A virtual data center. You can have multiple VPCs. Basically a data center in your AWS account. Isolated set of resources.

Direct Connect - A way of connecting into AWS without an internet connection.

Route53 - Amazons DNS service. 53 because of the port that the service sits on.

__Compute__

EC2: Elastic Cloud 2 - A virtual server you can provision fast.

EC2 Container Service - Sometimes ECS. A highly scalable service for Docker.

Elastic Beanstalk - Easy to use service for deploying and scalable web services that have been developed with Java, .NET, Node, PHP, JS, Go, Docker and more. It is designed for developers to upload code and have AWS provision services. It is essentially AWS for beginners.

Lambda - By far the most powerful service. Let's you run code without provisioning or managing servers. You only pay for the compute time. You pay for execution time.

__Storage__

S3 - Object Based Storage as a place to store your flat files in the cloud. It is secure, scalable and durable. You pay for the storage amount.

CloudFront - AWS CDN service. It integrates with other applications. It is an edge location for cacheing files.

Glacier - Low cost storage for long term storage and back up. Up to 4 hours to access it. Think of it as an archiving service.

EFS - Elastic File Storage - used for EC2. NAS for the cloud. Connects up to multiple EC2 instanges. Block level. It is still in preview, and not currently in exams.

Snowball - Import/Export service. It allows you to send in your own hard disks and they will load the data onto the platform using their own internal network. Amazon give you the device and you pay for it daily.

Storage Gateway - The service connecting on-premise storage. Essentially a little VM you run in your office or data centers and replicates AWS.

__Databases__

RDS: Relational Database Services - Plenty of well known platforms.

DynamoDB - NoSQL Database Storage. Comes up a lot in the dev exam.

Elasticache - A way of cacheing the databases in the cloud.

Redshift - Amazon's data warehousing service. Extremely good performance.

DMS: Database Migration Services - Essentially a way of migrating DB into AWS. You can even convert DBs.

__Analytics__

EMR: Elastic Map Reduce - This can come up in the exam. It's a way of processing big data.

Data Pipeline - Moving data from one service to another. Required for pro.

Elastic Search: A managed service that makes it easy to deploy, operate and scale Elastic Search in the AWS cloud. A popular search and analytics option.

Kinesis - Streaming data on AWS. This is a way of collecting, storing and processing large flows of data.

Machine Learning - Service that makes it easy for devs to use machine learning. Amazon use it for things like products you might be interested in etc.

Quick Sight - A new service. It's a business intelligence service. Fast cloud-powered service.

__Security and Identity__

IAM: Identity Access Management - Where you can control your users, groups, roles etc. - multifactor auth etc etc

Directory Service - required to know

Inspector - allows you to install agents onto your EC2 instances. It searches for weaknesses.

WAF: Web App Firewall service - Recent product.

Cloud HSM (Hardware Security Module) - Comes up in the professional exam.

KMS: Key Management Service - Comes up lightly.

__Management Tools__

Cloud Watch - Different metrics you can create

Cloud Formation - Deploying a Wordpress Site. Does an amazing amount of autonomous work for you.

Cloud Trail - A way of providing audit access to what people are doing on the platform. Eg. changes to EC2 instances etc.

OpsWorks - Configuration Management service using Chef. We will create our own OpsWork Stack.

Config - Relatively new service. Fully managed service with a AWS history and change notifications for security and governance etc. Auto checks the configuration of services. Eg. ensure all encrypted services attached to EC2 etc.

Service Catalog - Manage service catalogs approved by AWS.

Trusted Advisor - Does come up in the exam. Automated service that scans the environment and gives way you can be more secure and save money.

__Application Services__

API Gateway - A way to monitor APIs.

AppStream - AWS version of ZenApp. Stream Windows apps from the cloud.

CloudSearch - Managed service on the cloud that makes it manageable for a scale solution and supports multiple languages etc.

Elastic Transcoder - A media transcoding service in the cloud. A way to convert media into a format that will play on varying devices.

SES: Simple Email Service - Transactional emails, marketing messages etc. Also can be used to received emails that can be integrated.

SQS - Decoupling the infrastructure. First service ever launched.

SWF: Simple Workflow Services - Think of when you place an order on AWS, they use SWF so that people in the warehouse can start the process of collecting and sending packages.

__Developer Tools__

CodeCommit - Host secure private .git repositories
CodeDeploy - A service that deploys code to any instance
CodePipeline - Continuous Delivery Services for fast updates. Based on code modes you define.

__Mobile Services__

Mobile Hub - Building, testing and running use of phone apps.

Cognito - Save User preference data.

Device Farm - Improve the quality of apps tested against real phones.

Mobile analytics - Manage app usage etc.

SNS: Simple Notification Service - Big topic in the exam. Sending notifications from the cloud. You use it all the time in production.

__Enterprise Apps__

Workspaces - Virtual Desktop in the Cloud

WorkDocs - Fully managed enterprise equivalent to Dropbox etc. (safe and secure)

WorkMail - Amazon's answer to Exchange. Their email service.

__Internet of Things__

Internet of things - A new service that may become the most important.

***

## AWSCSA-4: Identity Access Management (IAM)

__IAM 101__

It's the best place to start with AWS.

It allows you to manage users and their level of access to the AWS Console. It is important to understand IAM and how it works, both for the exam and for administrating a companies AWS account in real life.

What does IAM give you?

- Centralised control of your AWS account
- Shared Access to your AWS account
- Granular permissions
- Identity Federation (including FB, LinkedIn etc)
- Multifactor Auth
- Provide temporary access for users/devices and services where necessary
- Allows you to set up your own password rotation policy
- Integrates with many AWS service
- Supports PCI DSS Compliance

__Critical Terms__

1. User - End Users (people)
2. Group - A collection of users under one set of permissions
3. Roles - You create roles and can then assign them to AWS resources
4. Policies - document that defines permissions. Attach these to the above.

## AWSCSA-5: IAM - Identity Access Management Crash Course

Log into IAM.

You'll find the IAM users sign-in link near the top.

- You can customize this sign-in link instead of the number

Go through the Security Status and tick off all the boxes!

__Activate MFA on your root account__

- you can add multifactor auth to secure your root account.
- select the appropriate device

__Create individual IAM users__

- Currently we'll be logged in as the root account
- Manage and create the user
- The keys given are for the command line or API interaction. Download and store.
- Add a password.
- By default, users have no permissions.
- You can use policies to give permissions. Policies in JSON. Attach them to a user.
- Instead, you can create a group with these policies. Afterwards, you can attach users to the group.

__Apply an IAM password policy__

Manage the password policy.

__Configuring a Role__

It'll make sense when you start using EC2. It's about having resources access other resources in AWS.

Create a role.

_Different Types of Roles_

We'll choose Amazon EC2 for our role. Select S3 full access as your policy for now.

## AWSCSA-6: S3 Crash Course

S3 provides developer and IT teams with secure, durable, highly-scalable object storage.

It's easy to use, has a simple web services interface to store and retrieve any amount of data from anywhere on the web. Think of a hard drive on the web.

- Data is stored across multiple devices and facilities. It's built for failure.
- Not a place for databases etc. you need block storage for that.
- Files from 1 byte to 5TB. You can store up to the petabyte if you wanted to.
- Files are stored in buckets - like the directories.
- When you create a bucket, you are reserving that name.
- Read after Write consistency for PUTS of new objects
- Eventual Consistency for overwrite PUTS and DELETES (can take some time to propagate)

__S3 is a key, value store__

- You have your "key" - the name of the object
- You have your value - simply the data and is made up of a sequence of bytes
- You have the version ID (important for versioning)
- Metadata (data about the data)
- Subresources
- Access Control Lists

__The basics__

- It guarantees 99.99% availability.
- 11 9's durability for S3 info.
- Tiered Storage available
- Lifecycle Management
- Versioning
- Encryption
- Secure through access control lists and bucket policies

__S3 Storage Tiers/Classes__

1. S3 - Normal
2. S3 IA (Infrequently Accessed) - retrieval fee
3. RRS - Reduced Redundancy Storage. Great for objects that can be lost.
4. Glacier - Very cheap, but 3-5 hours to restore from Glacier! As low $0.01 per gigabytes per month

S3 is charged for the amount of storage, the number of requests and data transfer pricing.

Not a place to upload an OS or a database.

***

#### ---- AWSCSA-6.1: Create an S3 Bucket

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/aws-s3-bucket-properties.png" />

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/aws-s3-inside-bucket.png" />

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/aws-s3-cross-region.png" />

From the Console, select `S3`

Again, think of the bucket as a "folder".

If it is the first time accessing it, you will be greeted with a screen that simply allows you to create a bucket.

Top right hand side gives you options for what the side bar view is.

Under properties, you can change things such as Permissions, Static Website Hosting etc.

- For the Static Websites, you don't have to worry about load balances etc.
	- You can't server-side scripts on these websites eg. php etc.
- Logging can be used to keep a log
- Events are about triggering something on a given action eg. notifications etc.
- You can allow versioning
- Cross-Region Replication can be done for other regions

If you click on a bucket, you can see details of what is there. By default, permissions are set that access is denied.

You can set the Storage class and Server-Side Encryption from here too.

__Allowing public read of the bucket__

```
{
	"Version": "2008-09-17",
	"Statement": [
		{
			"Sid": "AllowPublicRead",
			"Effect": "Allow",
			"Principal": {
				"AWS": "*"
			},
			"Action": "s3:GetObject",
			"Resource": "arn:aws:s3:::dok-basics/*"
		}
	]
}
```

#### ---- AWSCSA-6.2: S3 Version Control

If you turn Versioning on for the bucket, you can only suspend it you. You cannot turn it off. Click it and you can set the versions.

To add files, you can go and select "Actions" and select upload.

If you show the Versions, it will give you the version ID.

If you delete the file, it will show you the file and the delete markers. You can restore the file by selecting the delete marker and selecting actions and delete.

Bear in mind, if you do versioning, you will have copies of the same file.

__Cross-Region Replication__

To enable this, go to your properties. You will need to `Enable Versioning` for this to be enabled.

In order for this to happen, you also need to Create/Select IAM Roles for policies etc.

Existing Objects will not be replicated, only uploads from then on.

Amazon handle all the secure transfers of the data for you.

Versioning integrates with Lifecycle rules. You can turn on MFA so that it requires an auth code to delete.

***

## AWSCSA-7: CloudFront

It's important to understand the key fundamentals.

**_A CDN is a system of distributed servers (network) that deliver webpages and other web content to a user based on the geographic locations of the user, the origin of the webpage and a content delivery server._**

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/cf-dashboard.png" />

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/cf-settings.png" />


__Key Terms__

_Edge Location:_ The location where content will be cached. This is separate to a AWS Region/Avail Zone.

_Origin:_ This is the origin of all the files that the CDN will distribute. This can be a S3 bucket, EC2, Route53, Elastic Load Balancer etc. that comes from the source region.

_Distribution:_ This is the name given to the CDN which consists of a collection of Edge Locations.

_TTL (Time to Live):_ TTL is the time that is remains cached at this CDN. This cacheing will make is more useful for other users.

_Web Distribution:_ Typically used for Websites.

_RTMP:_ Used for Media Streaming.

__Summary__

__*Amazon CloudFront can be used to deliver your entire website, including dynamic, static, streaming and interactive content using a global network of edge locations. Requests for your content are automatically routed to the nearest edge location, so content is delivered with the best possible performance.

CloudFront is optimized to work with other AWS. CloudFront also works seamlessly with any non-AWS origin server, which stores the original, definitive versions of your files.*__

You can also PUT to a Edge Location, not just READ.

You can also removed cached objects, but it will cost you.

#### ---- AWSCSA-7.1: Create a CloudFront CDN

Head to CloudFront from the Dashboard.

Create a `distribution` and create a `web distribution`.

Select the bucket domain name. The origin path is the folder path if you just want something from individual folders.

You can have multiple distributions from the one bucket.

You can restrict the bucket access to come only from the CDN.

Follow the steps to allow things like Read Permissions and Cache Behaviour.

__Distribution Settings__

If you want to use CNAMEs, you can upload the certificate for SSL.

Default Root Object is if you access the naked URL.

Turn Logging "on" if you want.

__Once the Distribution is Ready__

After it is done, you can use the domain name provided to start accessing the cached version.

You can create multiple Origins for the CDN, and you can also updates behaviours etc. for accessing certain files from certain types of buckets.

You can also create custom error pages, restrict content based on Geography etc.

***

## AWSCSA-8: Securing Buckets

By default, all newly created buckets are PRIVATE.

__Access Controls__

- Bucket Policies
- Access Control Lists
- S3 buckets can be configured to create access logs which log all requests made to the S3 bucket

__Encryption__

_2 types_

- In Trasit: SSL/TLS (using HTTPS)
- At Rest:
	- Server-side
		- S3 Managed Keys - SSE-S3
		- AWS Key Management Service, Managed Keys - SSE-KMS
		- Server-Side Encryption with Customer Provided Keys - SSE-C
	- Client Side Encryption

***

## AWSCSA-9: Storage Gateway

 This is just a theoretical level intro.

 _AWS Storage Gateway is a service that connects an on-premises software appliance with cloud-based storage to provide seamless and secure integration between an organization's on-premises IT environment and AWS's storage infrastructure. The service enables you to securely store data to the AWS cloud for scalable and cost-effective storage._

 Essentially replicates data from your own data center to AWS. You install it as a host on your data center.

 You can use the Management Console to create the right console for you.

 __Three Types of Storage Gateways__

 1. Gateway Stored Volumes - To keep your entire data set on site. SG then bacs this data up asynchronously to Amazon S3. GS volumes provide durable and inexpensive off-site backups that you can recover locally or on Amazon EC2.

 2. Gateway Cached Volumes - Only your most frequently accessed data is stored. Your entire data set is stored in S3. You don't have to go out and buy large SAN arrays for your office/data center, so you can get significant cost savings. If you lose internet connectivity however, you will not be able to access all of your data.

 3. Gateway Virtual Tape Libraries (VTL) - Limitless collection or VT. Each VT can be stored in a VTL. If it is stored in Glacier, is it a VT Shelf. If you use products like NetBackup etc you can do away with this and just the VTL. It will get rid of your physical tapes and create the virtual ones.

 __Tips__

 - Know and understand the different gateways.
 	- GSV
	- GCV
	- GVTL

## AWSCSA-10: Import/Export

AWS Import/Export Disk accelerates moving large amounts of data into and out of the AWS cloud using portable storage devices for transport. AWS Import/Export Disk transfers your data directly onto and off of storage devices using Amazon's high-speed internal network and bypassing the Internet.

You essentially go out and buy a disk and then send it to Amazon who will then import all that data, then send your disks back.

There is a table that shows how connection speed equates to a certain amount of data uploaded in a time frame to give you an idea of what is worthwhile.

#### ---- AWSCSA-10.1: Snowball

Amazon's product that you can use to transfer large amounts of data in the Petabytes. It can be as little as one fifth the price.

Check the FAQ table on when they recommend to use Snowball.

__Summary__

Import/Export Disk:
- Import to EBS
- Import to S3
- Import to Glacier
- Export from S3

Import/Export Snowball:
- Only S3
- Only currently in the US (check this out on the website for the latest)

## AWSCSA-11: S3 Transfer Acceleration

Uses the CloudFront Edge Network to accelerate the uploads to S3. Instead of uploading directly to S3, you can use a distinct URL to upload directly to an edge location which will then transfer that file to S3. You will get a distinct URL to upload to.

eg `prefix.s3-accelerate.amazonaws.com`

Using the new URL, you just send the file to the edge location, and that edge location will send that to S3 over their Backbone network.

#### ---- AWSCSA-11.1: Turning on S3 Transfer Acceleration

From the console, access your bucket. From here, what you want to do is "enable" Transfer Acceleration. This endpoint will incur an additonal fee.

You can check the speed comparison and it will show you how effective it is depending on distance from a region. If you see similar results, the bandwith may be limiting the speed.

***

## AWSCSA-12: EC2 - Elastic Compute Cloud

#### ---- AWSCSA-12.1: EC2 Intro

Arguably the most important topics.

EC2 is a web service that provides resizable compute capacity in the cloud. Amazon EC2 reduces the time required to obtain and boot new server instances to minutes, allowing you to quickly scale capacity, both up and down, as your computing requirements change.

To get a new server online used to take a long time, but then public cloud came online and you could provision virtual instances in a matter of time.

EC2 changes the economics of computer by allow you to pay only for capacity that you actually use. Amazon EC2 provides developers the tools to build failure resilient applications and isolate themselves from common failure scenarios.

__Pricing Models__

1. On Demand - allows you to pay a fixed rate by the hour with no commitment.
2. Reserved - provide you with a capacity reservation, and offer a significant discount on the hourly charge for an instance. 1 year or 3 year terms.
3. Spot - enable you to bid whatever price you want for instance capacity, providing for even greater savings if your applications have flexible start and end times.

***

You would use _Reserved_ if you have a steady state eg. two web servers that you must always have running.

Used for applications that required reserved capacity.

Users are able to make upfront payments to reduce their total computing costs even further.

It makes more sense to use this if you know the amount of memory etc you may need and that you'll need it. Useful after understanding the steady state.

***

_On Demand_ would be for things like a "black Friday" sale where you spin up some web servers for a certain amount of time.

This is for low cost and flexible EC2 without any up-front payment or long-term commitment. Useful for Applications with short term, spiky, or unpredictable workloads that cannot be interrupted, or being tested or developed on EC2 for the first time.

***

_Spot Instances_ go with your bidding, but if the spot price goes above your bid, you will be given an hour notice before the instance is terminated. Large compute requirements are normally used this way. They basically time these instances and search where to get the best pricing.

You can check Spot Pricing on the AWS website to see the history etc. to make an educated guess.

This is for applications on feasible at low costs, and for users with urgent computing needs for large amounts of additional capacity.

Spot is always the most commercially feasible.

Spot won't charge a partial hour if Amazon terminate the instance.

__Instance Types__

<img src="insert" />

- T2 is the lowest of the family.
- Applications use M normally.
- C4/3 is for processor intensive.
- R3 is memory optimized.
- I2 - noSQL databases etc.
- D2 Data warehouses etc.

To think of it, think of the MCG digging up the dirt.

__DIRTMCG__

D for density
I for IOPS
R for RAM
T for cheap general purpose (this T2)
M for main choice for apps
C for compute
G for Graphics

This is VERY useful for working professionally.

#### ---- AWSCSA-12.2: What is EBS? (Elastic Block Store)

Amazon EBS allows you to create storage volumes and attach them to Amazon EC2 instances. Once attached, you can create a file system on top of these volumes, run a database, or use them in any other way you would use a block device.

Amazon EBS volumes are placed in a specific Availability Zone, where they are automatically replicated to protect you from the failure of a single component.

It is basically a disk in the cloud. The OS is installed on here + any DB and applications. You can add multiple EBS instances to one EC2 instance.

You cannot share one EBS with multiple EC2.

__Volume Types__

1. General Purpose SSD (GP2)
	- 99.999% availability
	- Ratio of 3 IOPS per GB with up to 10,000 IOPS and the ability to burt up to 3000 IOPS for short periods for volumes under 1GB.
	- IOPS are Input/Output Per Second to measure how fast the computer is from a read/write capacity.
2. Provisioned IOPS SSD (IO1)
	- Designed for I/O intensive apps like relational/NoSQL databases. Use if you need more than 10,000 IOPS.
3. Magnetic (standard)
	- Lowest cost per GB, where data is accessed frequently and applications where the lowest storage cost is important.

#### ---- AWSCSA-12.3: Launching a First EC2 Instance

***

__In Images__

<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-2.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-3.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-4.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-5.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-6.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-step-7.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-create-key.png" />
<img src="https://d1din05d4116wx.cloudfront.net/dok-aws-csa/img/ec2-dashboard.png" />



***

Initially, there will be no instances etc. except for 1 Security Group.

Click on "Launch Instance" and will take you to choose an AMI (Amazon Machine Image).

You will see different classification types in the brackets:

1. HVM: Hardware Virtual Machine.
2. PV: Para Virtual

For this example, we will choose Amazon Linux because it comes with a suite of things already available. This will then take you to choose the Instance Types.

You can then Configure your Instance Details.

Subnets can choose different availability zone.

You can choose the IAM role from here too.

The Advanced Details is us running a set of bash scripts.

Example: run updates after launch.

```
#!/bin/bash
yum update -y
```

In Step 4: Add Storage, we can change the IOPS by changing the size of the instance and we can alter the Volume Type.

By default, the instance will terminate the EBS volume.

We can also add a new volume etc.

Step 5: Tag Instance is used to give a key value pair for the tag.

- This is useful for things like resource tagging and billing purposes. You can monitor which staff are using what resources.


Step 6: Security Groups

Add in the security groups you need eg. HTTP, SSH

After reviewing and Selecting launch, you will need to download a new key pair.

***

From here, we are back to the EC2 Dashboard and that shows us the status.

Once the status is available, head to terminal and configure the file the way you normally would in your /.ssh/config file (for easy access - refer to the SSH-Intro.md SSH-7 file for more info).

__Note:__ Ensure that you change the permissions on the .pem key first!

```
chmod 600 <keyname.pem>
```

We can use `sudo su` to update our privileges to root.

Then `yum update -y` to run the updates.

__Review__

- Termination Protection is turned off by default
- The default action for an EBS-backed instance is to be deleted.
- Root Volumes cannot be encrypted by default. You need a third party tool.
- Additional Volumes can be encrypted.
