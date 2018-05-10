# CloudFormation Master Class

<!-- TOC -->

*   [CloudFormation Master Class](#cloudformation-master-class)
    *   [What is CloudFormation](#what-is-cloudformation)
    *   [Benefits](#benefits)
    *   [CloudFormation vs Ansible / Terraform](#cloudformation-vs-ansible--terraform)
    *   [First template](#first-template)
    *   [YAML Intro](#yaml-intro)
    *   [Creating a S3 Bucket](#creating-a-s3-bucket)
        *   [Types of updates](#types-of-updates)
        *   [Properties](#properties)
        *   [Deleting the stack](#deleting-the-stack)
    *   [CloudFormation template options](#cloudformation-template-options)
    *   [CloudFormation Designer](#cloudformation-designer)
    *   [Building Blocks](#building-blocks)
    *   [Template helpers](#template-helpers)
    *   [CloudFormation Parameters](#cloudformation-parameters)
        *   [Overview](#overview)
        *   [Theory and hands on](#theory-and-hands-on)
    *   [How to reference a parameter](#how-to-reference-a-parameter)
    *   [Resources](#resources)
        *   [Reading the docs for an ES2 Instance](#reading-the-docs-for-an-es2-instance)
        *   [Optional Attributes for Resources](#optional-attributes-for-resources)
        *   [FAQ for resources](#faq-for-resources)
    *   [Mappings](#mappings)
        *   [Fn::FindInMap - Accessing Mapping Values](#fnfindinmap---accessing-mapping-values)
        *   [Mappings in practise](#mappings-in-practise)
    *   [Concept: Pseudo Parameters](#concept-pseudo-parameters)
    *   [CloudFormation Outputs](#cloudformation-outputs)
        *   [Outputs Hands-On](#outputs-hands-on)
        *   [Cross Stack Reference](#cross-stack-reference)
    *   [Conditions](#conditions)
        *   [How to define a condition?](#how-to-define-a-condition)
    *   [Conditional Hands On](#conditional-hands-on)
    *   [Fn::GetAtt](#fngetatt)
    *   [CF Metadata](#cf-metadata)
        *   [AWS::CloudFormation::Designer hands on](#awscloudformationdesigner-hands-on)
        *   [AWS::CloudFormation::Interface hands on](#awscloudformationinterface-hands-on)
    *   [CFN Init and EC2 User Data](#cfn-init-and-ec2-user-data)
        *   [EC2 User Data Overview](#ec2-user-data-overview)
        *   [CloudFormation Init](#cloudformation-init)
        *   [AWS::CloudFormation::Init](#awscloudformationinit)
        *   [Packages](#packages)
        *   [Groups and Users](#groups-and-users)
        *   [Sources](#sources)
        *   [Files](#files)
        *   [Fn::Sub](#fnsub)
        *   [Commands](#commands)
        *   [Services](#services)
        *   [CFN Init and Signal](#cfn-init-and-signal)
        *   [cfn-hup](#cfn-hup)
        *   [CFN Init Hands-On](#cfn-init-hands-on)
    *   [Advanced CF Concepts](#advanced-cf-concepts)
        *   [Using the AWS CLI](#using-the-aws-cli)
        *   [Using Troposphere (Python) to generate CloudFormation templates](#using-troposphere-python-to-generate-cloudformation-templates)
        *   [DeletionPolicy](#deletionpolicy)
        *   [Custom Resources with AWS Lambda](#custom-resources-with-aws-lambda)
        *   [Best practises to organize your CloudFormation templates](#best-practises-to-organize-your-cloudformation-templates)
        *   [Cost estimate for templates](#cost-estimate-for-templates)

<!-- /TOC -->

## What is CloudFormation

Having >50 services, CloudFormation was brought in to help develops scaffold out the requires AWS stack.

Eg. I want a security group, two EC2 machines with it, two elastic IPs, an S3 bucket + a load balancer in front.

CloudFormation will create all of this in the right order with the exact config.

## Benefits

1.  Infrastructure as code
    *   No manual creation
    *   Can be version controlled
    *   Changes to infrastructure are reviewed through code
2.  Cost
    *   Each resource will be tagged so you can estimate the costs and figure out which costs what
    *   Great savings strategy
3.  Productivity
    *   Ability to destroy and re-create an infrastructure
    *   Automated generation of Diagram for templates
    *   All declarative
4.  Separation of concern
    *   Many different stacks for many different layers
5.  Don't re-invent the wheel
    *   Already so many templates
    *   Leverage the docs

## CloudFormation vs Ansible / Terraform

*   CF is native, and also contain the latest
*   CF is state based
*   The others are instruction based - difficult to orchestrate
*   For new services, Ansible / Terraform can take a long time

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

1.  Updates with no interruption
2.  Replacements are breaking and need to replace the resource

### Properties

On the properties under the docs, you can see info about the properties.

### Deleting the stack

Just right click on the CloudFormation and delete the resources.

## CloudFormation template options

You have a few template options:

1.  Tags
2.  Permissions (IAM role)
3.  Notifications Options (SNS topic)
4.  Timeouts (minutes before calling failure)
5.  Rollback on Failure
6.  Stack Policy

These (if you manually do it) all show up on the "create stack" part of CloudFormation.

The template review also gives you an opportunity to estimate cost.

## CloudFormation Designer

A visual aid to help build the CF Stack. Ensure the template is also well written.

You can drag and drop basically everything. Dropping it will give you options to selecting documentation etc.

It's great for dragging and dropping templates and giving information on that template as well.

## Building Blocks

There are a number of building blocks for each template:

1.  Resources: your AWS resources declared in the template
2.  Parameters: the dynamic inputs for your template
3.  Mappings: the static variables for your template
4.  Outputs: References to what has been created
5.  Conditionals: List of conditions to perform resource creation
6.  Metadata

## Template helpers

1.  References
2.  Functions

## CloudFormation Parameters

### Overview

What are they? The way to provide inputs to your AWS CloudFormation template.

They're important to know about it:

1.  You want to reuse your templates across the company
2.  Some inputs can not be determined ahead of time

The major benefit: you won't have to re-upload a template to change its content.

### Theory and hands on

Parameters can be controlled by all these settings:

1.  Type:

*   String
*   Number
*   CommaDelimitedList
*   List<Type>
*   AWS Parameter (to help catch invalid values - match against existing values in the AWS Account)

2.  Description
3.  Constraints
4.  ConstraintDescription (String)
5.  Min/MaxLength
6.  Min/MaxValue
7.  Defaults
8.  AllowedValues (array)
9.  AllowedPattern (regexp)
10. NoEcho (Boolean)

This can be found in the `0-parameters-hands-on.yaml`.

Again - check the docs.

To reference a parameter, you then go with `Key: !Ref Reference`.

If you have `!Select` for a CommaDelimitedList, you need to go `Key: !Select [ArrayNumber, !Ref Reference]`.

## How to reference a parameter

*   Using the Fn::Ref function.
*   Shorthand in YAML is !Ref.
*   Can reference block, not just parameter

## Resources

Resources are the core of your CloudFormation template. They represent the different AWS Components that will be created and configured.

They are declared and can be references by eachother. AWS figures out creation, updates, deletes etc.

There are over 224 types of resources.

They are identified using the form `AWS::aws-product-name::data-type-name`.

### Reading the docs for an ES2 Instance

If you look at the docs, if comes up with both JSON and YAML docs.

### Optional Attributes for Resources

1.  DependsOn: very useful to draw a dependency between two resources. For example, only create an ECS cluster after creating an ASG (auto scaling group).
2.  DeletionPolicy: protect resource from being deleted even if cloudformation is deleted.
3.  CreationPolicy: more info on CFN
4.  Metadata: anything you want!

### FAQ for resources

1.  Can I create a dynamic a dynamic amount of resources? No you can perform code generation. The work around is the `troposphere` Python library.
2.  Is every AWS Service supported? Almost. Only a select few niches are not there.

## Mappings

What are mappings? Fixed ariables within your CF Template. Great for dev vs prod, regions, AMI types etc.

Every mapping has top, middle and bottom.

Great to use when you know in advance:

*   Region
*   AZ
*   AWSAccount
*   Environment (dev vs prod)

They allow safer control over the template. Use parameters when the values are _really_ user specific.

### Fn::FindInMap - Accessing Mapping Values

Use Fn::FindInMap to return a named value from a specific key.

*   !FindInMap [ MapName, TopLevelKey, SecondLevelKey ]

Example:

```yaml
AWSTemplateFormatVersion: "2010-09-09"
Mappings:
    RegionMap:
        us-east-1:
            "32": "ami-6411e20d"
            "64": "ami-7a11e213"
Resources:
    myEC2Instance:
        Type: "AWS::EC2::Instance"
        Properties:
            ImageId: !FindInMap [RegionMap, !Ref "AWS::Region", 32]
            InstanceType: m1.small
```

### Mappings in practise

```yaml
Parameters:
    EnvironmentName:
        Description: Environment Name
        Type: String
        AllowedValues: [development, production]
        ConstraintDescription: must be development or production

Mappings:
    AWSRegionArch2AMI:
        us-east-1:
            HVM64: ami-6869aa05
    EnvironmentToInstantType:
        development:
            instanceType: t2.micro
        production:
            instanceType: t2.small

Resources:
    EC2Instance:
        Type: AWS::EC2::Instance
        Properties:
            InstanceType: !FindInMap [EnvironmentToInstanceType, !Ref 'EnvironmentName', instanceType]
            ImageId: !FindInMap [AWSRegionArch2AMI, !Ref 'AWS::Region', HVM64]
```

## Concept: Pseudo Parameters

*   AWS offers us pseudo params in any CF template.
*   These can be used at any time and are enabled by default.

1.  AWS::AccountId
2.  AWS::NotificationsARNs
3.  AWS::NoValue
4.  AWS::Region
5.  AWS::StackId
6.  AWS::StackName

## CloudFormation Outputs

What are they? They are _optional_ values that we can import into other stacks.

You can also view the outputs in the AWS Console or in using the AWS CLI.

They're very useful for example if you define a network CloudFormation, and output the variables such as VPC ID and your Subnet IDs.

It's the best way to perform some collaboration cross stack. Let the expert handle their part and you handle yours.

### Outputs Hands-On

Creating a SSH Security Group as part of one template. We can create an output that references that security group.

```yaml
Outputs:
    <Logical ID>:
        Description: Information about the value
        Value: Value to return
        Export:
            Name: Value to export
```

In 0-create-ssh-security-group.yaml

```yaml
Resources:
  # here we define a SSH security group that will be used in the entire company
  MyCompanyWideSSHSecurityGroup:
    # http://docs.aws.amazon.com/AWSCloudFormation/latest/UserGuide/aws-properties-ec2-security-group.html
    Type: AWS::EC2::SecurityGroup
    Properties:
      GroupDescription: Enable SSH access via port 22
      SecurityGroupIngress:
        # we have a lot of rules because it's a perfect security group
        # finance team network
      - CidrIp: 10.0.48.0/24
        FromPort: 22
        IpProtocol: tcp
        ToPort: 22
        # marketing team network
      - CidrIp: 10.0.112.0/24
        FromPort: 22
        IpProtocol: tcp
        ToPort: 22
        # application team support network
      - CidrIp: 10.0.176.0/24
        FromPort: 22
        IpProtocol: tcp
        ToPort: 22

Outputs:
  StackSSHSecurityGroup:
    Description: The SSH Security Group for our Company
    Value: !Ref MyCompanyWideSSHSecurityGroup
    Export:
      Name: SSHSecurityGroup
```

It is important to note that for an `output` to be used anywhere, you need to define an `export` value.

### Cross Stack Reference

We use `Fn::ImportValue` in a simple block:

```yaml
Resources:
  MySecureInstance:
    # http://docs.aws.amazon.com/AWSCloudFormation/latest/UserGuide/aws-properties-ec2-instance.html
    Type: AWS::EC2::Instance
    Properties:
      AvailabilityZone: us-east-1a
      ImageId: ami-a4c7edb2
      InstanceType: t2.micro
      SecurityGroups:
        # we reference the output here, using the Fn::ImportValue function
        - !ImportValue SSHSecurityGroup
```

## Conditions

Conditionals are used to control the creation of resources or outputs based on a condition.

Conditions can be whatever you want them to be, but common ones are:

*   Environment (dev/test/prod)
*   AWS Region
*   Any parameter value

Each condition can reference another condition, parameter value or mapping.

### How to define a condition?

```yaml
Conditions:
    [Logical ID]:
        [Intrinsic function]
```

Logical ID is for you to choose. It's how you name the condition.

The intrinsic function (logical) can be any of the following: - Fn::And - Fn::Equals - Fn::If - Fn::Not - Fn::Or

## Conditional Hands On

*   Let's analyze a CF template that optionally creates a volume and mount point only if "prod" is specified as a parameter.
*   It utilizes params, mappings, conditionals, outputs

```yaml
AWSTemplateFormatVersion: "2010-09-09"
Mappings:
  RegionMap:
    us-east-1:
      AMI: "ami-a4c7edb2"
      TestAz: "us-east-1a"
    us-west-1:
      AMI: "ami-6df1e514"
      TestAz: "us-west-1a"
    us-west-2:
      AMI: "ami-327f5352"
      TestAz: "us-west-2a"
    eu-west-1:
      AMI: "ami-d7b9a2b1"
      TestAz: "eu-west-1a"
    sa-east-1:
      AMI: "ami-87dab1eb"
      TestAz: "sa-east-1a"
    ap-southeast-1:
      AMI: "ami-77af2014"
      TestAz: "ap-southeast-1a"
    ap-southeast-2:
      AMI: "ami-10918173"
      TestAz: "ap-southeast-2a"
    ap-northeast-1:
      AMI: "ami-e21cc38c"
      TestAz: "ap-northeast-1a"
Parameters:
  EnvType:
    Description: Environment type.
    Default: test
    Type: String
    AllowedValues:
      - prod
      - test
    ConstraintDescription: must specify prod or test.

Conditions:
  CreateProdResources: !Equals [ !Ref EnvType, prod ]

Resources:
  EC2Instance:
    Type: "AWS::EC2::Instance"
    Properties:
      ImageId: !FindInMap [RegionMap, !Ref "AWS::Region", AMI]
      InstanceType: t2.micro
      AvailabilityZone: !FindInMap [RegionMap, !Ref "AWS::Region", TestAz]

  MountPoint:
    Type: "AWS::EC2::VolumeAttachment"
    Condition: CreateProdResources
    Properties:
      InstanceId:
        !Ref EC2Instance
      VolumeId:
        !Ref NewVolume
      Device: /dev/sdh

  NewVolume:
    Type: "AWS::EC2::Volume"
    Condition: CreateProdResources
    Properties:
      Size: 100
      AvailabilityZone:
        !GetAtt EC2Instance.AvailabilityZone

Outputs:
  VolumeId:
    Condition: CreateProdResources
    Value:
      !Ref NewVolume
```

Note that `conditions` can not be applied to `parameters`.

## Fn::GetAtt

Get an attribute attached to any resource that exists. To know the attributes, check the docs.

## CF Metadata

This is any optional metadata section to include arbitrary YAML that provide details about the template or resource.

There are 3 metadata keys that have special meaning:

1.  AWS::CloudFormation::Designer

Describes how the resources are laid out in your template. This is automatically added by the AWS Designer. This helps the UI (x and y)

2.  AWS::CloudFormation::Interface

Define grouping and ordering of input parameters when they are displayed in the AWS Console.

3.  AWS::CloudFormation::Init

Define configuration tasks for cfn-init. It's the most powerful usage of the metadata. This is very important and a lot to learn about it below.

### AWS::CloudFormation::Designer hands on

This is automatically added for you but worth deleting for online sharing and usage. When dragging and dropping each resource you will see a huge set of metadata left there. The metadata can also be added to each resource.

### AWS::CloudFormation::Interface hands on

Define grouping and ordering of input parameteres when they are displayed in the AWS Console. This is meant when users must input params manually.

You provide them with grouping, or sorting, that allow them to input parameters efficiently.

Example: Group all the EC2 related params together.

```yaml
---
Parameters:
  KeyName:
    Description: Name of an existing EC2 key pair for SSH access to the EC2 instance.
    Type: AWS::EC2::KeyPair::KeyName
  InstanceType:
    Description: EC2 instance type.
    Type: String
    Default: t2.micro
    AllowedValues:
    - t2.micro
    - t2.small
    - t2.medium
    - m3.medium
    - m3.large
    - m3.xlarge
    - m3.2xlarge
  SSHLocation:
    Description: The IP address range that can SSH to the EC2 instance.
    Type: String
    MinLength: '9'
    MaxLength: '18'
    Default: 0.0.0.0/0
    AllowedPattern: "(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})/(\\d{1,2})"
    ConstraintDescription: Must be a valid IP CIDR range of the form x.x.x.x/x.
  VPCID:
    Description: VPC to operate in
    Type: AWS::EC2::VPC::Id
  SubnetID:
    Description: Subnet ID
    Type: AWS::EC2::Subnet::Id
  SecurityGroupID:
    Description: Security Group
    Type: AWS::EC2::SecurityGroup::Id

Resources:
  MyEC2Instance:
    Type: "AWS::EC2::Instance"
    Properties:
      AvailabilityZone: us-east-1a
      ImageId: ami-a4c7edb2
      InstanceType: !Ref InstanceType
      SecurityGroups:
        - !Ref SecurityGroupID
      SubnetID: !Ref SubnetID

Metadata:
  # This is the important part
  AWS::CloudFormation::Interface:
    ParameterGroups:
      - Label:
          default: "Network Configuration"
        Parameters:
          - VPCID
          - SubnetID
          - SecurityGroupID
      - Label:
          default: "Amazon EC2 Configuration"
        Parameters:
          - InstanceType
          - KeyName
    ParameterLabels:
      VPCID:
        default: "Which VPC should this be deployed to?"
```

If you deploy a new stack using the above, you will see that the `Parameters` block will then drop you to questions about what configuration you are looking for.

## CFN Init and EC2 User Data

### EC2 User Data Overview

Many CF templates will be about provisioning computer resources in your AWS Cloud eg. EC2 instances, autoscaling.

Usually, you want to the instances to be self configured so that they can perform the job they are supposed to perform.

You can fully automate the EC2 fleet with CF init.

Example: an EC2 instance that has php and mysql installed on it.

We want a user-data script to get this up and going. From the EC2 management console, you can basically use the advanced section to add a `/bin/bash` section. This is already started to become more tedious than what we want.

How can we do this in CloufFormation?

The following script can use `UserData` to add the script:

```yaml
Parameters:
  KeyName:
    Description: Name of an existing EC2 key pair for SSH access to the EC2 instance.
    Type: AWS::EC2::KeyPair::KeyName
  SSHLocation:
    Description: The IP address range that can be used to SSH to the EC2 instances
    Type: String
    MinLength: '9'
    MaxLength: '18'
    Default: 0.0.0.0/0
    AllowedPattern: "(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})/(\\d{1,2})"
    ConstraintDescription: must be a valid IP CIDR range of the form x.x.x.x/x.

Resources:
  WebServer:
    Type: AWS::EC2::Instance
    Properties:
      ImageId: ami-a4c7edb2
      InstanceType: t2.micro
      KeyName: !Ref KeyName
      SecurityGroups:
        - !Ref WebServerSecurityGroup
      UserData:
        Fn::Base64: | # everything after will be kept as is
           #!/bin/bash
           yum update -y
           yum install -y httpd24 php56 mysql55-server php56-mysqlnd
           service httpd start
           chkconfig httpd on
           groupadd www
           usermod -a -G www ec2-user
           chown -R root:www /var/www
           chmod 2775 /var/www
           find /var/www -type d -exec chmod 2775 {} +
           find /var/www -type f -exec chmod 0664 {} +
           echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php

  WebServerSecurityGroup:
    Type: AWS::EC2::SecurityGroup
    Properties:
      GroupDescription: "Enable HTTP access via port 80 + SSH access"
      SecurityGroupIngress:
      - CidrIp: 0.0.0.0/0
        FromPort: '80'
        IpProtocol: tcp
        ToPort: '80'
      - CidrIp: !Ref SSHLocation
        FromPort: '22'
        IpProtocol: tcp
        ToPort: '22'
```

Now that we see the power of this, let's have a look at CF Init.

### CloudFormation Init

What is the problem with EC2 user data? Well, what happens if we have a large configuration? What if we want to evolve the state without terminating it? How do we make it readable? How do we know or signal that our EC2 user-data script actually completed successfully?

Amazon creating CF helper scripts.

There are 4 python scripts that come directly with Amazon Linux AMI or can be installed using `yum` on non-Amazon Linux. They are:

1.  cfn-init: Used to retrieve and interprety the resouce metadata, installing packages, creating files and starting services.
2.  cfn-signal: A simple wrapper to signal an AWS CloudFormation CreationPolicy or WaitCondition, enabling you to sync other resources in the stack with the application being ready. This can give us the yes/no if succssful.
3.  cfn-get-metadata: A wrapper script making it easy to retrieve either all metadata defined for a resource or path to a specific key or subtree of the resource metadata.
4.  cfn-hup: A daemon to check for updates to metadata and execute custom hooks when the changes are detected.

The usual flow? cfn-init, then cfn-signal, then optionally cfn-hup.

### AWS::CloudFormation::Init

A config contains the following and is executed in that order:

1.  Packages: install a list of packages on the Linux OS (mysql, wordpress, etc)
2.  Groups: define user groups
3.  Users: define users, and which group they belong to
4.  Sources: download an archive file and place it on the ec2 instance (tar, zip, bz2)
5.  Files: create files on the ec2 instance, using inline or can be pulled from a URL
6.  Commands: run a series of commands
7.  Services: launch a list of sysvinit

You can also have multiple configs and you can run them sequentially etc.

### Packages

You can install packages from the following repositories:

*   apt
*   msi
*   python
*   rpm
*   rubygems
*   yum

Packages are processed in the following order: rpm, yum/apt, and then rubygems and python.

You can also specify a version if you want.

```yaml
AWS::CloudFormation::Init:
  config:
    packages:
      rpm:
        epel: "http://download...."
      yum:
        httpd: [] # means latest
        php: []
        wordpress: []
      rubygems:
        chef:
          - "0.10.2" # get this version
```

### Groups and Users

If you want to have multiple users and groups (with optional gid) in your ec2 instance, you can add groups and users to CF and metadata.

```yaml
AWS::CloudFormation::Init:
  config:
    groups:
      groupeOne: {}
      groupTwo:
        gid: "45" #gid = group ID
    users:
      myUser:
        groups:
          - "groupOne"
          - "groupTwo"
        uid: "50"
        homeDir: "/tmp"
```

In the larger example...

```yaml
AWS::CloudFormation::Init:
  config:
    groups:
      apache: {} # assign any group ID
    users:
      "apache":
        groups:
          - "apache" # user apache belongs to apache
```

### Sources

These are conveninence for a compressed archieve.

```yaml
AWS::CloudFormation::Init:
  config:
    # where to unpack and from where
    sources:
      "/home/ec2-user/aws-cli": "https://github.com/aws/aws-cli/tarball/master"
```

### Files

Files can be the most used section. Almost all the full power. It can be a specific URL or written inline for what you are doing.

Base example:

```yaml
AWS::CloudFormation::Init:
  config:
    # where to unpack and from where
    files:
      /tmp/setup.mysql:
        content: !Sub |
          CREATE DATABASE ${DBName};
          CREATE USER '${DBUsername}'@'localhost' IDENTIFIED BY '${DBPassword}';
          GRANT ALL ON ${DBName}.* TO '${DBUsername}'@'localhost';
          FLUSH PRIVILEDGES;
        mode: "000644"
        owner: "root"
        group: "root"
```

Full example:

Note: !Sub is a function used for making substitution. ie where you see `${AWS::StackName}`.

```yaml
AWS::CloudFormation::Init:
  config:
    # where to unpack and from where
    files:
      "/tmp/cwlogs/apacheaccess.conf":
        content: !Sub |
          [general]
          state_file= /var/awslogs/agent-state
          [/var/log/httpd/access_log]
          file = /var/log/httpd/access_log
          log_group_name = ${AWS::StackName}
          log_stream_name = {instance_id}/apache.log
          datetime_format = %d/%b/%Y:%H:%M:%S
        mode: '000400'
        owner: apache
        group: apache
      "/var/www/html/index.php":
        content: !Sub |
          <?php
          echo '<h1>AWS CloudFormation sample PHP application for ${AWS::StackName}</h1>';
          ?>
        mode: '000644'
        owner: apache
        group: apache
      "/etc/cfn/cfn-hup.conf":
        content: !Sub |
          [main]
          stack=${AWS::StackId}
          region=${AWS::Region}
        mode: "000400"
        owner: "root"
        group: "root"
      "/etc/cfn/hooks.d/cfn-auto-reloader.conf":
        content: !Sub |
          [cfn-auto-reloader-hook]
          triggers=post.update
          path=Resources.WebServerHost.Metadata.AWS::CloudFormation::Init
          action=/opt/aws/bin/cfn-init -v --stack ${AWS::StackName} --resource WebServerHost --region ${AWS::Region}
        mode: "000400"
        owner: "root"
        group: "root"
```

### Fn::Sub

(Or as !Sub) is used to substitute variables from a text. It's a very handy function that will allow you to fully customize your templates.

For example, you can combine !Sub with References or AWS Pseudo variables.

Must be in the form `${VarName}`.

Forms:

```yaml
# You can do this
!Sub
  - String
  - { Var1Name: Var1Value, Var2Name: Var2Value }

# or (more complicated and rarely seen)
!Sub String
```

### Commands

You can run commands one at a time in the `alphabetical order`.

You can set a directory from which that command is run, environment variables etc.

You can also provide a test to control whether the command is executed or not.

This should be a last resort. You can execute any of the scripts from the above files in this section.

Example: call the echo command only if the file doesn't exist

```yaml
commands:
  test:
    command: "echo \"$MAGIC\" > test.txt"
    env:
      MAGIC: "I come from the environment!"
    cwd: "~"
    test: "test ! -e ~/test.txt" # check file exists
    ignoreErrors: "false" # fail if is doesn't work
```

### Services

```yaml
AWS::CloudFormation::Init:
  config:
    services:
      sysvinit:
        httpd:
          enabled: 'true'
          ensureRunning: 'true'
        sendmail:
          enabled: 'false'
          ensureRunning: 'false'
```

### CFN Init and Signal

First, we use `cfn-init` to launch the config.

Then we use `cfn-signal` to tell when the config is complete, which will let CF know that the resource creation has been successful.

This has to be used in conjuction with a `CreationPolicy`.

This example means waiting a max of 5 minutes for the instance to come online and be self configured. If we don't hear back by `cfn-signal` by the, CF will fail and rollback.

```yaml
CreationPolicy:
  ResourceSignal:
    Timeout: PT5M
```

This is useful in case of a bad update.

### cfn-hup

*   Cfn-hup can be used to tell your EC2 instance to look for Metadata changes every 15 minutes and apply the metadata configuration again.
*   It's very powerful but you really need to try it out to understand how it works.

Example from the "files" declation:

```yaml
"/etc/cfn/cfn-hup.conf":
  content: !Sub |
    [main]
    stack=${AWS::StackId}
    region=${AWS::Region}
  mode: "000400"
  owner: "root"
  group: "root"
"/etc/cfn/hooks.d/cfn-auto-reloader.conf":
  content: !Sub |
    [cfn-auto-reloader-hook]
    triggers=post.update
    path=Resources.WebServerHost.Metadata.AWS::CloudFormation::Init
    action=/opt/aws/bin/cfn-init -v --stack ${AWS::StackName} --resource WebServerHost --region ${AWS::Region}
  mode: "000400"
  owner: "root"
```

### CFN Init Hands-On

After loading the CFN Init yaml file into CF, it will go through a series of different events.

You can under "status reason" if there is a success message sent back.

You need to practise your !Init skilles. It will be extremely handy for creating EC2 Instances or AutoScaling groups.

Remember logs for ec2-user data are in `/var/log/cloud-init-output.log` and logs for cfn-init are in `/var/log/cfn-init.log`, which is really helpful if commands don't complete like you want them to.

## Advanced CF Concepts

Review of current standing:

*   You can check AWS labs templates from `https://github/com/awslabs/aws-cloudformation-templates` to see what you can understand/see good practise.

The example with WordPress is what is shown in the course.

### Using the AWS CLI

We can use the AWS CLI to create, update or delete CF templates.

Super conventient for when you start automating your deployments.

Once you've downloaded the AWS config, use `aws configure --profile <profile_name>` to configure a profile with the ID and Secret Access key.

To run a CF command, you can use something like the following `aws cloudformation create-stack --stack-name example-cli-stack --template-body file://0-sample-template.yaml --parameters file://0-parameters.json --profile cf-course --region us-east-1`

We can use the `parameters.json` file to set ParameterKey and ParameterValue for all the keys and values we are looking to share.

After running the command, what you get back is the `StackId`.

### Using Troposphere (Python) to generate CloudFormation templates

Troposhere allows you to leverage Python write the templates.

This means you can start using types in your templates for safety.

You will also have valid CF and can dynamically generate CloudFormation.

This means you can also have very complex conditions.

The disadvantage is that the Python needs to generate the JSON for it to be.

### DeletionPolicy

This policy can prevent resources from being deleted, or in some cases, back them up before the deletion. This will help prevent doing something really, really bad.

Deletion Policy can take up the following values:

1.  Delete: AWS CloudFormation will delete the resource and all its content if applicable during stack deletion (does not apply to S3)
2.  Retain: AWS CloudFormation keeps the resource without deleting the resource or its contents when its stack is deleted. You can add this deletion policy to any resource type.
3.  Snapshot: For resources that support snapshots (AWS::EC2::Volume, AWS::ElasticCache::CacheCluster etc)

```yaml
Resources:
  myS3Bucket:
    Type: AWS::S3::Bucket
    DeletionPolicy: Retain
```

In the above example, it will create the S3 Bucket, you will see the bucket created.

Now if we delete that stack and the deletion policy is retain, you will still have that bucket there.

### Custom Resources with AWS Lambda

Custom resources enable you to write custom provisioning logic in templates that AWS CloudFormation runs anytime you create, update (if you changed the custom resource) or delete stacks.

For example, you might want to include resources that aren't available as AWS CloudFormation resource types.

Check online for a walkthrough of custom resources.

### Best practises to organize your CloudFormation templates

1.  How to organise templates: you can have a layered architecture (horizontal layers) vs service oriented architecture (vertical layers).
2.  Use cross stack references eg. to reference a VPC or subnet.
3.  Make sure the template is environment agnostic to do dev / test / prod and across regions / accounts seemlessly.
4.  Never embed credentials (use parameters with NoEcho or KMS).
5.  Use specific parameters types and constraints.
6.  Use CFN Init (& latest version of the helper scripts)
7.  Validate templates
8.  Don't do anything manual on the elements of the stack - that can cause a state mismatch.
9.  Verify changes with changesets (and avoid disasters).
10. Use stack policies to prevent critical components from being deleted after create (such as your most valuable RDS database).

### Cost estimate for templates

You can estimate the cost of a stack very easily.

For this, just upload the stack onto the AWS console, enter the params and click "cost".
