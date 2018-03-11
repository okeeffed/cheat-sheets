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

#### Minikube issues 

```
https://github.com/kubernetes/minikube/issues/1382
```
