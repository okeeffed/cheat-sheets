# CloudFormation Master Class

## What is CloudFormation

Having >50 services, CloudFormation was brought in to help develops scaffold out the requires AWS stack.

Eg. I want a security group, two EC2 machines with it, two elastic IPs, an S3 bucket + a load balancer in front.

CloudFormation will create all of this in the right order with the exact config.

## Benefits 

1. Infrastructure as code  
    - No manual creation
    - Can be version controlled 
    - Changes to infrastructure are reviewed through code
2. Cost 
    - Each resource will be tagged so you can estimate the costs and figure out which costs what
    - Great savings strategy 
3. Productivity
    - Ability to destroy and re-create an infrastructure
    - Automated generation of Diagram for templates 
    - All declarative 
4. Separation of concern
    - Many different stacks for many different layers 
5. Don't re-invent the wheel
    - Already so many templates
    - Leverage the docs

## CloudFormation vs Ansible / Terraform

- CF is native, and also contain the latest 
- CF is state based
- The others are instruction based - difficult to orchestrate 
- For new services, Ansible / Terraform can take a long time

## First template

```yaml
---
Resources:
  MyInstance:
    Type: AWS::EC2::Instance
    Properties:
      AvailabilityZone: us-east-1a
      ImageId: ami-a4c7edb2
      InstanceType: t2.micro
```

The stack instance can be created, updated or destroyed.

You cannot edit the stack itself later, you need to just re-update the stack by uploading a new file.

The stack itself can clean up instances after itself too.

## YAML Intro

You can use YAML or JSON for writing it - but JSON is tough for it

Array support:

```
product:
    - test  : 1
      quantity: 2
    - test  : 2
      quantity: 4
```

## Creating a S3 Bucket 

Googling for the type, you will get the in depth docs from AWS.

```
---
Resources: # always the start 
    MyS3Bucket: # template name
        Type: "AWS::S3::Bucket"
        Properties: 
            AccessControl: PublicRead
            BucketName: "www.site.com"
```

### Types of updates 

1. Updates with no interruption
2. Replacements are breaking and need to replace the resource

### Properties 

On the properties under the docs, you can see info about the properties.

### Deleting the stack 

Just right click on the CloudFormation and delete the resources.

## CloudFormation template options

You have a few template options:

1. Tags
2. Permissions (IAM role)
3. Notifications Options (SNS topic)
4. Timeouts (minutes before calling failure)
5. Rollback on Failure 
6. Stack Policy 

These (if you manually do it) all show up on the "create stack" part of CloudFormation.

The template review also gives you an opportunity to estimate cost.

## CloudFormation Designer 

A visual aid to help build the CF Stack. Ensure the template is also well written.

You can drag and drop basically everything. Dropping it will give you options to selecting documentation etc.

It's great for dragging and dropping templates and giving information on that template as well.

## Building Blocks

There are a number of building blocks for each template:

1. Resources: your AWS resources declared in the template
2. Parameters: the dynamic inputs for your template
3. Mappins: the static variables for your template
