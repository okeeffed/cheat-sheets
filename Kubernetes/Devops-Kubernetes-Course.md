# DevOps Kubernetes Course

## Course layout

1. Introduction
2. Kubernetes Basics
3. Advanced Topics
4. Administration


### Objectives

1. To understand, deploy and use Kubernetes
2. To get straight with `containerization` and run those containers on Kubernetes
3. To use Kubernetes as a single node and on AWS
4. To be able to run `stateless` and `stateful` applications on Kubernetes
5. To be able to `administer` Kubernetes

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

- Let's you schedule containers on a cluster of machines
- You can run multiple containers on one machine 
- You can run long running services (like web apps)
- K8s will manage the state of these containers 
    - Can start the container on specific nodes 
    - Will restart a container when it gets killed 
    - Can move containers from one node to another node
- Instead of just running a few docker containers on one host manually, K8s can manage that for you
- K8 clusters can go to thousands of nodes 
- Other orcherstrators:
    - Docker Swarm
    - Mesos 

You can run K8s anywhere:

- One premise (private)
- Public
- Hybrid

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

Then, we can again run `kubectl run hello-minikube ... `

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

1. Don't try to create one giant docker image fo you app, but split it up if necessary.
2. All data in the container is not preserved. You need volumes for this.
3. Check 12factor.net for methodologies

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

Command 												| Description
---														| ---
kubectl get pod 										| Get info about all running pods
kubectl describe pod <pod>								| Describe one pod
kubectl expose pod <pod> --port=444 --name=frontend		| Expose the port of a pod (creates a new service) 	
kubectl port-forward <pod> 8080 						| Port forward the local machine 
kubectl attach <podname> -i								| Attach to pod 
kubectl exec <pod> -- command 							| Execute a command on the pod
kubectl label pods <pod> mylabel=awesome				| Add new label to pod
kubectl run -i -tty busybox --image=busybox --restart=Never -- sh | Run a shell in a pod - very useful for debugging

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

