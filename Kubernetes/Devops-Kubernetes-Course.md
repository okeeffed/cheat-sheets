# DevOps Kubernetes Course

<!-- TOC -->

- [DevOps Kubernetes Course](#devops-kubernetes-course)
    - [Course layout](#course-layout)
        - [Objectives](#objectives)
        - [Support](#support)
        - [Getting Started](#getting-started)
        - [Procedure Document](#procedure-document)
    - [What is Kubernetes?](#what-is-kubernetes)
    - [Containers intro](#containers-intro)
    - [Kubernetes Setup](#kubernetes-setup)
        - [Running locally](#running-locally)
            - [Minikube](#minikube)
        - [Running on AWS](#running-on-aws)
        - [Cluster setup on Kops](#cluster-setup-on-kops)
    - [KOPS QuickList](#kops-quicklist)
        - [Building Docker Containers](#building-docker-containers)
        - [Docker registery](#docker-registery)
        - [Running the Docker app on Kubernetes](#running-the-docker-app-on-kubernetes)
        - [How to port-forward](#how-to-port-forward)
        - [Exposing the pod](#exposing-the-pod)
        - [Setting up the external load balancer](#setting-up-the-external-load-balancer)
    - [Kubernetes Basics](#kubernetes-basics)
        - [Node Architecture](#node-architecture)
        - [Replication Controller](#replication-controller)
            - [Scaling](#scaling)
    - [Deployments](#deployments)
        - [Useful commands](#useful-commands)
        - [Demo: Deployment notes](#demo--deployment-notes)
    - [Services](#services)
    - [Tags](#tags)
        - [Demo: Using tags](#demo--using-tags)
    - [Healthchecks](#healthchecks)
    - [Secrets](#secrets)
        - [How to use them](#how-to-use-them)
        - [Demo: Wordpress Secrets](#demo--wordpress-secrets)
    - [Web UI](#web-ui)
        - [Demo: Web UI](#demo--web-ui)
- [Advanced Topics](#advanced-topics)
    - [Service Discovery](#service-discovery)
        - [Demo: Service Discovery](#demo--service-discovery)
    - [ConfigMap](#configmap)
        - [Demo: Config Map](#demo--config-map)
    - [Ingress Controller](#ingress-controller)
        - [Demo: Ingress Controller](#demo--ingress-controller)
    - [Volumes](#volumes)
        - [Using EBS Storage](#using-ebs-storage)
        - [Demo: Volumes](#demo--volumes)
    - [Volume Provisioning](#volume-provisioning)
    - [Demo: Using Wordpress with Volumes](#demo--using-wordpress-with-volumes)
    - [Pet Sets](#pet-sets)
    - [Daemon Sets](#daemon-sets)

<!-- /TOC -->

## Course layout

1.  Introduction
2.  Kubernetes Basics
3.  Advanced Topics
4.  Administration

### Objectives

1.  To understand, deploy and use Kubernetes
2.  To get straight with `containerization` and run those containers on Kubernetes
3.  To use Kubernetes as a single node and on AWS
4.  To be able to run `stateless` and `stateful` applications on Kubernetes
5.  To be able to `administer` Kubernetes

### Support

All resources are in a github repository.

### Getting Started

kubectl: Install via brew
minikube: https://github.com/kubernetes/minikube/releases
kops: Install via brew

Minikube test commands:

```bash
minikube status # check status
minikube start # start cluster
```

For OSX install:

`curl -Lo minikube https://storage.googleapis.com/minikube/releases/v0.25.0/minikube-darwin-amd64 && chmod +x minikube && sudo mv minikube /usr/local/bin/`

Install Docker Edge to use the latest features with Kubernetes.

Otherwise follow the base instructions to get everything up and going.

`https://gist.github.com/kevin-smets/b91a34cea662d0c523968472a81788f7`

This resolves DL issue: `mv minikube-v0.25.1.iso ~/.minikube/cache/iso/minikube-v0.25.1.iso`.

### Procedure Document

```
Kubernetes Procedure Document
Github repository [Read this first]
Download all the course material from: https://github.com/wardviaene/kubernetes-course

Questions?
Send me a message

Use Q&A

Join our facebook group: https://www.facebook.com/groups/840062592768074/

Download Kubectl
Linux: https://storage.googleapis.com/kubernetes-release/release/v1.6.1/bin/linux/amd64/kubectl

MacOS: https://storage.googleapis.com/kubernetes-release/release/v1.6.1/bin/darwin/amd64/kubectl

Windows:
https://github.com/eirslett/kubectl-windows/releases/download/v1.6.3/kubectl.exe

Minikube
Project URL: https://github.com/kubernetes/minikube

Latest Release and download instructions: https://github.com/kubernetes/minikube/releases

VirtualBox: http://www.virtualbox.org

Minikube on windows:
Download the latest minikube-version.exe

Rename the file to minikube.exe and put it in C:\minikube

Open a cmd (search for the app cmd or powershell)

Run: cd C:\minikube and enter minikube start

Test your cluster commands
Make sure your cluster is running, you can check with minikube status.

If your cluster is not running, enter minikube start first.

kubectl run hello-minikube --image=gcr.io/google_containers/echoserver:1.4 --port=8080
kubectl expose deployment hello-minikube --type=NodePort

minikube service hello-minikube --url

<open a browser and go to that url>

Kops
Project URL
https://github.com/kubernetes/kops

Free DNS Service
Sign up at http://freedns.afraid.org/

Choose for subdomain hosting

Enter the AWS nameservers given to you in route53 as nameservers for the subdomain

http://www.dot.tk/ provides a free .tk domain name you can use and you can point it to the amazon AWS nameservers

###h2

Namecheap.com often has promotions for tld’s like .co for just a couple of bucks



Cluster Commands
kops create cluster --name=kubernetes.newtech.academy --state=s3://kops-state-b429b --zones=eu-west-1a --node-count=2 --node-size=t2.micro --master-size=t2.micro --dns-zone=kubernetes.newtech.academy

kops update cluster kubernetes.newtech.academy --yes --state=s3://kops-state-b429b

kops delete cluster --name kubernetes.newtech.academy --state=s3://kops-state-b429b

kops delete cluster --name kubernetes.newtech.academy --state=s3://kops-state-b429b --yes

Kubernetes from scratch






You can setup your cluster manually from scratch

If you’re planning to deploy on AWS / Google / Azure, use the tools that are fit for these platforms

If you have an unsupported cloud platform, and you still want Kubernetes, you can install it manually

CoreOS + Kubernetes: ###a href="https://coreos.com/kubernetes/docs/latest/getting-started.html">https://coreos.com/kubernetes/docs/latest/getting-started.html

Docker
You can download Docker Engine for:

Windows: https://docs.docker.com/engine/installation/windows/

MacOS: https://docs.docker.com/engine/installation/mac/

Linux: https://docs.docker.com/engine/installation/linux/

DevOps box
Virtualbox: http://www.virtualbox.org

Vagrant: http://www.vagrantup.com

DevOps box: https://github.com/wardviaene/devops-box

Launch commands (in terminal / cmd / powershell):

cd devops-box/

vagrant up

Launch commands for a plain ubuntu box:

mkdir ubuntu

vagrant init ubuntu/xenial64

vagrant up

Docker commands
Description

Command

Build image

docker build .

Build & Tag

docker build -t wardviaene/k8s-demo:latest .

Tag image

docker tag imageid wardviaene/k8s-demo

Push image

docker push wardviaene/k8s-demo

List images

docker images

List all containers

docker ps -a

Kubernetes commands
Command

Description

kubectl get pod

Get information about all running pods

kubectl describe pod <pod>

Describe one pod

kubectl expose pod <pod> --port=444

--name=frontend

Expose the port of a pod (creates a new service)

kubectl port-forward <pod> 8080

Port forward the exposed pod port to your local machine

kubectl attach <podname> -i

Attach to the pod

kubectl exec <pod> -- command

Execute a command on the pod

kubectl label pods <pod> mylabel=awesome

Add a new label to a pod

kubectl run -i --tty busybox --image=busybox

--restart=Never -- sh

Run a shell in a pod - very useful for debugging

kubectl get deployments

Get information on current deployments

kubectl get rs

Get information about the replica sets

kubectl get pods --show-labels

get pods, and also show labels attached to those pods

kubectl rollout status deployment/helloworld-deployment

Get deployment status

kubectl set image deployment/helloworld-deployment

k8s-demo=k8s-demo:2

Run k8s-demo with the image label version 2

kubectl edit deployment/helloworld-deployment

Edit the deployment object

kubectl rollout status deployment/helloworld-deployment

Get the status of the rollout

kubectl rollout history deployment/helloworld-deployment

Get the rollout history

kubectl rollout undo deployment/helloworld-deployment

Rollback to previous version

kubectl rollout undo deployment/helloworld-deployment --to-revision=n

Rollback to any version version

AWS Commands
aws ec2 create-volume --size 10 --region us-east-1 --availability-zone us-east-1a --volume-type gp2

Certificates
Creating a new key for a new user: openssl genrsa -out myuser.pem 2048

Creating a certificate request: openssl req -new -key myuser.pem -out myuser-csr.pem -subj "/CN=myuser/O=myteam/"

Creating a certificate: openssl x509 -req -in myuser-csr.pem -CA /path/to/kubernetes/ca.crt -CAkey /path/to/kubernetes/ca.key -CAcreateserial -out myuser.crt -days 10000
```

## What is Kubernetes?

Open source orchestration system for Docker.

*   Let's you schedule containers on a cluster of machines
*   You can run multiple containers on one machine
*   You can run long running services (like web apps)
*   K8s will manage the state of these containers
    *   Can start the container on specific nodes
    *   Will restart a container when it gets killed
    *   Can move containers from one node to another node
*   Instead of just running a few docker containers on one host manually, K8s can manage that for you
*   K8 clusters can go to thousands of nodes
*   Other orcherstrators:
    *   Docker Swarm
    *   Mesos

You can run K8s anywhere:

*   One premise (private)
*   Public
*   Hybrid

It is highly modular and open source. It is also backed by Google.

## Containers intro

Container VS VM: No Hypervisor and Guest OS layer.

Containers on Cloud Providers do still use the hypervisor to seperate users.

Docker is the most popular container software. An alternative is `rkt`.

Benefits? It works in isolation. You ship the binary with all the dependencies and create a closer parity.

Docker makes development teams able to ship faster.

You can run the same image on prem and in the cloud with what should be the same results.

## Kubernetes Setup

Something to note is that there are more integrations for certain Cloud Providers like AWS & GCE. Thingsl ike "Volumes" and "External Load Balancers" work only with support Cloud Providers.

### Running locally

We can use `minikube` to spin up a local single machine with a Kubernetes cluster.

#### Minikube

Minikube is a tool that makes running k8s locally easy.

It runs a single-node Kubernetes cluster inside a Linux VM.

It's aimed on users who just want to just test it out or use if for development.

It cannot spin up a roduction cluster, it's a one node machine with no high availability.

You need VM to run all this.

To run a cluster, just run `minikube start`.

To check your config after spinning up Kubernetes, use `cat ~/.kube/config`.

### Running on AWS

Until EKS comes out, we can spin up a Kubernetes cluster using KOPS.

You need to ensure that you download Vagrant and a VM.

For running the Vagrant box, you can run `vagrant up --provider virtualbox`.

You can then use `vagrant ssh` to ssh in.

After you are in, download Kops:

```
curl -LO https://github.com/kubernetes/kops/releases/download/$(curl -s https://api.github.com/repos/kubernetes/kops/releases/latest | grep tag_name | cut -d '"' -f 4)/kops-linux-amd64
chmod +x kops-linux-amd64
sudo mv kops-linux-amd64 /usr/local/bin/kops
```

Ensure that you also download `python-pip`:

```
sudo apt-get install software-properties-common
sudo apt-add-repository universe
sudo apt-get update
sudo apt-get install python-pip
```

Then install awscli:

```
export LC_ALL=C # if run into an error about locale settings
sudo pip install awscli
```

You will then need to create an AWS account.

After setting up the AWSCLI, installing Kops and creating a S3 Bucket + setting up the Route53 Name Servers (on somewhere like NameCheap), you can move on.

### Cluster setup on Kops

First, download Kops for Linux on the Vagrant box and move it.

Before creating the cluster, you will need to create new keys. `ssh-keygen -f .ssh/id_rsa`.

To create the cluster (example), run `kops create cluster --name=kubernetes.test --state=s3://kops-state-oeiajrie93 --zones=ap-southeast-2a --node-count=2 --node-size=t2.micro --master-size=t2.micro --dns-zone=givemeyeezy.online`

This DNS zone is basically just the one that we set up.

You'll get something back like

```
I0311 21:48:46.821364    7553 create_cluster.go:439] Inferred --cloud=aws from zone "ap-southeast-2a"
I0311 21:48:46.821506    7553 create_cluster.go:971] Using SSH public key: /home/vagrant/.ssh/id_rsa.pub
I0311 21:48:48.232635    7553 subnets.go:184] Assigned CIDR 172.20.32.0/19 to subnet ap-southeast-2a
Previewing changes that will be made:

I0311 21:48:52.305360    7553 executor.go:91] Tasks: 0 done / 73 total; 31 can run
I0311 21:48:53.503124    7553 executor.go:91] Tasks: 31 done / 73 total; 24 can run
I0311 21:48:53.958875    7553 executor.go:91] Tasks: 55 done / 73 total; 16 can run
I0311 21:48:54.237870    7553 executor.go:91] Tasks: 71 done / 73 total; 2 can run
I0311 21:48:54.262347    7553 executor.go:91] Tasks: 73 done / 73 total; 0 can run
Will create resources:
  AutoscalingGroup/master-ap-southeast-2a.masters.kubernetes.test
  MinSize             	1
  MaxSize             	1
  Subnets             	[name:ap-southeast-2a.kubernetes.test]
  Tags                	{k8s.io/role/master: 1, Name: master-ap-southeast-2a.masters.kubernetes.test, KubernetesCluster: kubernetes.test, k8s.io/cluster-autoscaler/node-template/label/kops.k8s.io/instancegroup: master-ap-southeast-2a}
  LaunchConfiguration 	name:master-ap-southeast-2a.masters.kubernetes.test

  AutoscalingGroup/nodes.kubernetes.test
  MinSize             	2
  MaxSize             	2
  Subnets             	[name:ap-southeast-2a.kubernetes.test]
  Tags                	{k8s.io/cluster-autoscaler/node-template/label/kops.k8s.io/instancegroup: nodes, k8s.io/role/node: 1, Name: nodes.kubernetes.test, KubernetesCluster: kubernetes.test}
  LaunchConfiguration 	name:nodes.kubernetes.test

  DHCPOptions/kubernetes.test
  DomainName          	ap-southeast-2.compute.internal
  DomainNameServers   	AmazonProvidedDNS

  EBSVolume/a.etcd-events.kubernetes.test
  AvailabilityZone    	ap-southeast-2a
  VolumeType          	gp2
  SizeGB              	20
  Encrypted           	false
  Tags                	{KubernetesCluster: kubernetes.test, k8s.io/etcd/events: a/a, k8s.io/role/master: 1, Name: a.etcd-events.kubernetes.test}

  EBSVolume/a.etcd-main.kubernetes.test
  AvailabilityZone    	ap-southeast-2a
  VolumeType          	gp2
  SizeGB              	20
  Encrypted           	false
  Tags                	{k8s.io/etcd/main: a/a, k8s.io/role/master: 1, Name: a.etcd-main.kubernetes.test, KubernetesCluster: kubernetes.test}

  IAMInstanceProfile/masters.kubernetes.test

  IAMInstanceProfile/nodes.kubernetes.test

  IAMInstanceProfileRole/masters.kubernetes.test
  InstanceProfile     	name:masters.kubernetes.test id:masters.kubernetes.test
  Role                	name:masters.kubernetes.test

  IAMInstanceProfileRole/nodes.kubernetes.test
  InstanceProfile     	name:nodes.kubernetes.test id:nodes.kubernetes.test
  Role                	name:nodes.kubernetes.test

  IAMRole/masters.kubernetes.test
  ExportWithID        	masters

  IAMRole/nodes.kubernetes.test
  ExportWithID        	nodes

  IAMRolePolicy/masters.kubernetes.test
  Role                	name:masters.kubernetes.test

  IAMRolePolicy/nodes.kubernetes.test
  Role                	name:nodes.kubernetes.test

  InternetGateway/kubernetes.test
  VPC                 	name:kubernetes.test
  Shared              	false

  Keypair/apiserver-aggregator
  Subject             	cn=aggregator
  Type                	client
  Signer              	name:apiserver-aggregator-ca id:cn=apiserver-aggregator-ca

  Keypair/apiserver-aggregator-ca
  Subject             	cn=apiserver-aggregator-ca
  Type                	ca

  Keypair/apiserver-proxy-client
  Subject             	cn=apiserver-proxy-client
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/ca
  Subject             	cn=kubernetes
  Type                	ca

  Keypair/kops
  Subject             	o=system:masters,cn=kops
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kube-controller-manager
  Subject             	cn=system:kube-controller-manager
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kube-proxy
  Subject             	cn=system:kube-proxy
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kube-scheduler
  Subject             	cn=system:kube-scheduler
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kubecfg
  Subject             	o=system:masters,cn=kubecfg
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kubelet
  Subject             	o=system:nodes,cn=kubelet
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/kubelet-api
  Subject             	cn=kubelet-api
  Type                	client
  Signer              	name:ca id:cn=kubernetes

  Keypair/master
  Subject             	cn=kubernetes-master
  Type                	server
  AlternateNames      	[100.64.0.1, 127.0.0.1, api.internal.kubernetes.test, api.kubernetes.test, kubernetes, kubernetes.default, kubernetes.default.svc, kubernetes.default.svc.cluster.local]
  Signer              	name:ca id:cn=kubernetes

  LaunchConfiguration/master-ap-southeast-2a.masters.kubernetes.test
  ImageID             	kope.io/k8s-1.8-debian-jessie-amd64-hvm-ebs-2018-01-14
  InstanceType        	t2.micro
  SSHKey              	name:kubernetes.kubernetes.test-e8:be:8d:cf:90:3b:52:6e:f7:23:29:0a:32:d1:cd:de id:kubernetes.kubernetes.test-e8:be:8d:cf:90:3b:52:6e:f7:23:29:0a:32:d1:cd:de
  SecurityGroups      	[name:masters.kubernetes.test]
  AssociatePublicIP   	true
  IAMInstanceProfile  	name:masters.kubernetes.test id:masters.kubernetes.test
  RootVolumeSize      	64
  RootVolumeType      	gp2
  SpotPrice

  LaunchConfiguration/nodes.kubernetes.test
  ImageID             	kope.io/k8s-1.8-debian-jessie-amd64-hvm-ebs-2018-01-14
  InstanceType        	t2.micro
  SSHKey              	name:kubernetes.kubernetes.test-e8:be:8d:cf:90:3b:52:6e:f7:23:29:0a:32:d1:cd:de id:kubernetes.kubernetes.test-e8:be:8d:cf:90:3b:52:6e:f7:23:29:0a:32:d1:cd:de
  SecurityGroups      	[name:nodes.kubernetes.test]
  AssociatePublicIP   	true
  IAMInstanceProfile  	name:nodes.kubernetes.test id:nodes.kubernetes.test
  RootVolumeSize      	128
  RootVolumeType      	gp2
  SpotPrice

  ManagedFile/kubernetes.test-addons-bootstrap
  Location            	addons/bootstrap-channel.yaml

  ManagedFile/kubernetes.test-addons-core.addons.k8s.io
  Location            	addons/core.addons.k8s.io/v1.4.0.yaml

  ManagedFile/kubernetes.test-addons-dns-controller.addons.k8s.io-k8s-1.6
  Location            	addons/dns-controller.addons.k8s.io/k8s-1.6.yaml

  ManagedFile/kubernetes.test-addons-dns-controller.addons.k8s.io-pre-k8s-1.6
  Location            	addons/dns-controller.addons.k8s.io/pre-k8s-1.6.yaml

  ManagedFile/kubernetes.test-addons-kube-dns.addons.k8s.io-k8s-1.6
  Location            	addons/kube-dns.addons.k8s.io/k8s-1.6.yaml

  ManagedFile/kubernetes.test-addons-kube-dns.addons.k8s.io-pre-k8s-1.6
  Location            	addons/kube-dns.addons.k8s.io/pre-k8s-1.6.yaml

  ManagedFile/kubernetes.test-addons-limit-range.addons.k8s.io
  Location            	addons/limit-range.addons.k8s.io/v1.5.0.yaml

  ManagedFile/kubernetes.test-addons-rbac.addons.k8s.io-k8s-1.8
  Location            	addons/rbac.addons.k8s.io/k8s-1.8.yaml

  ManagedFile/kubernetes.test-addons-storage-aws.addons.k8s.io-v1.6.0
  Location            	addons/storage-aws.addons.k8s.io/v1.6.0.yaml

  ManagedFile/kubernetes.test-addons-storage-aws.addons.k8s.io-v1.7.0
  Location            	addons/storage-aws.addons.k8s.io/v1.7.0.yaml

  Route/0.0.0.0/0
  RouteTable          	name:kubernetes.test
  CIDR                	0.0.0.0/0
  InternetGateway     	name:kubernetes.test

  RouteTable/kubernetes.test
  VPC                 	name:kubernetes.test

  RouteTableAssociation/ap-southeast-2a.kubernetes.test
  RouteTable          	name:kubernetes.test
  Subnet              	name:ap-southeast-2a.kubernetes.test

  SSHKey/kubernetes.kubernetes.test-e8:be:8d:cf:90:3b:52:6e:f7:23:29:0a:32:d1:cd:de
  KeyFingerprint      	c4:89:af:59:a1:1d:6e:ef:7a:9d:12:65:bc:e2:82:4f

  Secret/admin

  Secret/kube

  Secret/kube-proxy

  Secret/kubelet

  Secret/system:controller_manager

  Secret/system:dns

  Secret/system:logging

  Secret/system:monitoring

  Secret/system:scheduler

  SecurityGroup/masters.kubernetes.test
  Description         	Security group for masters
  VPC                 	name:kubernetes.test
  RemoveExtraRules    	[port=22, port=443, port=2380, port=2381, port=4001, port=4002, port=4789, port=179]

  SecurityGroup/nodes.kubernetes.test
  Description         	Security group for nodes
  VPC                 	name:kubernetes.test
  RemoveExtraRules    	[port=22]

  SecurityGroupRule/all-master-to-master
  SecurityGroup       	name:masters.kubernetes.test
  SourceGroup         	name:masters.kubernetes.test

  SecurityGroupRule/all-master-to-node
  SecurityGroup       	name:nodes.kubernetes.test
  SourceGroup         	name:masters.kubernetes.test

  SecurityGroupRule/all-node-to-node
  SecurityGroup       	name:nodes.kubernetes.test
  SourceGroup         	name:nodes.kubernetes.test

  SecurityGroupRule/https-external-to-master-0.0.0.0/0
  SecurityGroup       	name:masters.kubernetes.test
  CIDR                	0.0.0.0/0
  Protocol            	tcp
  FromPort            	443
  ToPort              	443

  SecurityGroupRule/master-egress
  SecurityGroup       	name:masters.kubernetes.test
  CIDR                	0.0.0.0/0
  Egress              	true

  SecurityGroupRule/node-egress
  SecurityGroup       	name:nodes.kubernetes.test
  CIDR                	0.0.0.0/0
  Egress              	true

  SecurityGroupRule/node-to-master-tcp-1-2379
  SecurityGroup       	name:masters.kubernetes.test
  Protocol            	tcp
  FromPort            	1
  ToPort              	2379
  SourceGroup         	name:nodes.kubernetes.test

  SecurityGroupRule/node-to-master-tcp-2382-4000
  SecurityGroup       	name:masters.kubernetes.test
  Protocol            	tcp
  FromPort            	2382
  ToPort              	4000
  SourceGroup         	name:nodes.kubernetes.test

  SecurityGroupRule/node-to-master-tcp-4003-65535
  SecurityGroup       	name:masters.kubernetes.test
  Protocol            	tcp
  FromPort            	4003
  ToPort              	65535
  SourceGroup         	name:nodes.kubernetes.test

  SecurityGroupRule/node-to-master-udp-1-65535
  SecurityGroup       	name:masters.kubernetes.test
  Protocol            	udp
  FromPort            	1
  ToPort              	65535
  SourceGroup         	name:nodes.kubernetes.test

  SecurityGroupRule/ssh-external-to-master-0.0.0.0/0
  SecurityGroup       	name:masters.kubernetes.test
  CIDR                	0.0.0.0/0
  Protocol            	tcp
  FromPort            	22
  ToPort              	22

  SecurityGroupRule/ssh-external-to-node-0.0.0.0/0
  SecurityGroup       	name:nodes.kubernetes.test
  CIDR                	0.0.0.0/0
  Protocol            	tcp
  FromPort            	22
  ToPort              	22

  Subnet/ap-southeast-2a.kubernetes.test
  VPC                 	name:kubernetes.test
  AvailabilityZone    	ap-southeast-2a
  CIDR                	172.20.32.0/19
  Shared              	false
  Tags                	{Name: ap-southeast-2a.kubernetes.test, KubernetesCluster: kubernetes.test, kubernetes.io/cluster/kubernetes.test: owned, kubernetes.io/role/elb: 1}

  VPC/kubernetes.test
  CIDR                	172.20.0.0/16
  EnableDNSHostnames  	true
  EnableDNSSupport    	true
  Shared              	false
  Tags                	{Name: kubernetes.test, KubernetesCluster: kubernetes.test, kubernetes.io/cluster/kubernetes.test: owned}

  VPCDHCPOptionsAssociation/kubernetes.test
  VPC                 	name:kubernetes.test
  DHCPOptions         	name:kubernetes.test

Must specify --yes to apply changes

Cluster configuration has been created.

Suggestions:
 * list clusters with: kops get cluster
 * edit this cluster with: kops edit cluster kubernetes.test
 * edit your node instance group: kops edit ig --name=kubernetes.test nodes
 * edit your master instance group: kops edit ig --name=kubernetes.test master-ap-southeast-2a

Finally configure your cluster with: kops update cluster kubernetes.test --yes
```

To edit the cluster, run `kops edit cluster kubernetes.test --state=s3://kops-state-oeiajrie93` and then to update run `kops update cluster kubernetes.test --yes --state=s3://kops-state-oeiajrie93`

If we now run `cat ~/.kube/config` we can see the password and username information needed.

To check if the nodes are up, run `kubectl get node`.

Then, we can again run `kubectl run hello-minikube ...`

If you have issues hit up `https://www.digitalocean.com/community/tutorials/how-to-set-up-time-synchronization-on-ubuntu-16-04` for date syncing.

## KOPS QuickList

```
# create
kops create cluster --name=doksandbox.com --state=s3://kops-state-doksandbox --zones=ap-southeast-2a --node-count=2 --node-size=t2.micro --master-size=t2.micro --dns-zone=doksandbox.com

# edit
kops edit cluster doksandbox.com --state=s3://kops-state-doksandbox

# update
kops update cluster doksandbox.com --yes --state=s3://kops-state-doksandbox

# delete
kops delete cluster doksandbox.com --yes --state=s3://kops-state-doksandbox

# suggestions
kops validate cluster --state=s3://kops-state-doksandbox  # validate cluster
kubectl get nodes --show-labels # list nodes
ssh -i ~/.ssh/id_rsa admin@api.kubernetes.doksandbox.com # ssh to the master
The admin user is specific to Debian. If not using Debian please use the appropriate user based on your OS.

# check DNS
dig afxr doksandbox.com
```

To get a basic service up and running, hit `kubectl run hello-minikube --image=gcr.io/google_containers/echoserver:1.4 --port=8080` and head to the VPC security network to update and expose that port to all IPs to prove that is all works correctly. The port will be dynamic.

### Building Docker Containers

If installing onto Linux, check `https://docs.docker.com/install/linux/docker-ce/ubuntu/#install-docker-ce-1`

To do a demo, `sudo apt-get install git` and `git clone https://github.com/wardviaene/docker-demo` to get a demo folder.

Change in, `sudo docker build .` and then to run the container use `docker run -p 3000:3000 -t <id>`

### Docker registery

To upload to the registry:

```
docker login # fill in login details
docker tag imageid okeeffed/docker-demo
docker push okeeffed/docker-demo
```

There are a few limitations for each Docker/Kubernetes relationship:

1.  Don't try to create one giant docker image fo you app, but split it up if necessary.
2.  All data in the container is not preserved. You need volumes for this.
3.  Check 12factor.net for methodologies

### Running the Docker app on Kubernetes

We need to create a `pod definition`.

This describes an application running on Kubernetes.

A pod can container _one or more tightly coupled containers_ that make up the app.

Those apps can easily communicate with each other using their local **port numbers**.

The app for us at the moment has only one container.

To build this, we create a podfile with all the pod definition:

```yaml
# pod-helloworld.yml
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  containers:
  - name: k8s-demo
    image: okeeffed/docker-demo
    ports:
    - containerPort: 3000
```

To create this pod, we run `kubectl create -f ./pod-helloworld.yml`

**Some useful commands**

| Command                                                           | Description                                      |
| ----------------------------------------------------------------- | ------------------------------------------------ |
| kubectl get pod                                                   | Get info about all running pods                  |
| kubectl describe pod <pod>                                        | Describe one pod                                 |
| kubectl expose pod <pod> --port=444 --name=frontend               | Expose the port of a pod (creates a new service) |
| kubectl port-forward <pod> 8080                                   | Port forward the local machine                   |
| kubectl attach <podname> -i                                       | Attach to pod                                    |
| kubectl exec <pod> -- command                                     | Execute a command on the pod                     |
| kubectl label pods <pod> mylabel=awesome                          | Add new label to pod                             |
| kubectl run -i -tty busybox --image=busybox --restart=Never -- sh | Run a shell in a pod - very useful for debugging |

### How to port-forward

Running `kubectl describe pod nodehelloworld.example.com` will then give us info on what is going on here.

To listen locally, we can port-forward: `kubectl port-forward nodehelloworld.example.com 8081:3000`

### Exposing the pod

`kubectl expose pod nodehelloworld.example.com --type=NodePort --name nodehelloworld-service`

Check this with `kubectl get service`

When you see what port is being forwarded, you can again open that up on the security settings and direct to that port.

### Setting up the external load balancer

This will allow the outside world to have traffic routed to the correct pod.

To create the service for this:

```yaml
apiVersion: v1
kind: Service
metadata:
  name: helloworld-service
spec:
  ports:
  - port: 80
  targetPort: nodejs-port
  protocol: TCP
  selector:
  app: helloworld
  type: LoadBalancer
```

Using `kubectl create -f <file>` will create the pods and kops will autoconfigure what is required.

## Kubernetes Basics

### Node Architecture

Within each node can be a collection of pods routed by iptables and within each pod are the Docker containers.

These containers can talk easily to each other using localhost and ports.

Each node also has a `kubelet` and `kube-proxy`. The `kubelet` talks to the master node and `kube-proxy` talks to the iptables.

A service itself can be like the load balancer. The service will be publicly available.

When we look deeper at a pod yaml file, we have the containers called as the specs.

```yaml
# pod-helloworld.yml
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
    image: okeeffed/docker-demo
    ports:
    - containerPort: 3000
```

### Replication Controller

#### Scaling

If your application is `stateless` you can horizontally scale it.

*   Stateless = your appllication doesn't have a `state`, it doesn't write any local files / keeps local sessions. This prevents pods from falling out of sync.
*   All traditional databases are `stateful`
*   Most `web applications` can be made stateless
    *   Session management needs to be done outside the container
    *   Any file to be saved cannot be saved locally

If needed, you can use `volumes` to still run stateful apps.

Those stateful apps can't horizontally scale, but you can run them in a single container and vertically scale (allocate more CPU/Mem/Disk).

Scaling in Kubernetes can be done using the `Replication Controller`.

The replication controller will ensure a specified number of pod replicas will run at all times.

A pod created with the replica controller will automatically be replaced if they fail, get deleted or are terminated.

Using the replication controller is also recommended if you just want to make sure 1 pod is always running, even after reboots.

You can then run a replication controller with just 1 replica to ensure that it is always running.

To create a replication controller:

```yaml
# rc-helloworld.yml
apiVersion: v1
kind: ReplicationController # Changed from Pod
metadata:
  name: helloworld-container
spec: # Replation controller also has a spec
  replicas: 2 # set two pod replicas
  selector:  # select the app
  app: helloworld
  template:
  # stand Pod metadata and spec
  metadata:
    name: nodehelloworld.example.com
    labels:
    app: helloworld
  spec:
    # The containers are listed here
    containers:
    - name: k8s-demo
      image: okeeffed/docker-demo
      ports:
      - containerPort: 3000
```

When this controller is created with `kubectl`, you will see that the two pods are created with a differing suffix.

Now we have horizontally scaled this pod.

If one of these pods is now deleted, the master node will automatically schedule a new one.

We can also scale this by using `kubectl scale --replicas=4 -f <replication-controller-name.yml>`.

We can also use it with the following:

```
kubectl get rc # get replication controllers
# assume helloworld-controller shows up
kubectl scale --replicas=1 rc/helloworld-container
kubectl get pods # will show only one pod remaining
```

## Deployments

Replication Set is the next gen Replication Controller:

*   It supports new selector that can do selection based on filtering according a set of values eg environment either "dev" or "qa"
*   It's not only based on equality. You can do more complex things.
*   This RS is used by the Deployment.

A deployment is a declaration that allows you to do app `deployments` and `updates`.

When using the deployment object, you definte the `state` of your application. Kubernetes will then make sure the clusters matches your desired state.

Just using the replication controller or replication set might be cumbersome to deploy apps.

With a deployment object you can:

1.  Create a deployment (e.g. deploying an app)
2.  Update a deployment (e.g. new version)
3.  Do rolling updates (zero downtime deployments)
4.  Roll back
5.  Pause/resume a deployment (ie rollout to only certain percentage of pods)

An example of a deployment:

```yaml
# deployment-helloworld.yml
apiVersion: extensions/v1beta1
kind: Deployment # Changed from Pod
metadata:
  name: helloworld-deployment
spec: # Replation controller also has a spec
  replicas: 3 # set two pod replicas
  template:
  # stand Pod metadata and spec
  metadata:
    labels:
    app: helloworld
  spec:
    # The containers are listed here
    containers:
    - name: k8s-demo
      image: okeeffed/docker-demo
      ports:
      - containerPort: 3000
```

### Useful commands

| Command                                                                | Description                                 |
| ---------------------------------------------------------------------- | ------------------------------------------- |
| kubectl get deployments                                                | Get info on current deployments             |
| kubectl get rs                                                         | Get info about the replica set              |
| kubectl get pods --show-labels                                         | Get pods + labels attached to pods          |
| kubectl rollout status deployment/helloworld-deployment                | Get deployment status                       |
| kubectl set image deployment/helloworld-deployment k8s-demo=k8s-demo:2 | Run k8s-demo with the image label version 2 |
| kubectl edit deployment/helloworld-deployment                          | Edit the deployment object                  |
| kubectl rollout status deployment/helloworld-deployment                | Get the status of the rollout               |
| kubectl rollout history [deployment]                                   | Get the rollout history                     |
| kubectl rollout undo [deployment]                                      | Rollback to previous version                |
| kubectl rollout undo [deployment] --to-revision=n                      | Rollback to previous version                |

### Demo: Deployment notes

Again, get pods will sho the pods with appended suffixes auto-determined by Kubernetes.

You can verify rollout status using the commands above.

## Services

Pods themselves are very dynamic, they come and go on the Kubernetes cluster.

*   When using a `Replication Controller`, pods are termined and created during scaling operations.
*   Wehn using `Deployments`, when updating the image version, pods are terminated and new pods take the place of older pods.

That's why Pods should never be accessed directly, but always through a Service.

A service is the `logical bridge` between the "mortal" pods and other services or end-users.

When using the `kubectl expose` command, you create a service for you pod to be accessed externally.

Creating a service will create an endpoint for your pod(s):

1.  A ClusterIP: a virtual IP address only reachable from within the cluster (this is default)
2.  A NodePort: a port that is the same on each node that is also reachable externally.
3.  A LoadBalancer: created by the Cloud provider that will route external traffic on every node on the NodePort

The options shown only allow virtual IPs and ports.

There is also a possibility to use `DNS Names`

The `ExternalName` can provide a DNS name for the service e.g. for service discovery using DNS.

This **only** works when the DNS add-on is enabled.

```yaml
# helloworld-service.yml
apiVersion: v1
kind: Service
metadata:
  name: helloworld-service
spec:
  ports: # specify the ports the service uses
  - port: 31001
    nodePort: 31001
    # name below defined from pod
    targetPort: nodejs-port
    protocol: TCP
  selector:
  # service for this app
  app: helloworld
  type: NodePort
```

## Tags

Similar to Labels for AWS

For example, you can label your objects.

For instance: Key could be `environment`, and the value could be `dev`/`staging`/`qa`/`prod`.

Maybe you could also tag the department that is comes from etc.

Labels are not unique. You can then use `label selectors` to match labels.

Eg. a particular pod can only run on a node label with "evironment" equals "development".

More complex matching: "environment" in "development" or "qa".

You can also use labels to tag nodes. Once tagged, you can use labels selectors to let pods only run on specific nodes.

There are two steps required to run a pod on a specific set of nodes:

1.  First you tag the node
2.  Then you add a `nodeSelector` to your pod configuration

```
kubectl label nodes node1 hardware=high-spec
kubectl label nodes node1 hardware=low-spec
```

Secondly, add a pod that uses those labels:

```yaml
# pod-helloworld.yml
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
    image: okeeffed/docker-demo
    ports:
    - containerPort: 3000
  nodeSelector:
  hardware: high-spec
```

### Demo: Using tags

It only really makes sense if you have multiple nodes (doesn't really make sense on minikube).

## Healthchecks

If the application malfunctions, the pod and container may still be running but the application may no longer be running. This is where health checks come in.

Two types:

1.  Running a command in the container periodically
2.  Periodic checks on a URL

The typical prod application behind a load balancer should always have health checks implemented in some way to ensure availability and resiliency.

Below you can see where the healthcheck is. You can check the port or container port name.

```yaml
# pod-helloworld.yml
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
    image: okeeffed/docker-demo
    ports:
    - containerPort: 3000
    # @@@ This is the health check
    livenessProbe:
    httpGet:
      path: /
      port: 3000
    initialDelaySeconds: 15
    timeoutSeconds: 30
```

## Secrets

A way to distribute credentials, keys, passwords or secret data to the pods.

Kubernetes itself uses this Secrets mechanism to provide the credentials to access the internal API.

You can use the same mechanism to provide secrets to your application.

`secrets` is just one way to provide secrets that is native to Kubernetes. There are still other ways to do this.

### How to use them

*   Use as env vars
*   Use as a file in a pod
    *   This requires volumes to be mounted
    *   In this volume you have files
    *   This can be use for things like dotenv files
*   You can use an external image to pull secrets (private image registry)

Generating:

```bash
echo -n "root" > ./username.txt
echo -n "password" > ./password.txt
kubectl create secret generic db-user-pass --from-file=./username.txt --from-file=./password.txt
# > secret "db-user-pass" created
```

A secret can also be a SSH key or SSL cert.

```bash
kubectl create secret generic ssl-cert --from-file=ssh-privatekey=~/.ssh/id_rsa --ssl-cert-=ssl-cert=mysslcert.crt
```

To generate secrets using yaml defs:

```yaml
apiVersion: v1
kind: Secret
metadata:
  name: db-secret
type: Opaque
data:
  password: pwd
  username: usr
```

Then, you can generate it as base64 like so:

```bash
echo -n "password" | base64
# > pwd

kubectl create -f secrets-db-secret.yml
# > secret "db-secret" created
```

To create a pod that uses secrets:

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
    image: okeeffed/docker-demo
    ports:
    - containerPort: 3000
    # @@@ This are the envs
    env:
    - name: SECRET_USERNAME
      valueFrom:
      secretKeyRef:
        name: db-secret
        key: username
    - name: SECRET_PASSWORD
      [...]
```

Alternatively when providing in a file:

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
  image: okeeffed/docker-demo
  ports:
  - containerPort: 3000
  # @@@ This are the envs in a volume mount
  volumeMounts:
  - name: credvolume
    mountPath: /etc/creds
    readOnly: true
  volumes:
  - name: credvolume
  secret:
    secretName: db-secrets
```

### Demo: Wordpress Secrets

This demo ends up creating a secrets file, a pod definition and a service to expose the wordpress pod.

However, note that deleting the current setup will result in a container restarting to maintain state, but when that happens the WordPress site has to be re-installed because the data was not saved. The solution for this will be in the volumes lab.

## Web UI

Kubernetes comes with a `Web UI` you can use instead of kubectl commands.

You can use it to:

1.  Get an overview of running applications on your cluster
2.  Creating and modifying individual Kubernetes resources and workloads (like kubectl create and delete)
3.  Retrieve info on state or resources.

You can reach this UI at `https://<kubernetes-master>/ui`

If you cannot access it, you can install it manually:

```bash
kubectl create -f https://rawgit.com/kubernetes/dashboard/master/src/deploy/kubernetes-dashboard.yaml
# If the password is asked
kubectl config view

# If you're on minikube
minikube dashboard # or --url for the url
```

### Demo: Web UI

Using the web ui you can see some really interesting info and graphs on usage.

# Advanced Topics

## Service Discovery

As of Kubernetes 1.3, DNS is a `built-in` service launched automatically using the addon manager.

The addons are in the `/etc/kubernetes/addons` directory on the master node.

The service can be used within pods to find other services running on the same cluster.

Multiple containers within 1 pod don't need this service, as they can contact each other directly. A container in the same pod can just use `localhost:port`.

To make DNS work, a pod will need a `service definition`.

How can app 1 reach app 2 using DNS? The container itself can talk to the service of App 2.

If you ran the host for `app1-service` and got back 10.0.0.1, `host app2-service` could get back 10.0.0.2.

Examples from the CL

```bash
host app1-service
# has addr 10.0.0.1
host app2-service
# has addr 10.0.0.2
host app2-service.default
# app2-service.default has address 10.0.0.2
host app2-service.default.svc.cluster.local
# app2-service.default.svc.cluster.local has addr 10.0.0.2
```

The `default` stands for default namespace. Pods and services can be launched in different namespaces (to logically seperate your cluster).

So how does this resolution work?

Say we have a pod and we run `kubectl run -i -tty busybox --image=busybox --restart=Never -- sh` and the from the shell run `cat /etc/resolv.conf`, can can see that there will be a `nameserver`. If you do a lookup of the service name in this folder, you'll see why the above works with `.default` and `.default.svc.whatever`.

### Demo: Service Discovery

After creating a secrets type, pod type for a database (SQL using the secrets), and a service for exposing certain ports for the database and then deploying three replicas for a `helloworld-deployment` that also has a `index-db.js` file which we run `node index-db.js` which will have code that works on the service. The value of the `MYSQL_HOST` being set to `database-service` will resolve with the database-service.yml file where the metadata `name` is `database-service`.

Running `kubectl get pod` we should see the database plus 3 pods running for the deployment.

Running `kubectl logs [deployment-name]` will also show us the logs for that pod.

Again, remember that running `kubectl get svc` will get all the services available.

## ConfigMap

Config params that are not secret can be put in the ConfigMap.

The input is again key-value pairs.

The `ConfigMap` key-value pairs can then be read by the app using:

1.  Env variables
2.  Container commandline args in the Pod config
3.  Using volumes

It can also contain full config files eg. a webserver config file. Then that file can then be mounted using volumes where the application expects its config file.

This was you can `inject` config settings into containers without changing the container itself.

To generate a configmap using files:

```bash
$ cat << EOF > app.properties
driver=jdbc
database=postgres
lookandfeel=1
otherparams=xyz
param.with.hierarchy=xyz
EOF
$ kubectl create configmap app-config --from-file=app.properties
```

How to use it? You can create a pod that exposes the ConfigMap using a volume.

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
  image: okeeffed/docker-demo
  ports:
  - containerPort: 3000
  # @@@ This are the envs in a volume mount
  volumeMounts:
  - name: credvolume
    mountPath: /etc/creds
    readOnly: true
  # @@@ For the ConfigMap
  - name: config-volume
    mountPath: /etc/config
  volumes:
  - name: credvolume
  secret:
    secretName: db-secrets
  # @@@ For the ConfigMap
  - name: config-volume
  configMap:
    name: app-config
```

From `/etc/config` , the config values will be stored in files at `/etc/config/driver` and `/etc/config/param/with/hierarchy`.

This is an example of a pod that exposes the ConfigMap as env variables:

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: nodehelloworld.example.com
  labels:
  app: helloworld
spec:
  # The containers are listed here
  containers:
  - name: k8s-demo
  image: okeeffed/docker-demo
  ports:
  - containerPort: 3000
  # @@@ This are the envs in a volume mount
  env:
  - name: DRIVER
    valueFrom: # where you get the value from
    configMapKeyRef: # ensuring the ref comes from the configMap
    name: app-config
    key: driver
  - name: DATABASE
  [ ... ]
```

### Demo: Config Map

Using an example for a reverse proxy config for NGINX:

```
server {
  listen  80;
  server_name localhost;

  location / {
  proxy_bind 127.0.0.1;
  proxy_pass http://127.0.0.1:3000;
  }

  error_page  500 502 503 504 /50x.html;
  location = /50x.html {
  root    /usr/share/nginx/html;
  }
}
```

We could then create this config map with `kubectl create configmap nginx-config --from-file=reverseproxy.conf`.

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: hellonginx.example.com
  labels:
  app: hellonginx
spec:
  # The containers are listed here
  containers:
	- name: nginx
	image: nginx:1.11
	ports:
	- containerPort: 80
	# @@@ The import conf stuff
	volumeMounts:
	- name: config-volume
		mountPath: /etc/nginx/conf.d
  - name: k8s-demo
  image: okeeffed/docker-demo
  ports:
    - containerPort: 3000
  # @@@ The important mounting
  volumes:
	- name: config-volume # @@@ this is referred to above in volumeMounts
	configMap:
		name: nginx-config
		items:
		- key: reverseproxy.conf
		path: reverseproxy.conf
```

After then also creating the service, we can grab the minikube service url and use curl to get info on that request. From here, would could see that it is `nginx` answer the request and transferring it to the Node port.

If we then want to jump into the nginx container to see what is going on, we can run `kubectl exec -i -t helloworld-nginx -c nginx -- bash` (-c flag to specify container) and run `ps x` to see the processes and we can `cat /etc/nginx/conf.d/reverseproxy.conf`.

At this stage, we can enable SSL for NGINX.

## Ingress Controller

Ingress a solution since Kub 1.1 that allows inbound connections to the cluster.

It's an alternative to the external `LoadBalancer` and `nodePorts`. It allows you to easily expose services that need to be accessible from outside to the cluster.

With ingress you can run your own ingress controller (basically a loudbalancer) within the Kub Cluster.

There are default ingress controller available, or you can write your own ingress controller.

How does it work? If you connect over 80/443 you will first hit the `Ingress Controller`. You can use the NGINX controller that comes with Kubernetes. That controller will the dirrect all the traffic.

The `ingress rules` could define that if you go to `host-x.example.com` you go to `Pod 1` etc. You can even redirect slash URLs specifically.

To create an Ingress Controller:

```yaml
# ingress-controller.yml w/ secrets
apiVersion: extensions/v1beta1
kind: Ingress
metadata:
  name: helloworld-rules
spec:
  # @@@ Setting the important rules
  rules:
	- host: helloworld-v1.example.com
	  http:
		paths:
		  - path: /
		  backend:
			serviceName: helloworld-v1
			servicePort: 80
    - host: helloworld-v2.example.com
	  http:
		paths:
		  - path: /
		  backend:
			serviceName: helloworld-v2
			servicePort: 80
```

### Demo: Ingress Controller

In the example, the ingress controller is a `Replication Controller` to ensure that there is always one up and running.

After deploying, if we curl with the -H host flag with `helloworld-v1.whatever.com` and v2 respectively, it would have the ingress controller route to each server.

## Volumes

How can we run stateful apps?

Volumes in kubernetes allow you to store data outside of the container. So far, all the applications have been stateless for this reason. This can be done with external services like a database, caching server (eg MySQL, AWS S3).

Persistent Volumes in Kubernetes allow you to attach a volume to a container that exists even when the container stops. Volumes can be attached using different volume plugins. Eg local volume, EBS Storage etc.

### Using EBS Storage

With this, we can keep state. You could run a `MySQL` database using persistent volumes, although this may not be ready for production yet.

The use case is that if your node stops working, the pod can be rescheduled on another node, and the volume can be attached to the new node.

To use volumes, you first need to create the volume:

```bash
aws ec2 create-volume --sze 1- --region us-east-1 --availability-zone us-east-1 --volume-type gp2
```

Next, we need to create a pod with a volume def:

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: hellonginx.example.com
  labels:
  app: hellonginx
spec:
  # The containers are listed here
  containers:
	- name: k8s-demo
	image: okeeffed/k8s-demo
	volumeMounts:
	- name: myvolume
	  mountPath: myvolume
  # @@@ The important mounting
  volumes:
	- name: myvolume # @@@ this is referred to above in volumeMounts
	  awsElasticBlockStore:
	    volumeID: vol-9835id
```

### Demo: Volumes

Using Vagrant for kops, we can first create a volume using the above mentioned command.

After receiving a response, you can replace the .yml pod definition config file to attach that volumeID. Once the deployment is created and deployed. After create and confirmation, we can get the pod name `kubectl get pod` and attach `kubectl exec helloworld-deployment-923id -i -t -- bash` and then run `ls -ahl /myvol/` to check for volume.

If we run `echo 'test' > /myvol/myvol.txt` and `echo 'test 2' > /test.txt`, we know that the latter file will not persist if the pod is restarted/rescheduled.

If we run `kubectl drain ip --force` we can drain the pod. Assuming this is a `Replication Controller` or `Deployment`, another container should spin up. Once that pod is attached to another node, we can also attach back to the pod on the new node with the `exec` command and we can confirm that the `/myvol/myvol.txt` is still there, although the other `/test.txt` is no longer there since it was not saved to the volume.

If you need to remove the ebs volume, you can run `aws ec2 delete-volume --volume-id vol-[id]`.

## Volume Provisioning

The kubs plugins have the capability to `provision storage` for you. The AWS Plugin can for instance `provision storage` for you by creating the volumes in AWS before attaching them to a node.

This is done using the `StorageClass` object -- this is beta for the course but should be stable soon.

To use autoprovisioing, create the following:

```yaml
# storage.yml
kind: StorageClass
apiVersion: storage.k8s.io/v1beta1
metadata:
  name: standard
provisioner: kubernetes.io/aws-ebs
parameters:
  type: gp2
  zone: us-east-1
```

Next, you can create a volume claim and specify the size:

```yaml
# my-volume-claim.yml
kind: PersistentVolumeClaim
apiVersion: v1
metadata:
  name: myclaim
  annotations:
    volume.beta.kubernetes.io/storage-class: "standard"
spec:
  accessModes:
	- ReadWriteOnce
  resources:
	requests:
	  storage: 8Gi
```

Finally, if launching a pod:

```yaml
# pod-helloworld.yml w/ secrets
apiVersion: v1
kind: Pod
metadata:
  name: mypod
spec:
  # The containers are listed here
  containers:
	- name: myfrontend
	image: nginx
	volumeMounts:
	- name: mypd
	  mountPath: '/var/www/html'
  # @@@ The important mounting
  volumes:
	- name: mypd # @@@ this is referred to above in volumeMounts
	  persistentVolumeClaim:
	    claimName: myclaim # @@@ refers to my claim from the previous type definition
```

## Demo: Using Wordpress with Volumes

After declaring a `StorageClass` class from a yaml file and a `PersistentVolumeClaim` class.

```yaml
# storage.yml
kind: StorageClass
apiVersion: storage.k8s.io/v1beta1
metadata:
  name: standard
provisioner: kubernetes.io/aws-ebs
parameters:
  type: gp2
  zone: eu-west-1a
```

```yaml
# PV Claim
kind: PersistentVolumeClaim
apiVersion: v1
metadata:
  name: db-storage
  annotations:
    volume.beta.kubernetes.io/storage-class: "standard"
spec:
  accessModes:
    - ReadWriteOnce
  resources:
    requests:
      storage: 8Gi
```

There is also a simple ReplicationController for the Wordpress DB. In the spe for the container for mysql, we declare where the `mountPath` will be.

```yaml
apiVersion: v1
kind: ReplicationController
metadata:
  name: wordpress-db
spec:
  replicas: 1
  selector:
    app: wordpress-db
  template:
    metadata:
      name: wordpress-db
      labels:
        app: wordpress-db
    spec:
      containers:
      - name: mysql
        image: mysql:5.7
        args:
          - "--ignore-db-dir=lost+found"
        ports:
        - name: mysql-port
          containerPort: 3306
        env:
          - name: MYSQL_ROOT_PASSWORD
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: db-password
        volumeMounts:
        - mountPath: "/var/lib/mysql"
          name: mysql-storage
      volumes:
        - name: mysql-storage
          persistentVolumeClaim:
            claimName: db-storage
```

Having a makeshift secrets file for secrets:

```yaml
apiVersion: v1
kind: Secret
metadata:
  name: wordpress-secrets
type: Opaque
data:
  db-password: cGFzc3dvcmQ=
  # random sha1 strings - change all these lines
  authkey: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ4OA==
  loggedinkey: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ4OQ==
  secureauthkey: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5MQ==
  noncekey: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5MA==
  authsalt: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5Mg==
  secureauthsalt: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5Mw==
  loggedinsalt: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5NA==
  noncesalt: MTQ3ZDVhMTIzYmU1ZTRiMWQ1NzUyOWFlNWE2YzRjY2FhMDkyZGQ5NQ==
```

To open up the service for the port:

```yaml
apiVersion: v1
kind: Service
metadata:
  name: wordpress-db
spec:
  ports:
  - port: 3306
    protocol: TCP
  selector:
    app: wordpress-db
  type: NodePort
```

Opening up the web and web service:

```yaml
apiVersion: extensions/v1beta1
kind: Deployment
metadata:
  name: wordpress-deployment
spec:
  replicas: 2
  template:
    metadata:
      labels:
        app: wordpress
    spec:
      containers:
      - name: wordpress
        image: wordpress:4-php7.0
        # uncomment to fix perm issue, see also https://github.com/kubernetes/kubernetes/issues/2630
        # command: ['bash', '-c', 'chown www-data:www-data /var/www/html/wp-content/uploads && apache2-foreground']
        ports:
        - name: http-port
          containerPort: 80
        env:
          - name: WORDPRESS_DB_PASSWORD
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: db-password
          - name: WORDPRESS_AUTH_KEY
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: authkey
          - name: WORDPRESS_LOGGED_IN_KEY
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: loggedinkey
          - name: WORDPRESS_SECURE_AUTH_KEY
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: secureauthkey
          - name: WORDPRESS_NONCE_KEY
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: noncekey
          - name: WORDPRESS_AUTH_SALT
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: authsalt
          - name: WORDPRESS_SECURE_AUTH_SALT
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: secureauthsalt
          - name: WORDPRESS_LOGGED_IN_SALT
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: loggedinsalt
          - name: WORDPRESS_NONCE_SALT
            valueFrom:
              secretKeyRef:
                name: wordpress-secrets
                key: noncesalt
          - name: WORDPRESS_DB_HOST
            value: wordpress-db
        volumeMounts:
        # shared storage for things like media
        - mountPath: /var/www/html/wp-content/uploads
          name: uploads
      volumes:
      - name: uploads
        nfs:
          server: eu-west-1a.fs-5714e89e.efs.eu-west-1.amazonaws.com
          path: /
```

```yaml
apiVersion: v1
kind: Service
metadata:
  name: wordpress
spec:
  ports:
  - port: 80
    targetPort: http-port
    protocol: TCP
  selector:
    app: wordpress
  type: LoadBalancer
```

With the AWS Commandline, you can create a file system and mount target. For the fs, run `aws efs create-file-system --creation-token` and then after grabbing the file-system-id and subnet-id, you can run `aws efs create-mount-target --file-system-id <id> --security-groups <sg>`. Ensure in the above `nfs` volume you update the fs id.

## Pet Sets

Stateful dist apps - new feature from Kub 1.3.

It is introduced to be able to run `stateful applications` that need:

1.  A stable pod hostname (instead of podname-randomstr) - will have an index ie podname-0, podname-1 etc.
2.  Stateful app requires multi pods with vols based on their ordinal number. Currently deleting and/or scaling a PetSet down will not deleted volumes associated.

A pet set will allow your stateful app to use DNS to find out peers. One running node of the Pet Set is called a `Pet`. Using Pet Sets you can run for instance 5 cassandra nodes on Kubs named cass-1 until cass-5.

The big difference is that you don't want to connect just any specific service, you want to make sure pod whatever definitely connects to another pod.

This pet set also allows order to startup and teardown of pets.

Still a lot of work for future work.

## Daemon Sets

*   Ensure that every single node in the Kubernetes cluster runs the same pod resource. This is useful to ensure a certain pod is running on every single kubernetes node.
*   When a node is added to the cluster, a new pod will be started automatically
*   Same when a node is removed, the pod will not be rescheduled on another node

Use cases:

1.  Logging aggregators
2.  Monitoring
3.  Load Balancers/Reverse Proxies/API Gateways
