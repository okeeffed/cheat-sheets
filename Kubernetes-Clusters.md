# Running Container Clusters with Kuberentes

<!-- TOC -->

*   [Running Container Clusters with Kuberentes](#running-container-clusters-with-kuberentes)
    *   [Intro to Kubernetes](#intro-to-kubernetes)
        *   [---- Kubernetes Architecture](#-----kubernetes-architecture)
        *   [---- Introduction to YAML](#-----introduction-to-yaml)
    *   [Kubernetes Setup and Config](#kubernetes-setup-and-config)
        *   [---- Multi-Pod (Container) Replication Controller](#-----multi-pod-container-replication-controller)
        *   [---- Create and Deploy Service Definitions](#-----create-and-deploy-service-definitions)
    *   [Logs, Scaling and Recovery](#logs-scaling-and-recovery)
        *   [---- Creating Temporary Pods at the Command Line](#-----creating-temporary-pods-at-the-command-line)

<!-- /TOC -->

## Intro to Kubernetes

k8s is an open source container cluster manager.

Google donated it under the Apache Commons license.

It's obejctive is to provide a platform for deploying, scaling and operations of application containers across a cluster of hosts.

Google uses it to run billions of containers a day on Google Cloud.

**Components of Kubernetes**

*   Nodes
*   Pods
*   Labels
*   Selectors
*   Controllers
*   Services
*   Control Page
*   API

### ---- Kubernetes Architecture

We will end up with one `Master/Controller` which can have _n_ Minions, which can have _n_ pods which themselves can container _n_ containers.

**Minions (Nodes)**

These are the physical/virtual container clients. They host the various containers within the cluster.

Each of them run `ETCD` (a key pair management and communication service) - it's how we can keep everything in sync and the `Kubernetes Proxy`.

Docker must be installed on each of these `minions` as well.

**Pods**

One or more containers. These containers are then guarenteed by the `Master/Controller` to be located on the same host machine in order to facilitate sharing of resources.

Pods are assigned unique IPs within each cluster.

Pods can container definitions of disk volumes or share, and then provide access from those to all the members (containers) within the pod.

**Labels**

Clients can attach "key-value pairs" to any object in the system (like Pods or Minions). The become the labels that identify them in the config and management of them.

**Selectors**

Label Selectors represent queries that are made against those labels. The resolve to the corresponding matching objects.

These two items are the primary way that grouping is done in Kubernetes and determine which components that a given operation applies to when indicated.

**Controllers**

These are used in the management of your cluster. Controllers are the mechanism by which your desired configuration state is enforced.

Controllers manage a set of pods and - depending on the desired configuration state - may engage other controllers to handle replication and scaling (Replication Controller) of X number of containers and pods across the cluster. it is also responsible for replacing any container in a pod that fails (based on the desired state of the cluster).

Other controllers that can be engaged include a DaemonSet Controller (enforces a 1 to 1 ratio of pods to minions) and a Job Controller (that runs pods to "completion" such as in batch jobs).

Each set of pods any controller manages is determined by the label selectors that are part of its definition.

**Services**

Services allow pods to `work together` eg multi-tiered application eg. web layer, db layer etc. are defined by the label selector.

Kubernetes can then provide service discovery and handle routing with the static IP for each pod as well as load balancing (round robin based) connections to that service among the pods that match the label selector indicated.

By default, although a service is only exposed inside a cluster, it can also be exposed outside a cluster as needed.

### ---- Introduction to YAML

`Yet Another Markup Language`, although it moved to `YAML Ain't Markup Language`

It's a data serialisation format. It's designed to be easy to map to high level languages.

```
--- # Our Favourite Movies of All Time
- The Terminator
- Star Wars
```

It is highly dependent on the dashes and indentations.

---

## Kubernetes Setup and Config

Ensure that for your nodes etc and the control-master that you apt-get/yum install `ntp`

We use `ntp` for accurate reporting. Ensure for each node you use `systemctl enable ntpd && sysmctl start ntpd`.

To ensure that they can all communicate, edit the `/etc/hosts` file and paste in the IP addresses and names of the minions. That hosts will allow you to ping that minion name.

In the `master/controller`, `vim /etc/yum.repos.d/virt7-docker-common-release.repo`

```
[virt7-docker-common-release]
name=virt7-docker-common-release
baseurl=http://cbs.centos.org/repos/virt7-docker-common-release/x86_64/0s/
gpgcheck=0
```

Then hit `yum update`.

Ensure `systemctl status [iptables|firewalld]` are not running.

```
Now to ensure that we can share and communicate values, we will install `etcd` and `kubernetes`.

`yum install -y --enablerepo=virt7-docker-common-release kubernetes docker`

### ---- Install and Configure the Master Controller

For the master, we want to edit the Kubernetes config file.

__Master Kube Config__
```

cd /etc/kubernetes
vim config

```
In the file, the `KUBE_LOTOSTDERR` we want one, `KUBE_LOG_LEBEL` can be set as 0 for debug, `KUBE_ALLOW_PRIV` can be left as false - it is a way to allow any docker container to run in our kube cluster, but we can learn about this later. `KUBE_MASTER` we want to change to ensure that it binds to an interface that we can communicate with. It will default at localhost, so for this example we would do something like `--master=http://centos-master:8080` where centos-master is what we set up in `/etc/hosts`

We will then add `KUBE_ETCD_SERVERS="--etcd-servers=http://centos-master:2379"`

__Setting up etcd__
```

cd /etc/etcd
vim etcd.conf

```
In the file, we want to change `ETCD_LISTEN_CLIENT_URLS="http://0.0.0.0:2379"` and the same value in the cluster section for `ETCD_ADVERTISE_CLIENT_URLS`

__Editing the Kubernetes APIServer___
```

cd /etc/kubernetes
vim apiserver

```
Inside, we need to change to the following for the following fields:
```

KUBE_API_ADDRESS="--address=0.0.0.0"
KUBE_API_PORT="--port=8080"
KUBELET_PORT="--kubelet-port=10250"

// for the basic config, we can comment out the KUBE_ADMISSION_CONTROL

```
__systemctl enable___

Finally, we want to enable the following with the command:
```

systemctl enable etcd kube-apiserver kube-controller-manager kube-scheduler
systemctl start etcd kube-apiserver kube-controller-manager kube-scheduler
systemctl status etcd kube-apiserver kube-controller-manager kube-scheduler | grep"(running)" | wc -l

```
### ---- Install and Configure the Minions

At this stage, we should be able to see the master controller from the minions.

__Minion Kube Config__
```

KUBE_MASTER="--master=http://centos-master:8080"

// add the following
KUBE_ETCD_SERVERS="--etcd-server=http://centos-master:2379"

```
__Kublet Config__

Edit the `/etc/kubernetes/kublet` file.
```

KUBELET_ADDRESS="--address=0.0.0.0"

KUBELET_PORT="--port=102050"

KUBELET_HOSTNAME="--hostname-override=centos-minion1"

KUBELET_API_SERVER="--api-servers=http://centos-master:8080"

// comment out pod_infra_container

```
Afterwards, ensure you run the following:
```

systemctl enable kube-proxy kubelet docker
systemctl start kube-proxy kubelet docker
systemctl status kube-proxy kubelet docker | grep "(running)" | wc-l

```
### ---- Exploring the Environment

We will use `kubectl` from the command line to control the cluster manager.

Main functions:
```

// list of registered nodes for the cluster
kubectl get nodes

// to get help on it
man kubectl-get

// how to get the ip addresses/info
kubetrl describe nodes

// getting the json info
kubectl get nodes -o jsonpath='{.items[*].status.addresses[?(@.type=="ExternalIP")].address}'

```
***

## Pods, Tags and Services

### ---- Create and Deploy Pod Definitions

Let's start running containers in pods in our cluster.

For configuration, you can use both `json` or `yaml` file format. From a definitions standpoint, it may be better for the current input configuration.

`Desired State` for our system is a key concept. It's the only responsibility of Kubernetes to match the defined `desired state`.

On the master node, `cd Builds` and inside that directory `vim nginx.yaml`
```

apiVersion: v1
kind: Pod
metadata:
name: nginx
spec:
containers: - name: nginx
image: nginx:1.7.9 # this is not the latest - used for a reason
ports: - containerPort: 80

```
If we now use `kubectl get pods`, we should get no pods that are running.

That will be because there are no containers running on any minions.

Run `kubectl create -f ./nginx.yaml` and we'll get a notification.

`kubectl get pods` should now return results and the minion should now have a container running!

__Describing a pod__

`kubectl describe pod nginx`

This will tell us a number of things including IDs assigned to the minion, labels if they are assigned, IP etc and info on the containers.

The events will also describe how the container has gone.

__Accessing the pod from master___

Can we ping that address? No. The reason is that we have no extenal route to that pod. What we can do is run a busy-box image. This will allow us to connect to or test our container.
```

// -t is not --tty for kubectl
kubectl run busybox --image=busybox --restart=Never --tty -i --generator=run-pod/v1

// this will spin up the pod called busybox
// we will then be in the command line for that pod
// If we have this pod running within the minion
// we will then have access to other pods on the
// same environment
wget -q0- http://172.1.0.2

```
To clean up the system, we can use `kubectl delete pod podName`

From the master, we can then see that the pod is no longer running.

We can also forward temporarily our ports to a remote copy. We can do this with port forward.
```

kubectl get pods
kubectl create -f nginx.yaml
kubectl get pods # will show the pods

// to forward ports
// & means to run in the background
// this will return a port above 34000 - otherwise we can specify
kubectl port-forward nginx :80 &
// from still in the master
wget -q0- http://localhost:34853

```
### ---- Tags, Labels and Selectors

Create `nginx-pod-label.yaml`
```

apiVersion: v1
kind: Pod
metadata:
name: nginx
labels:
app: nginx
spec:
containers: - name: nginx
image: nginx:1.7.9 # this is not the latest - used for a reason
ports: - containerPort: 80

```

```

kubectl create -f nginx-pod-label.yaml
kubectl get pods # will be running
kubectl get -l app=nginx

```
If we copy that .yaml file and rename `nginx` to `nginx2`, we can get info just by searching for that name.

If we also do `kubectl decribe pod -l app=nginx2`, we'd just get the info for that name.

### ---- Deployment State

Create `nginx-deployment-prod.yaml`

This will make a number of changes. This will go from a simple pod definition to a deployment production set.
```

apiVersion: extensions/v1beta1 # this should now be in v1.3
kind: Deployment
metadata:
name: nginx-deployment-prod
spec:
replicas: 1
template: # this will be for the pod replicas
metadata:
labels:
app: nginx-deployment-prod
spec:
containers: - name: nginx
image: nginx:1.7.9 # this is not the latest - used for a reason
ports: - containerPort: 80

```

```

kubectl create -f -nginx-deployent-prod.yaml
kubectl get pods
// this will now return the name + the id concatentated to the end!
kubectl get deployments
// this will now give us the nginx-deployment-prod with details

This seems like we're making it more complex than we need to be... but...

Create `nginx-deployment-dev.yaml` and just change everything to dev.

Again, create the .yaml kubectl. It will now show two deployments.

If we create `nginx-deployment-dev-update.yaml` and just change a few things. If we run `kubectl apply -f nginx-deployment-dev-update.yaml` and it will update by apply the contents of that to the name deployment cluster.

If we run `kubectl describe deployments ...`, we can get the details with things like the `StrategyType` etc.

### ---- Multi-Pod (Container) Replication Controller

Until now, we have been creating one or more pods either directly or using a file. However, there has only been one container in each of the pods that we've been working with.

We can use the replication controller to do more than one container in a pod. It will allow us to deploy 1 to n pods of a particular container.

```
kubectl get pods # we will initially have nothing

vim nginx-multi-label.yaml
```

**nginx-multi-label.yaml**

```
apiVersion: v1
kind: ReplicationController
metadata:
	name: nginx-www
spec:
	replicas: 3
	select:
		app: nginx
	template:
		metadata:
			name: nginx
			labels:
				app: nginx
			spec:
				containers:
					- name: nginx
						image: nginx
						ports:
						- containerPort: 80
```

Ensure that if you're going to do this, start the `kubelet` and `kube-proxy` on the other nodes.

```
kubectl get nodes
# if everything is on, all three minions should report that they are ready
kubectl create -f nginx-multi-label.yaml
# replicationcontroller "nginx-www" created
kubectl get pods
# will show the pods
kubectrl describe replicationcontroller
# tells us 3 running and 3 pods
kubectl describe pods
# it will show all of our pods being happy!
kubectl get services
# gives us just the one service
```

If we delete a pod, we will still end up having a service! When we create a definition, that defines the expected state of the entire environment!

If there is an app error etc. the service will ensure that it gets back to the expected state.

### ---- Create and Deploy Service Definitions

Starting to put things together.

```
kubectl get replicationcontrollers
kubectl get pods
kubectl get nodes
```

Time to use the multicontainer configuration.

**nginx-multi-label.yaml**

```
apiVersion: v1
kind: ReplicationController
metadata:
	name: nginx-www
spec:
	replicas: 3
	select:
		app: nginx
	template:
		metadata:
			name: nginx
			labels:
				app: nginx
			spec:
				containers:
					- name: nginx
						image: nginx
						ports:
						- containerPort: 80
```

`kubectl create -f nginx-multi-label.yaml`

**Defining an nginx service**

```
apiVersion: v1
kind: Service
metadata:
	data: nginx-service
spec:
	ports:
		port: 8080
		targetPort: 80
		protocol: TCP
	selector:
		app: nginx
```

`kubectl create -f nginx-service.yaml`

Now, if we run `kubectl get services`, we will now have two services.

If we run `kubectl describe service nginx-service`, we can see info about and that it is a ClusterIP and that the endpoints are assigned to the minions with Kubernetes managing this.

So how do we connect?

`kubectl run busybox --generator=run-pod/v1 --image=busybox --restart=Never --tty -i`

Once it is running, we should be able to do `wget -q0- http://10.254.197.123:8080`

Now this idea is referring to a cluster of this IP. So now we've tied everything together to have a clustered referred to with just one IP address. We no longer even have to know the other IPs.

---

## Logs, Scaling and Recovery

### ---- Creating Temporary Pods at the Command Line
