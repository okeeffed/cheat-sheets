# Running Container Clusters with Kuberentes

## Intro to Kubernetes

k8s is an open source container cluster manager.

Google donated it under the Apache Commons license.

It's obejctive is to provide a platform for deploying, scaling and operations of application containers across a cluster of hosts.

Google uses it to run billions of containers a day on Google Cloud.

__Components of Kubernetes__

- Nodes
- Pods
- Labels
- Selectors
- Controllers
- Services
- Control Page
- API

### ---- Kubernetes Architecture

We will end up with one `Master/Controller` which can have _n_ Minions, which can have _n_ pods which themselves can container _n_ containers.

__Minions (Nodes)__

These are the physical/virtual container clients. They host the various containers within the cluster.

Each of them run `ETCD` (a key pair management and communication service) - it's how we can keep everything in sync and the `Kubernetes Proxy`.

Docker must be installed on each of these `minions` as well.

__Pods__

One or more containers. These containers are then guarenteed by the `Master/Controller` to be located on the same host machine in order to facilitate sharing of resources.

Pods are assigned unique IPs within each cluster.

Pods can container definitions of disk volumes or share, and then provide access from those to all the members (containers) within the pod.

__Labels__

Clients can attach "key-value pairs" to any object in the system (like Pods or Minions). The become the labels that identify them in the config and management of them.

__Selectors__

Label Selectors represent queries that are made against those labels. The resolve to the corresponding matching objects.

These two items are the primary way that grouping is done in Kubernetes and determine which components that a given operation applies to when indicated.

__Controllers__

These are used in the management of your cluster. Controllers are the mechanism by which your desired configuration state is enforced.

Controllers manage a set of pods and - depending on the desired configuration state - may engage other controllers to handle replication and scaling (Replication Controller) of X number of containers and pods across the cluster. it is also responsible for replacing any container in a pod that fails (based on the desired state of the cluster).

Other controllers that can be engaged include a DaemonSet Controller (enforces a 1 to 1 ratio of pods to minions) and a Job Controller (that runs pods to "completion" such as in batch jobs).

Each set of pods any controller manages is determined by the label selectors that are part of its definition.

__Services__

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

***

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

# add the following
KUBE_ETCD_SERVERS="--etcd-server=http://centos-master:2379"
```

__Kublet Config__

Edit the `/etc/kubernetes/kublet` file.

```
KUBELET_ADDRESS="--address=0.0.0.0"

KUBELET_PORT="--port=102050"

KUBELET_HOSTNAME="--hostname-override=centos-minion1"

KUBELET_API_SERVER="--api-servers=http://centos-master:8080"

# comment out pod_infra_container
```

Afterwards, ensure you run the following:

```
systemctl enable kube-proxy kubelet docker
systemctl start kube-proxy kubelet docker
systemctl status kube-proxy kubelet docker | grep "(running)" | wc-l
```

### ---- Exploring the Environment