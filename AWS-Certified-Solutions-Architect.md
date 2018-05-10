# Certified Solutions Architect - Associate 2016

<!-- TOC -->

- [Certified Solutions Architect - Associate 2016](#certified-solutions-architect---associate-2016)
    - [AWSCSA-1: Introduction Amazon](#awscsa-1-introduction-amazon)
    - [AWSCSA-2: Exam Blueprint and what you'll need](#awscsa-2-exam-blueprint-and-what-youll-need)
    - [AWSCSA-3: 10,000 Foot Overview](#awscsa-3-10000-foot-overview)
    - [AWSCSA-4: Identity Access Management (IAM)](#awscsa-4-identity-access-management-iam)
    - [AWSCSA-5: IAM - Identity Access Management Crash Course](#awscsa-5-iam---identity-access-management-crash-course)
    - [AWSCSA-6: S3 Crash Course](#awscsa-6-s3-crash-course)
            - [---- AWSCSA-6.1: Create an S3 Bucket](#-----awscsa-61-create-an-s3-bucket)
            - [---- AWSCSA-6.2: S3 Version Control](#-----awscsa-62-s3-version-control)
    - [AWSCSA-7: CloudFront](#awscsa-7-cloudfront)
            - [---- AWSCSA-7.1: Create a CloudFront CDN](#-----awscsa-71-create-a-cloudfront-cdn)
    - [AWSCSA-8: Securing Buckets](#awscsa-8-securing-buckets)
    - [AWSCSA-9: Storage Gateway](#awscsa-9-storage-gateway)
    - [AWSCSA-10: Import/Export](#awscsa-10-importexport)
            - [---- AWSCSA-10.1: Snowball](#-----awscsa-101-snowball)
    - [AWSCSA-11: S3 Transfer Acceleration](#awscsa-11-s3-transfer-acceleration)
            - [---- AWSCSA-11.1: Turning on S3 Transfer Acceleration](#-----awscsa-111-turning-on-s3-transfer-acceleration)
    - [AWSCSA-12: EC2 - Elastic Compute Cloud](#awscsa-12-ec2---elastic-compute-cloud)
            - [---- AWSCSA-12.1: EC2 Intro](#-----awscsa-121-ec2-intro)
            - [---- AWSCSA-12.2: What is EBS? (Elastic Block Store)](#-----awscsa-122-what-is-ebs-elastic-block-store)
            - [---- AWSCSA-12.3: Launching a First EC2 Instance](#-----awscsa-123-launching-a-first-ec2-instance)
            - [---- AWSCSA-12.4: Security Groups Basics](#-----awscsa-124-security-groups-basics)
            - [---- AWSCSA-12.5: Volumes VS Snapshots + Creating From Snapshots](#-----awscsa-125-volumes-vs-snapshots--creating-from-snapshots)
    - [AWSCSA-13: Create an Amazon Machine Image (AMI)](#awscsa-13-create-an-amazon-machine-image-ami)
    - [AWSCSA-13.1: EBS root volumes vs Instance Store](#awscsa-131-ebs-root-volumes-vs-instance-store)
    - [AWSCSA-14: Load Balancer and Health Checks](#awscsa-14-load-balancer-and-health-checks)
    - [AWSCSA-15: CloudWatch for EC2](#awscsa-15-cloudwatch-for-ec2)
    - [AWSCSA-16: The AWS Command Line](#awscsa-16-the-aws-command-line)
            - [---- AWSCSA-16.1: Using IAM roles with EC2](#-----awscsa-161-using-iam-roles-with-ec2)
    - [AWSCSA-17: Using Bootstrap Bash Scripts](#awscsa-17-using-bootstrap-bash-scripts)
    - [AWSCSA-18: EC2 Instance Meta-data](#awscsa-18-ec2-instance-meta-data)
    - [AWSCSA-19: Autoscaling 101](#awscsa-19-autoscaling-101)
    - [AWSCSA-20: EC2 Placement Groups](#awscsa-20-ec2-placement-groups)
    - [AWSCSA-21: EFS (Elastic File System) Concepts and Lab](#awscsa-21-efs-elastic-file-system-concepts-and-lab)
    - [AWSCSA-22: Lambda](#awscsa-22-lambda)
    - [AWSCSA-23: Route53](#awscsa-23-route53)
            - [---- AWSCSA-23.1: DNS101](#-----awscsa-231-dns101)
            - [---- AWSCSA-23.2: Creating a Route 53 Zone](#-----awscsa-232-creating-a-route-53-zone)
            - [---- AWSCSA-23.3: Routing Policies](#-----awscsa-233-routing-policies)
    - [AWSCSA-24: Databases](#awscsa-24-databases)
            - [---- AWSCSA-24.1: Launching an RDS Instance](#-----awscsa-241-launching-an-rds-instance)
            - [---- AWSCSA-24.2: Backups, Multi AZ and Read Replicas](#-----awscsa-242-backups-multi-az-and-read-replicas)
            - [---- AWSCSA-24.3: DynamoDB](#-----awscsa-243-dynamodb)
            - [---- AWSCSA-24.4: Redshift](#-----awscsa-244-redshift)
            - [---- AWSCSA-24.5: Elasticache](#-----awscsa-245-elasticache)
    - [AWSCSA-25: VPC](#awscsa-25-vpc)
            - [---- AWSCSA-25.1: Build your own custom VPC](#-----awscsa-251-build-your-own-custom-vpc)
            - [---- AWSCSA-25.2: Network Address Translation (NAT)](#-----awscsa-252-network-address-translation-nat)
            - [---- AWSCSA-25.3: Access Control Lists (ACLs)](#-----awscsa-253-access-control-lists-acls)
            - [---- AWSCSA-25.4: VPC Summary](#-----awscsa-254-vpc-summary)
    - [AWSCSA-26: Application Services](#awscsa-26-application-services)
            - [---- AWSCSA-26.1: SQS](#-----awscsa-261-sqs)
            - [---- AWSCSA-26.2: SWF (Simple Workflow Service)](#-----awscsa-262-swf-simple-workflow-service)
            - [---- AWSCSA-26.3: SNS (Simple Notification Service)](#-----awscsa-263-sns-simple-notification-service)
            - [---- AWSCSA-26.4: Elastic Transcoder](#-----awscsa-264-elastic-transcoder)
            - [---- AWSCSA-26.5: Application Services Summary](#-----awscsa-265-application-services-summary)
    - [AWSCSA-27: Real World Application - Wordpress Deployment](#awscsa-27-real-world-application---wordpress-deployment)
            - [---- AWSCSA-27.1: Setting up the environment](#-----awscsa-271-setting-up-the-environment)
            - [---- AWSCSA-27.2: Setting up EC2](#-----awscsa-272-setting-up-ec2)
            - [---- AWSCSA-27.3: Automation and Setting up the AMI](#-----awscsa-273-automation-and-setting-up-the-ami)
            - [---- AWSCSA-27.4: Configuring Autoscaling and Load Testing](#-----awscsa-274-configuring-autoscaling-and-load-testing)
            - [---- AWSCSA-27.5: CloudFormation](#-----awscsa-275-cloudformation)

<!-- /TOC -->

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

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/aws-s3-bucket-properties.png" />

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/aws-s3-inside-bucket.png" />

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/aws-s3-cross-region.png" />

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

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/cf-dashboard.png" />

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/cf-settings.png" />


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

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-2.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-3.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-4.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-5.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-6.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-step-7.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-create-key.png" />
<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-dashboard.png" />

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

#### ---- AWSCSA-12.4: Security Groups Basics

Go to the EC2 section in the AWS console and select Security Groups.

You can edit Security Groups on the fly that takes effect immediately.

__In terminal__

1. SSH in
2. Turn to root
3. Install apache `yum install httpd -y`

We check the server status using `service httpd status`

_To enable the server_ - use `service httpd start`

_To auto start up_ - use `chkconfig httpd on`

For everything that is publicly accessible, we move in `/var/www/html`

Feel free to nano a website and test it out. We can see the website by navigating to `52.65.112.142` on a web browser.

__Note:__ You need to ensure that HTTP access is allowed from anywhere on your security group! You can only allow rules, not deny rules.

If we were to delete the _Outbound_ traffic, it won't change anything just yet as it is "stateful". If something can go in, it can also go back out.

#### ---- AWSCSA-12.5: Volumes VS Snapshots + Creating From Snapshots

- Volumes exist on EBS
	- Virtual Hard Disk
- Snapshots exist on S3
- You can take a snapshot of a volume, this will store that volume on S3
- Snapshots are point in time copies of Volumes
- Snapshots are incremental, this means that only the blocks that have changed since your last snapshot are moved to S3.
- If this is the first snapshot, it may take some time to create.

From the EC2 Dashboard, you can select "Volumes" and then set a name for the volume. It is best practice to name your volumes.

You can `Create Volumes` and set them available.

<img src="https://d1din05d4116wx.cloudfront.net/aws-csa/ec2-volume-dashboard.png" />

You can use `Actions` to attach this to an `Instance`

To check what volumes are attached to an instance, you can run the following from the command line: `lsblk` (think list block)

The first thing we generally want to do is to check if there is any data on it.

`file -s /dev/xvdf` for this particular example.

__Format the volume__

```
mkfs -t ext4 /dev/xvdf
```

Now we want to make a fileserver directory.

```
mkdir /fileserver
mount /dev/xvdf /fileserver
cd /fileserver
ls // shows lost+found
rm -rf lost+found/
ls
nano helloworld.txt
nano index.html

# now let's unmount the volume
cd ..
umount /dev/xvdf
cd /fileserver
# check there are no files
ls
```

Now go ahead and detach that volume. This will change the state back to available.

__Create a snapshot__

Select Action > Create Snapshot and fill in the details and select `Create`

You can select Snapshot on the left and check the Snapshot is there. If you delete the volume, and then go back to the snapshot, you can select it and go to actions and you can create a new volume and create it with this Snapshot.

We can then `attach` the new volume. Now we can go through the above process and mount again.

Using the command `file -s /dev/xvdf` we can check the files available.

__Security__

Snapshots of encrypted volumes are encrypted automatically.

You can share Snapshots if they are unencrypted.

To create a snapshot for Amazon EBS volumes that serve as root devices, you should stop the instance before taking the snapshot.

## AWSCSA-13: Create an Amazon Machine Image (AMI)

You specify the AMI you want when you launch an instance, and you can launch as many instances from the AMI as you need.

__Three Components__

1. A template for the root volume for the instance
2. Launch permissions that control which AWS accounts can use the AMI to launch instances
3. A block device mapping that specifies the volumes to attach to the instance when it's launched

If you have a running instance (from before), we can create a snapshot of the volume that is attached to that instance.

From here, we can select that Snapshot and select "Create Image". Set the name and choose settings, then select create.

Under the Images > AMIs on the left hand bar, you can see the images owned by you and the public image. You can share these AMIs if you know the AWS Account Number.

If you are looking to make a public AMI, there are a few things that you would like to consider. Check the website for that.

There is also a segment for Shared usage.

You will also want to delete you bash history.

`history -c`

__Summary__

- The snapshot is stored in S3.
- AMIs are regional. You can copy them to other regions, but you need to do this with the console or the command line.

## AWSCSA-13.1: EBS root volumes vs Instance Store

What is the difference between AMI types?

EBS backed and Instance Store backed are two different types.

We can select our AMI based on Region, OS, Architecture, Launch Permissions and Storage for the Root Device.

You can choose...
	- Instance Store
	- EBS Backed Volumes

When launching an instance, it will also mention what type of AMI type it is.

After IS have been launched, you can only add additional EBS from then on.

You cannot stop an IS. However, with EBS, you can. So why would I want to stop an instance? If the underlining hypervisor is in a failed state, you can stop and start and it will start on another hypervisor. However, you cannot do that on an IS. You also cannot detach. Better for provisioning speed times.

IS volumes are created from a template stored in S3 (and may take more time). Also know as Ephemeral Storage.

EBS you can tell to keep the root device volume if you so wish.

## AWSCSA-14: Load Balancer and Health Checks

In the terminal

```
cd /var/www/html
```

Now head back to the console for EC2. Head to the load balancer section.

Leave the other defaults and move on to choose the security groups.

Configure the health check, which will use the `healthcheck.html` file.

Under the Adv Settings:

The Check will hit the file. The unhealthy thresh hold will check twice before bringing in the load balancer. The healthy threshold will then wait for 10 successful checks before bringing back our service.

_Repose Timeout_: How long to check for the response
_Interval_: How often to check
_Unhealthy Threshold_: How many fails before the load balancer comes in.
_Healthy Threshold_: How many successes it needs to take load balancer off.

Move on and select the instance.

Move on and add tags.

Back on the dashboard, it should then come `InService` after the given time limit.

If this isn't working...

1. Check the website
2. Check the zone status
3. Ensure the web server is running

The DNS name in the information is what you will use to resolve the load balancer.

The Elastic Load Balancer is never given a static IP address. You have public instance static IPs, but not the ELB.

## AWSCSA-15: CloudWatch for EC2

CloudWatch looks after all of your obervations for things like CPU usage etc.

You can set up detailed monitoring from the instances.

__In CloudWatch__

We have Dashboards, Alarms, Events, Logs and Metrics.

_Metrics_ are added to our dashboards. Create a dashboard to check this.

EC2 metrics are only on a Hypervisor level. Memory itself is actually missing.

EC2 Metrics include CPU, Disk, Network and Status.

You can update the time frame on the top right hand side.

This whole thing is about being to keep a heads up on the different instances etc.

__Events__

CW Events help you react to changes in the state of the AWS environment. Auto invoke things like a AWS Lambda function to update DNS entries for that event.

__Logs__

You can store an agent on an EC2 instance and it will monitor data about that and send it to CloudWatch. These will be things like HTTP response codes in Apache logs.

__Alarms__

Eg. When CPUUtilization is higher than a certain amount.

You can then send actions to send emails.

You can select the Period and Statistics on how you want this to work etc.

__Summary__

- Standard memory is on by default at 5 minutes.
- You can have dashboards that tell you about the environment
- Set alarms and take actions
- Events help you respond to state changes in your AWS resources
- Logs can be used to help aggregate, monitor and store logs

## AWSCSA-16: The AWS Command Line

Create a new instance without an IAM role.

You can use an existing key pair if you wish.

If we create a new user in IAM with certain permissions. After downloading the keys for this new user, we can create a group that has full access for S3.

Back on the EC2, we can see on the dashboard a running instance that has no IAM role. You can only assign this role when you create this instance.

Then, after connecting to the instance in the terminal.

Jump up to `root` using `sudo su`.

Then we can use the AWS command line tool to check certain things. Ensure that you have the AWS CLI installed.

We can configure things from here.

```
aws configure
```

If it needs the Access Key ID and Access Key, then copy and paste it in. Then choose the default region. You do not to put anything for the output format.

We can retype `aws s3 ls` to see our list of what is in that environment.

For things like help, you can type things like `aws s3 help`

__Where are credentials stored?__

```
cd ~
cd .aws
ls
#shows config and credentials
```

You can nano into credentials. Others could easily get into this. You can access someone's environment using these credentials. Therefore, it can unsafe to store these here.

That's where roles come in. An EC2 instance can assume a role.

#### ---- AWSCSA-16.1: Using IAM roles with EC2

Under Roles, we an either create a new role with AmazonS3FullAccess.

Then go back to EC2 and launch a new instance. You can select the role for IAM role and go through and create the instance.

Again, roles can have permissions changed that will take effect, but you cannot assign a new role to an EC2 instance after launching __again, this is important.__

Now if we ssh into our instance, we will find that in the root file there is no .aws file. Therefore, there are no credentials that we have to be worried about.

__Summary__

1. Roles are more secure
2. Roles are much easier to manage
3. Roles can only be assigned when the EC2 instance is provisioned
4. Roles are universal, you can use them in any region

## AWSCSA-17: Using Bootstrap Bash Scripts

These are scripts that our EC2 instances will run when they are created.

For an example, just create and save a html file.

In the AWS console itself, go into S3, create a bucket. This bucket will contain all the website code. Upload the code.

All new buckets have objects that are by default private.

Create a new instance of the EC2 instance, use T2 micro and then go into advanced details and add in some text.

```
#!/bin/bash
yum install httpd -y
yum update -y
aws s3 cp s3://dok-example/index.html /var/www/html
service httpd start
chkconfig httpd on
```

Now after the instance is up, we should be easily about to navigate to the IP address and every thing should be running.

## AWSCSA-18: EC2 Instance Meta-data

This is data about the EC-2 instance and how we can access this data from the command line.

ssh into an instance.

Elevate the privileges and the use the following to get some details.

```
curl http://169.254.169.254/latest/meta-data/
```

What is returned is the meta-data values you can pass after the url again to recieve data about.

Commands like this can write it to a html file:

```
curl http://169.254.169.254/latest/meta-data/public-ipv4 > mypublicip.html
```

## AWSCSA-19: Autoscaling 101

How to use launch configs and autoscaling gorups.

In a text editor, we can create the healthcheck.html test.

```
I am healthy.
```

Drop that guy into the relevant bucket. Ensure the load balancer is set up.

Head to launch configurations under autoscaling.

First, you need to create this launch config. Click Launch Config.

From here, you can select the AMIs related. Select the T2 micro from Amazon if you wish.

Add the roles etc and add in the advanced details if required.

__Note:__ Using the aws command line, you can copy files from a bucket.

You can also assign the IP type.

Select the security group, and then getting a warning about the file.

Create your key etc. too.

***

__Auto Scaling Group__

After, you will create the Auto Scaling Group. You can choose the group size too. Using the subnet, you can create a subnet and network.

If you have three groups and three availability zones, it will put each group in each availability zone.

In the advanced details, we can set up the Elastic Load Balance and Health Check Type (ELB in this case).

_Health Grace Period_ is how often the health is checked. The health check will also fail until Apache is turned on.

__Scaling Policies__

This allows us to automatically increase and decrease the number of instances depending on the number of settings that we do.

We can scale between 1 and 5 instances. You will choose to create and alarm and execute a policy at a certain time. These will grow and shrink depending on the settings.

Once they are up, you can check each IP address and see if they are up. If you choose the DNS, it will go towards one of the addresses.

We can use things like Route 53 and use it to help start sending traffic to other parts of the world.

## AWSCSA-20: EC2 Placement Groups

What is it? A logical grouping of instances within a single available zones. This enables applications to participate in a low-latency, 10 Gbps network. Placement groups are recommended for applications that benefit from low network latency, high network throughput, or both.

Recommended for things like group computer and you need a low latency for things like Cassandra Notes.

High network throughput, low latency - they're the goals!

- A placement group cannot span multiple Availability Zones.
- The name you specify must be unique with your AWS account.
- Only certain types of instances can be launched in a placement group (Compute Optimized, GPU, Memory Optimized, Storage Optimized.)
- AWS recommend homogenous instances within placement groups (same size and family)
- You can't merge placement groups.
- You can't move an existing instance into a placement group. You can create an AMI from your existing instance, and then launch a new instance from the AMI into a placement group.

## AWSCSA-21: EFS (Elastic File System) Concepts and Lab

EFS is a file storage service for EC2. It is easy to use and has a simple interface for configuration. Storage grows and shrinks as needed.

- Pay for used storage.
- Supports NFSv4 protocol.
- Scale to petabytes
- Supports thousands of concurrent NFS connections
- Read after write consistency

You can create an EFS from the dashboard.

Set up is similar to other set ups. We can predetermine our IP addresses and security groups.

While the set up is created, you can create a two or more instances and provision them.

If you have set up security groups, feel free to use them.

Provision a load balance for this as well.

Once they are all up, head back to the EFS and if it is ready in the availability zones, go and note down the public ips for the instances.

__Note:__ Make sure that the instances are in the same security group as the EFS.

If they are all set up, we can head back to EC2. Again, grab the ips and run the two instances in two different windows.

Once you've ssh'd into the instanes, instance Apache to run for the webserver. Start the server up!

`service httpd start`

Now we can `cd /var/www/html`

However, head to the root folder for both and then move to EFS.

You can select the EC2 Mount Instructions, then run the command to mount the EFS and ensure that it moves to /var/www/html/.

Now these will be mounted on EFS, and if we now `nano index.html` and create a home page.

This will move the files across both instances!

## AWSCSA-22: Lambda

Very, very advanced!

What is Lambda? It's a compute servie where you can upload your code and create a Lambda function. AWS Lambda takes care of provisioning and managing the servers that you use to run the code. You don't have to worry about OS, patching, scaling, etc.

You can use Lambda in the following ways:
- Event driven compute service. Lambda can run code in response to events. eg. uploading a photo to S3 and then Lambda triggers and turns the photo into a thumbnail etc.
- Transcoding for media
- As a compute service to run your code in response to HTTP requests using Amazon API Gateway or API calls made using AWS SDKs.

__The Structure__

- Data Centres
- Hardware
- Assembly Code/Protocols
- High Level Languages
- OS
- App Layer/AWS APIs

Lambda captures ALL of this. You only have to worry about the code, Lambda looks after everything else.

Pricing is ridiculously cheap. You pay for number of requests and duration. You only pay for this when the code executes.

__Why is it cool?__

No servers. No worry for security vulnerabilities etc! Continuously scales. No need to worry about auto scaling.

## AWSCSA-23: Route53

#### ---- AWSCSA-23.1: DNS101

DNS is used to convert human friendly domain names into an Internet Protocol address (IP).

IP addresses come in 2 different forms: IPv4 and IPv6.

IPv4 is 32-bit. IPv6 is 128 bits.

IPv4 is used, but IPv6 is for the future.

Top Level Domains

- .com
- .edu
- etc

__Domain Registrars__

Names are registered with InterNIC - a service of ICANN. They enforce the uniqueness.

Route53 isn't free, but domain registrars include things like GoDaddy.com etc.

__SOA Records__

The record stores info about:

- supplies name of the server
- admin of the zone
- current version of the data file
- number of seconds a server should wait before retrying a failed zone
- Default number of seconds for TTL on resource records

__NS Records__

Name Server Records

- used by Top Level Domains to direct traffic to the Content DNS servers which contains the authoritative DNS records.

__A Records__

Address record - used to translate from a domain name to the IP address. A records are always IPv4. IPv6 is AAA.

__TTL__

Length that the DNS is cached on either the Resolving Server or on your PC. This is important from an architectural point of view.

__CNAMES__

Canonical Name (CName) can be used to resolve one domain name to another. eg. you may have a mobile website m.example.com that is used for when users browse to your domain on a mobile. You may also want mobile.example.com to point there as well.

__Alias Records__

Used to map resource record sets in your hosted zone to Elastic Load Balancers, CloudFront Distribution, or S3 buckets that are configured as websites.

Alias records work like a CNAME record in that you can map one DNS name (www.example.com) to another 'target' DNS name (aeijrioea.elb.amazonaws.com)

__*Key Difference*__ - A CNAME can't be used for naked domain names (zone apex). You can't have a CNAME for acloud.guru. It must be either an A record or an Alias.

The naked domain name MUST always be an A record, not a C name. eg dennis.com.

The Alias will map this A record to an ELB.

__Summary__

For an ELB, you need a DNS name to resolve to an ELB. You will always need an IPv4 domain to resolve this... which is why you have the Alias Record.

Records with alias records won't have you charged, whereas CName will.

#### ---- AWSCSA-23.2: Creating a Route 53 Zone

Going from Route 53 to a load balancer to an EC2 Instance.

In EC2, launch an instance.

Bootstrap Script
```
#!/bin/bash
yum install httpd -y
service httpd start
yum update -y
echo "Hello Cloud Gurus" > /var/www/html/index.html
```

After moving through and launching the instance, create a load balancer.

Configure the health check for index.html.

Once the ELB is up.

Head to Route53 afterwards.

1. Create a Hosted Zone
2. Use a domain name you have purchased for the Domain Name and you can have a Public Hosted Zone or a private for VPC
3. Create this and it will create a Start of Authority record and a Name Server name.
4. Cut and paste the NS record, head back to the name server and customise that and enter in the NS values.

__Configure the naked domain name__

Create a Record Set. You need to create an alias and the target address will have your ELB DNS addresses.

There are routing policies (see the next section).

Once this is created, we should be able to type in the domain name and visit the website!

#### ---- AWSCSA-23.3: Routing Policies

__Simple:__ This is the default. Most commonly used when you have a single resource that performs a given function for your domain eg. one web server that serves content for the a website.

Think of one EC2 instance.

__Weighted:__ Example you can send a percentage of users to be directed to one region, and the rest to others. Or split to different ELBs etc.

Used for splitting traffic regionally or if you want to do some A/B testing on a new website.

__Latency:__ This is based on the lowest network latency for your end user (routing to the best region). You create a latency resource set for each region.

Route53 will select the latency resource set for the region that will give them the best result and repond with be resource set.

```
User -> DNS -> the better latency for an EC2 instance
```

__Failover:__ When you want to create an active/passive set up. Route53 will monitor the health of your primary site using a health check.

__Geolocation:__ Sending the user somewhere based on the location of the user.

__Summary__

- ELBs don't have a IPv4 address, you need to resolve to them.
- Understand the different between a CName and an alias. CName reqs are billed, alias are free. A domain name will want an alias record because you cannot use a CName. Always cheaper for alias.

## AWSCSA-24: Databases

#### ---- AWSCSA-24.1: Launching an RDS Instance

Head into EC2 and create a webserver.

There is a Bootstrap bash script you can use for practising purposes from this course.

```
#!/bin/bash
yum install httpd php php-mysql -y
yum update -y
chkconfig httpd on
service httpd start
echo "<?php phpinfo();?>" > /var/www/html/index.php
cd /var/www/html
wget https://s3-eu-west-1.amazonaws.com/acloudguru/connect.php
```

_To create an RDS instance_

Select an engine - MySQL. Select production or dev/test.

Choose an instance class, "No" for Multi-AZ Deployment and leave everything else as default.

Set up the Settings Instance ID, username etc.

Ensure the current selection is available for free tier.

For the options, select the database name and port.
- some instances can be encrypted at rest
- there is also a back up window
- select launch at the end when you're ready  

__Back in EC2__

We want to check if the bootstrap has worked successfully. We can do so by checking the site.

We can also try `<ip>/connect.php` to try and call a connection string.

In connect.php, we can check the settings. Ensure that this isn't from the bootstrap bash script from the course.

ssh into EC2 and move into `/var/www/html` and see the files.

For the hostname, we need to point it towards our RDS instance _endpoint_.

Ensure the webserver security can talk to the RDS instance.

In the security group, we want to allow security MYSQL/aurora to be able to connect and work for our security group. It's an inbound rule.

#### ---- AWSCSA-24.2: Backups, Multi AZ and Read Replicas

__Automated Backups__

2 Different Types

1. Automated Backups
2. Database Snapshots

Auto back ups allow you to recover your database to any point in time within a retention period. That can last between one and 35 days.

Auto Backups will take a full daily snapshot and will also store transaction logs throughout the day.

When you do a recovery, AWS will first choose the most recent daily back up and then apply transaction logs relevant to that day.

This allows you to do a point in time recovery down to a second, within a retention period.

Snapshots are done manually, and they are stored even after you delete the original RDS instance, unlike automated back ups.

Whenever you restore the database, it will come on a new RDS instance with a new RDS endpoint.

__Encryption__

Encryption at rest is supported for MySQL, Oracle, SQL Server, PostgreSQL & MariaDB. Encryption is done using the AWS Key Management Service (KMS).

Once your RDS instance is encrypted the data stored at rest in the underlying storage is encrypted, as are its automated backups, read replicas and snapshots.

In the instance actions, you can take a snapshot.

To restore, you can click in and restore. It will create a new database.

For Point In Time, you can select the option and click back to a point in time.

You can migrate the Snapshot onto another database, you can also copy it and move it to another region and you can of course restore it.

If it is encrypted, you will need to then use the KMS key ID and more.

__Multi-AZ__

If you have three instances, they can connect to another database which will then move data across to another database. You will then not need to move the entry point over.

It is for Disaster Recovery only. It is not primarily used for improving performance. For performance improvement, you need Read Replicas.

__Read Replica__

Different to Multi-AZ. Again with the three instances to an RDS, it creates an exact copy that you can read from. Multi-AZ is more for Disaster Recovery. This way you can improve your performance.

You can change the connection strings to your instances to read from the read replicas etc.

You can also have read replicas of read replicas.

They allow you to have a read-only replica. This is achieved using Async replication form the primary RDS instance to the read replica. You use read replica's primarily for very read-heavy database workloads.

Remember, RR is used for SCALING. You can also use things like Elasticache. This comes later.

__YOU MUST__ have auto back ups turned on in order to deploy a read replica. You can have up to 5 read replica copies of any database. You can have more read replicas, but then you could have latency issues.

Each replica will have its own DNS end point. You cannot have a RR with Multi-AZ.

You can however create Read Replicas of a DB with Multi-AZ.

RR can be promoted to be their own databases. This breaks the replication.

You can create this from the Instance Actions menu.

__DynamoDB vs RDS__

In RDS, we have to manually create a snapshot and then scale etc. - not automatic. You can only really scale up (read only) and not out (RW).

"Push button" scaling is DynamoDB.

#### ---- AWSCSA-24.3: DynamoDB

__What is it?__

A fast and flexible noSQL database service for all applications that need consistent, single-digit millisecond latency at any scale.

It is a fully managed database and support both document and key-value data models. The flexible data model and reliable performance make it a great fit for mobile, web, gaming, ad-tech, IoT and many other applications.

__Facts__

- Always stored on SSD storage
- Stored across 3 geographically distinct data centres.
- Eventual Consistency Reads (default): consistency across all copies of data is usually reached within a second. (Best read performance). If the data can wait after being read for 1s, then this is the best option.
- Strong Consistency Reads: A strongly consistent read returns a result that reflects all writes that received a successful response prior to the read.

Pricing is based on Provision Throughput Capacity:
- Write for 10units for hour
- Read is for 50units for hour
- Storage also factors in

DynamoDB can be expensive for writes, but cheap for reads.

__Creating DynamoDB__

To create it, go through the dashboard.

Add in a primary key (eg. number - student ID).

You can even go into the tables and start creating an _item_ from the dashboard. rom here, you can start creating fields.

You can then add in more columns for documents as your grow.

You can then scan and from the same dashboard.

There is no downtime during scaling.

#### ---- AWSCSA-24.4: Redshift

- Data warehousing service in the cloud. You can start small and then scale for $1000/TB/year.

The example shows a massive record set of summing things up and what is sold etc.

__Config__

You can start at a single node (160GB)

You can also have a Multi Node (think Toyota level)
	- Leader Node (manages client connections and receives queries).
	- Compute Node (store data and perform queries and computations). Up to 128 compute nodes.
	- These two Nodes work in tandem.

__Columnar Data Storage__

Instead of storing data as a series of rows, Redshift organises data by column. While row-based is ideal for transaction processing, column-based are ideal for data warehousing and analytics where queries often involve aggregate performed over large data sets.

Since only the columns involved in the queries are processed and columnar data is stored sequentially on the storage media, column-based systems require far fewer I/Os, greatly improving query performance.

_Advanced Compression_ - columnar data stores can be compressed much more than row-based data stores because similar data is stored sequentially on disk.

Redshift employs multiple compression techniques and can often achieve significant compression relative to traditional relational data stores.

In addition, Amazon Redshift doesn't require indexes or materialised views and so uses less space than traditional relational database systems. When loading into an empty table, Amazon Redshift automatically samples your data and selects the most appropriate compression scheme.

_Massive Parallel Processing (MPP)_

Redshift auto distributes data and query load across all nodes. Redshift makes it easy to add nodes to your data warehouse and enables you to maintain fast query performance as your data warehouse grows.

Massive advantage when you start using multi nodes.

This whole thing is priced on compute nodes. 1 unit per node per hour. Eg. a 3-node data warehouse cluster running persistently for an entire month would incur 2160 instance hours. You will not be charged for the leader node hours; only compute nodes will incur charges.

Also charged for a back up and data transfer (within a VPC).

__Security__

- Encrypted in transit using SSL
- Encrypted at rest using AES-256 encryption
- By default Redshift takes care of key management

_Design_

- Not multi AZ. 1 AZ at this point in time.
- Can restore snapshots to new AZ's in the event of an outage.
- Extremely efficient on infrastructure and software layer.

#### ---- AWSCSA-24.5: Elasticache

__What is it?__

It's a web service that makes it easy to deploy, operate and scale an in-memory cache in the cloud. The service improves the performance of web applications by allowing you to retrieve info from fast, managed, in-memory caches, instead of relying entirely on slow disk-based databases.

It can be used to significantly improve latency and throughput for many read-heavy application workload or compute-intensive workloads.

Caching improves application performance by storing critical pieces of data in memory for low-latency access. Cached info may include the results of I/O-intensive database queries or the results of computationally intensive calculations.

__Two different engines__

1. Memcached
	- Widely adopted memory object caching system. ElastiCache is protocol compliant with Memcached, so popular tools that you use today with existing Memcached environments will work seamlessly with the service.

2. Redis
 	- Open-source in-memory key-value store that supports data structures such as sorted sets and lists. ElastiCache supports Master/Slave replication and Multi-AZ which can be used to achieve cross AZ redundancy.

ElastiCache is a good choice if your database is particularly read heavy and not prone to frequent change.

Redshift is a good answer if there is management running OLAP transactions on it.

***

## AWSCSA-25: VPC

Most important thing for that CSA exam. You should know how to build this from memory for the exam.

__What is it?__

Think of a virtual data centre in the cloud.

It lets you provision a logically isolated section of AWS where you can launch AWS resources in a virtual network that you define.

You have complete control over your virtual networking environment, including selection of your own IP address range, creation of subnets, and configuration of route tables and network gateways.

Easily customizable config for your VPC. Eg. you can create a public-facing subnet for your webservers that has access to the Internet, and place your backend systems such as databases or application servers in a private facing subnet with no Internet access. You can leverage multiple layers of security to help control access to EC2 instances in each subnet.

This is multiple tier architecture.

You can also create Hardware Virtual Private Network (VPN) connections between your corporate datacenter and your VPC and leverage the AWS cloud as an extension of your corporate datacenter.

__What can you do with a VPC?__

- You can launch instances into a subnet of your choosing
- Assign custom IP address ranges in each subnet
- Configure route tables between subnets
- Create internet gateways and attach them to subnets
- Better security control over AWS resources
- Create instant security groups for each instance
- ACLs - subnet network control lists

__Default VPC vs Custom VPC__

- Default is very user friendly allowing you to immediately deploy instances
- All Subnets in default VPC have an internet gateway attached
- Each EC2 instance has both a public and private IP address
- If you delete the default VPC, you can only get it back by contacting AWS

__VPC Peering__

Connect one VPC with another via a direct network route using a private IP address.

Instances behave as if they're on the same private network.

You can peer VPCs with other AWS accounts as well as with other VPCs in the same account.

Peering is a star config, 1 VPC that peers with 4 others. The outer four can only contact with the middle. No such thing as transitive peering.

#### ---- AWSCSA-25.1: Build your own custom VPC

No matter which exam you sit, you need to do this as well.

From the dashboard, head to the VPC section and create a VPC.

Under _Route Tables_, the route has been created automatically.

Under _Subnet_, we want to create some subnets. Select the Test-VPC and the availability zone. __REALLY IMPORTANT__ - the subnet is always mapped to one availability zone.

Give a subnet like 10.0.1.0/24 etc. (more would be 10.0.2.0/24 etc)

Once it is created, we can choose from the available IPs.

Feel free to create more. The example gives up to 3.

Under Subnet > Route Table, we can see the target. Now if we deploy those 3 subnets, they could all communicate to each other through the Route Table.

Now we need to create an Internet Gateway. It allows you Internet Access to your EC2 Instances.

Create this. There is only one Internet Gateway per VPC. Then attach that to the desired VPC.

Now we need to create another Route Table. Now under Route Tables > Routes, edit this. Set the Destination to 0.0.0.0/0 and set the target to our VPC.

Now in Route Table > Subnet Associations, we need to decide which subnet we want to be internet accessible. Select one through edit and save. Now in the Route Table > Routes section for other table we created, it no longer has that Internet Route associated.

So now we effectively have a subnet 10.0.1.0 with internet access, but not for the other 2.

If we deploy instances into one with internet access and one without, we select the network as the new VPC and then select the correct subnet. We can auto assign the public IP.

For the security group, we can set HTTP to be accessed for everywhere.

Ensure that you create a new key pair. With that key value, copy that to the clip board and launch another "database" server. This will sit inside a subnet that is not internet accessible. Select the correct VPC and put it into 10.0.2.0 (other the other) and name is "MyDBServer". Stick it inside the same security group.

Hit review and launch, then use the existing key pair (the new one that was created).

The IP for the web server will now be added.

Once you have SSH'd in, you can use the update to install and prove you have Internet access.

If you head back to the instance with the DBServer, you can see there is no IP address. SSH in from the first WebServer (ssh to that, then ssh to the DBServer). Once in, the private subnet (not internet accessible) will fail and then we can create a NAT instance so we can actually download things like updates etc.

#### ---- AWSCSA-25.2: Network Address Translation (NAT)

Move into the security groups and create a new one for the NAT instance.

Call it (MyNATSG) and the assign the correct VPC.

We want http and https to flow from public subnets to private subnets.

For Inbound, let's create HTTP and set our DBServer IP. Do the same for HTTPS.

For the Outbound, we could configure it to only allow the HTTP and HTTPS traffic out for anywhere.

__Creating the NAT Instance__

Head back to EC2, and launch an instance and use a community AMI. Search for nat and find the top result.

Deploy to our VPC, disable to IP and select the web accessible VPC.

For the disabled IP, even if you have instances inside a public subnet, it doesn't mean they're internet accessible. You need to give it either a public IP or an ELB.

We can call it "MyNATVM" and add it to the NAT security group and then review and launch. We don't need to connect into this instance which is cool. It's a gateway. Use an existing key pair and launch.

Head to Elastic IPs and allocate a new address. This does incur a charge if it isn't associated with a EC2 instance. Associate the address with the NATVM.

Now, go back to the Instance, select Actions, choose Networking and select Change Source Dest. Check. Each EC2 instance performs checks by default, however NAT needs to be able to send source info - we need to disable this! Otherwise, they will not communicate with each other.

Jump into VPC and look at the default Route Tables. The main Route Table without the Internet Route, go to Routes, Edit and add another route. Select MyNATVM and set the destination as 0.0.0.0/0.

Now we can start running updates etc into the instance with a private IP.

You use the NAT to translate into the computer that communicates to each other and enable that private IP to run internet commands.

#### ---- AWSCSA-25.3: Access Control Lists (ACLs)

ACLs act like a firewall that allow you set up network rules between subnets. When you set an ACL, it overrides security groups.

Amazon suggest setting rules in % 100s. By default, each custom ACL starts out as closed.

The key thing to remember is that each subnet must be associated with a network ACL - otherwise it is associated with the default ACL.

__How to do it__

Under VPC > Network ACL, you check the Test-VPC and see the Inbound and Outbound rules set to 0.0.0.0/0.

For rules, the lowest is evaluated first. This means 100 is evaluated before 200.

We can create a new one. "My Test Network Control list."

Everything by default is denied for Inbound and Outbound. When you associate subnets with the ACL, it will only be associated with that ACL.

When you disassociate the subnets, it will default back to the "default" ACL.

#### ---- AWSCSA-25.4: VPC Summary

- Created a VPC
	- Defined the IP Address Range using CIDR
	- Default this created a Network ACL & Route table
- Created a custom Route Table
- Created 3 subnets
- Created a internet gateway
- Attached to our custom route
- Adjusted our public subnet to use the newly defined route
- Provisioned an EC2 instance with an Elastic IP address

__NAT Lecture__

- Created a security group
- Allowed inbound connects for certain IPs on HTTP and HTTPS
- Allowed outbound connections on HTTP and HTTPS for all traffic
- Provisioned our NAT instance inside our public subnet
- Disabled Source/Destination Checks -> SUPER IMPORTANT
- Set up a route on our private subnet to route through the private NAT instance

__ACL__

- ACLs over multiple subnets
- ACLs encompass all security groups under the subnets associated with them
- Numbers, Lowest is incremented first

***

## AWSCSA-26: Application Services

#### ---- AWSCSA-26.1: SQS

This was the very first AWS service.

Gives you access to a message queue that can be used to store messages while waiting for a computer to process them.

Eg. uploading an image file and that a job needs to be done on it. That message is on SQS. It will queue that system job and those app services will then access that image from eg s3 and will do something like adding a watermark and then when it's done, it will remove that message from the queue.

Therefore, if you've lost a web server that message will still stay in that queue and other app services can go ahead and do that task.

A queue is a temporary repository for messages that are awaiting processing.

You can decouple components. A message can contain 256KB of text in any format. Any component can then access that message later using the SQS API.

The queue acts as a buffer between the component producing and saving data, and the component receiving the data for processing. This resolves issues that arise if the producer is producing work faster than the consumer can process it, or if the producer or consumer are only intermittently connected to the network. - referencing autoscaling or fail over.

Ensures delivery of each message at least once.  A queue can be used simultaneously. Great for scaling outwards.

SQS does not guarantee first in, first out. As long as all messages are delivered, sequencing isn't important. You can enable sequencing.

***

Eg. a image encode queue. A pool of EC2 instances running the needed image processing software does the following:

1. Async pull task messages from the queue. ALWAYS PULLS. (Polling)
2. Retrieves the named file.
3. Processes the conversion.
4. Writes the image back to Amazon S3.
5. Writes a "task complete" to another queue.
6. Deletes the original task.
7. Looks for new tasks.

Example

- Component 1 -> Message queue.
- Message queue pulled from Component 2 (visibility clock time out starts).
- Component 2 processes and deletes it from the queue during the visibility timeout period.

***

You can configure auto scaling. It will see the group growing fast and start autoscaling in response to what you have set. Some of the back bones of the biggest websites out there. SQS works in conjunction with autoscaling.

__Summary__

- Does not offer FIFO
- 12 hours of visibility
- SQS is engineered to provide "at least once" delivery of all messages in its queues - you should design your system so that processing a message more than once does not create any errors or inconsistencies
- For billing, a 64KB chunk is billed as 1 request.

#### ---- AWSCSA-26.2: SWF (Simple Workflow Service)

It's a web service that makes it easy to coordinate work across distributed application components. SWF enables applications for a range of use cases, including media processing, web application back-ends, business process workflows, and analytics pipelines, to be designed as a coordination of tasks.

Tasks represent invocations of various processing steps in an application which can be performed by executable code, web service calls, human actions and scripts.

Amazon use this for things like processing orders online. They use it to organise how to get things to you. If you place an order online, that transaction then kicks off a new job to the warehouse where the member of staff can get the order and then you need to get that posted to them.

That person will then have the task of finding the hammer and then package the hammer etc.

SQS has a retention period of 14 days. SWF has up to a year for workflow executions.

Amazon SWF presents a task-oriented API, whereas Amazon SQS offers a message-orientated API.

SWF ensures that a task is assigned only once and is never duplicated. With Amazon SQS, you need to handle duplicated messages and may also need to ensure that a message is processed only once.

SWF keeps track of all tasks in an application. With SQS, you need to implement your own application level tracking.

__SWF Actors__

1. Workflow starters - an app that can initiate a workflow. Eg. e-commerce website when placing an order.
2. Deciders - Control the flow of activity tasks in a workflow execution. If something has finished in a workflow (or fails) a Decider decides what to do next.
3. Activity workers - carry out the activity tasks.

#### ---- AWSCSA-26.3: SNS (Simple Notification Service)

This is a mobile service. It's a service that make it easy to send and operate notifications from the cloud. It's a scalable, flexible and cost-effective way to publish message from an application and immediately deliver them to subscribers or other applications.

Useful for things like SNS. That can email you or send you a text letting you know that your instance is growing.

You can use it push notifications to Apple, Google etc.

SNS can also deliver notifications by text, email or SQS queues or any HTTP endpoint. It can also launch Lambda functions that will be invoked. The message input is a payload that is reacts to.

It can connect up a whole myriad of things.

It can group multiple recipients using a topic.

One topic can have multiple end point types.

It delivers appropriately formatted notifications and it Multi-AZ.

You can use it for CloudWatch and autoscaling.

__Benefits__

- Instantaneous, push-based delivery (no polling)
- Simple APIs and easy integration with applications
- Flexible message delivery over multiple transport protocols
- Inexpensive, pay as you go model.
- Simple point-and-click GUI

__SNS vs SQS__

Both messaging services, but SNS is push while SQS is pulls (polls).

#### ---- AWSCSA-26.4: Elastic Transcoder

Relatively new service. It converts media files form their original source format in to different formats.

It provides presets for popular output formats.

Example uploading media to an S3 bucket will trigger a Lambda function that then uses the Elastic Transcoder to put it into a bunch of different formats. The transcoded files could then be put back into the S3 Bucket.

Check https://read.acloud.guru to read some more about that.

#### ---- AWSCSA-26.5: Application Services Summary

__SQS__

- It is a web service that gives you access to a message queue that can be used to store messages while waiting for a computer to process them.
- Eg. Processing images for memes and then storing in a S3 bucket.
- Not FIFO.
- 12 hour visability time out.
- At least once messaging.
- Messages are 256kb but billed in 6kb chunks
- You can use two SQS queues and the premium can be polled first and when it is emptied then you can use the second queue.

__SWF__

- SQS has a retnetion period of 14 days vs a year for SWS
- SQS is message orientated whereas SWF is task-orientated
- SWF ensures that a task is assigned only once and never duplicated
- SWF keeps track of all the tasks and events in an application. With Amazon SQS, you need to implement your own application-level tracing, especially if your application uses multiple queues.

3 Different types of actors:

1. Workflow Starter - starts a workflow
2. Deciders - Control the flow of activity tasks in a workflow execution
3. Activity workers - carry out the activity tasks

__SNS__

- HTTP, HTTPS, Email, Application, Lambda etc etc
- SNS and SQS are both messaging services in AWS. SNS is push, whereas SQS is polling (pull)
- Pay based on the minutes that you transcode and the resolution at which you transcode

## AWSCSA-27: Real World Application - Wordpress Deployment

#### ---- AWSCSA-27.1: Setting up the environment

First of all, create a new role in AMI.

It will be for Amazon S3 access.

Set up the two security groups: one for the EC2 and the other for the RDS.

After that has been creating, go into the web security group and ensure that you can allow port 80 for HTTP and 22 for SSH.

For the RDS group, allow MySQL traffic and choose the source as the web security group.

Head to S3 and create a new bucket for the WordPress code. Choose the region for the security groups that you just made.

Once the bucket has been created, sort out the CDN. So head to CloudFront and create a new distribution. Use the web distribution and use the bucket domain. The Origin path would be the subdirectory. Restrict the Bucket Access to hit CloudFront only and not S3. Ensure that you update the bucket policy so that it always has read permissions for the public.

Head and create the RDS instance. Launch the MySQL instance. You can use a free-tier if you want, but multi-AZ will require an incurred cost.

Ensure you've set the correct settings that you would like.

Add that to the RDS security group and ensure that it is not publicly accessible.

Head over to EC2 and provision a load balancer. Put that within the web security group and configure the health checks.

Once the Load Balancer is up, head to Route 53 and set up the correct info for the naked domain name. You will need to set an alias record, and set that to the ELB.

#### ---- AWSCSA-27.2: Setting up EC2

Head to EC2 and provision an instance. The example uses the Amazon Linux of course.

Ensure you assign the S3 role to this. Add the bootstrap script from the course if you want.

Ensure that you have given the correct user rights to wp-content.

```
chmod -R 755 wp-content
chown -R apache.apache wp-content
cd wp-content
ls
```

#### ---- AWSCSA-27.3: Automation and Setting up the AMI

In the uploads directory for wp-content, you'll notice that it hasn't nothing. If you do upload the image through wp-admin, it'll be available (as you could imagine).

Back in the console in uploads, you can then `ls` and see the file there. We want it so that all of our images head to S3 and they will be served out of CloudFront.

`cd /var/www/html`

List out the s3 bucket to start synchronising the content.

`aws s3 ls` to figure out the bucket.

```
# ensure the s3 bucket is your media bucket

aws s3 cp --recursive /var/www/html/wp-content/uploads s3://wordpressmedia16acloudguru
```

Now we can sync up after adding another photo.

```
# ensure the s3 bucket is your media bucket

aws s3 sync /var/www/html/wp-content/uploads s3://wordpressmedia16acloudguru --delete --dryrun // the delete marker makes it a perfect sync //dry run won't do anything but show you what it wil do
```

We need to create a .htaccess file and create some changes.

In the .htaccess file, we have the following.

```
Options +FollowSymlinks
RewriteEngine on
rewriterule ^wp-content/uploads/(.*)$ [cloudfront-link] [r=301,nc]

# BEGIN Wordpress

# END Wordpress
```

Now, we actually want to edit all this.

`cd etc && nano crontab`

We want to now schedule some tasks.

```
*/2 * * * * root aws s3 sync --delete /var/www/html/ s3://wordpresscodebucket/ (the s3 bucket)

*/2 * * * * root aws s3 sync --delete /var/ww/html/wp-content/uploads/ s3://mediabucket/
```

Normally you would just have one EC2 instance that is a write and then the rest are read only.

For the other EC2 instances that aren't dedicated.
```
*/3 * * * * root aws s3 sync --delete s3://wordpress /var/www/html/
```

If you try to upload, it is still waiting to replicate to the CDN.

__Creating an Image__

Select the EC2 instance and then select that EC2 and create an image. After it is finished in the AMIs, you can launch it on another computer.

When you move that file across, you can launch the instance and have a bash script to run the updates and then do a AWS sync.

When the instance is live, we should be able to just go straight to the IP address.

#### ---- AWSCSA-27.4: Configuring Autoscaling and Load Testing

Create an autoscaling group from the menu. Initial create a launch config.

There is a TemplateWPWebServer AMI from A Cloud Guru that they use here.

For the Auto-Scaling Group.

Create it and select your subnets.

In Advanced, run off the ELB we created.

In the scaling policies, we want 2 to 4. Sort out the rest of the stuff for the ASG, review and launch.

Once the instances are provisioned, you'll also note that the ELB will have no instances until everything has set up.

If you reboot the RDS, you test the failover.

Now we can run a stress test call `stress` that was installed in the A Guru Bootstrap.

#### ---- AWSCSA-27.5: CloudFormation

A lot of what you will be doing for services. CF is like Bootstrapping for AWS.

In the EC2 instance, ensure that you've done a tear down and then remove the RDS instance as well.

Select into "CloudFormation"

Create a new stack. Here, we can design a template ourselves or we can hit a template designer.

From here, you will specify details. You can set the parameters from here!

Running this we can actually have the CF Stack provision everything for us.
