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
