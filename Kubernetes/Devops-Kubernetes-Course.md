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

After setting up the AWSCLI, installing Kops and creating a S3 Bucket + setting up the Route53 Name Servers, you can move on.

