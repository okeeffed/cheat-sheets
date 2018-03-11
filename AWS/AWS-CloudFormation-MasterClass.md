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
3. Mappings: the static variables for your template
4. Outputs: References to what has been created
5. Conditionals: List of conditions to perform resource creation
6. Metadata

## Template helpers 

1. References 
2. Functions 

## CloudFormation Parameters 

### Overview 

What are they? The way to provide inputs to your AWS CloudFormation template.

They're important to know about it:

1. You want to reuse your templates across the company 
2. Some inputs can not be determined ahead of time

The major benefit: you won't have to re-upload a template to change its content.

### Theory and hands on 

Parameters can be controlled by all these settings:

1. Type:
- String
- Number
- CommaDelimitedList
- List<Type>
- AWS Parameter (to help catch invalid values - match against existing values in the AWS Account)
2. Description 
3. Constraints 
4. ConstraintDescription (String)
5. Min/MaxLength
6. Min/MaxValue
7. Defaults 
8. AllowedValues (array)
9. AllowedPattern (regexp)
10. NoEcho (Boolean)

This can be found in the `0-parameters-hands-on.yaml`.

Again - check the docs.

To reference a parameter, you then go with `Key: !Ref Reference`.

If you have `!Select` for a CommaDelimitedList, you need to go `Key: !Select [ArrayNumber, !Ref Reference]`.

## How to reference a parameter 

- Using the Fn::Ref function. 
- Shorthand in YAML is !Ref.
- Can reference block, not just parameter

## Resources 

Resources are the core of your CloudFormation template. They represent the different AWS Components that will be created and configured.

They are declared and can be references by eachother. AWS figures out creation, updates, deletes etc.

There are over 224 types of resources.

They are identified using the form `AWS::aws-product-name::data-type-name`.

### Reading the docs for an ES2 Instance 

If you look at the docs, if comes up with both JSON and YAML docs.

### Optional Attributes for Resources 

1. DependsOn: very useful to draw a dependency between two resources. For example, only create an ECS cluster after creating an ASG (auto scaling group).
2. DeletionPolicy: protect resource from being deleted even if cloudformation is deleted.
3. CreationPolicy: more info on CFN
4. Metadata: anything you want!

### FAQ for resources 

1. Can I create a dynamic a dynamic amount of resources? No you can perform code generation. The work around is the `troposphere` Python library.
2. Is every AWS Service supported? Almost. Only a select few niches are not there.

## Mappings

What are mappings? Fixed ariables within your CF Template. Great for dev vs prod, regions, AMI types etc.

Every mapping has top, middle and bottom.

Great to use when you know in advance:
- Region
- AZ
- AWSAccount
- Environment (dev vs prod)

They allow safer control over the template. Use parameters when the values are _really_ user specific.

### Fn::FindInMap - Accessing Mapping Values

Use Fn::FindInMap to return a named value from a specific key.

- !FindInMap [ MapName, TopLevelKey, SecondLevelKey ]

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

- AWS offers us pseudo params in any CF template.
- These can be used at any time and are enabled by default.

1. AWS::AccountId
2. AWS::NotificationsARNs
3. AWS::NoValue 
4. AWS::Region
5. AWS::StackId
6. AWS::StackName

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

- Environment (dev/test/prod)
- AWS Region 
- Any parameter value 

Each condition can reference another condition, parameter value or mapping.

### How to define a condition?

```yaml
Conditions:
    [Logical ID]:
        [Intrinsic function]
```

Logical ID is for you to choose. It's how you name the condition.

The intrinsic function (logical) can be any of the following: 
    - Fn::And
    - Fn::Equals
    - Fn::If
    - Fn::Not
    - Fn::Or

## Conditional Hands On 

- Let's analyze a CF template that optionally creates a volume and mount point only if "prod" is specified as a parameter.
- It utilizes params, mappings, conditionals, outputs

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

1. AWS::CloudFormation::Designer

Describes how the resources are laid out in your template. This is automatically added by the AWS Designer. This helps the UI (x and y)

2. AWS::CloudFormation::Interface

Define grouping and ordering of input parameters when they are displayed in the AWS Console.

3. AWS::CloudFormation::Init

Define configuration tasks for cfn-init. It's the most powerful usage of the metadata. This is very important and a lot to learn about it below.

### AWS::CloudFormation::Designer hands on