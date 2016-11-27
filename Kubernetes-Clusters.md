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

