## Docker Deep Dive

---

<!-- TOC -->

*   [Docker Deep Dive](#docker-deep-dive)
*   [Docker Basics](#docker-basics)
    *   [---- Working with Multiple Images](#-----working-with-multiple-images)
    *   [---- Packaging A Customized Container](#-----packaging-a-customized-container)
    *   [---- Container Commands](#-----container-commands)
    *   [---- Exposing ports](#-----exposing-ports)
*   [The Dockerfile, Builds and Network Configuration](#the-dockerfile-builds-and-network-configuration)
    *   [---- USER and RUN](#-----user-and-run)
    *   [---- ENV](#-----env)
    *   [---- CMD vs RUN](#-----cmd-vs-run)
    *   [---- ENTRYPOINT](#-----entrypoint)
    *   [---- EXPOSE](#-----expose)
    *   [---- Container Volume Management](#-----container-volume-management)
    *   [---- Docker Network: List and Inspect](#-----docker-network-list-and-inspect)
    *   [---- Docker Network: Assign to Containers](#-----docker-network-assign-to-containers)
*   [Docker commands and structures](#docker-commands-and-structures)
    *   [---- Inspect Container Processes](#-----inspect-container-processes)
    *   [---- Previous Container Management](#-----previous-container-management)
    *   [---- Controlling Port Exposure on Containers](#-----controlling-port-exposure-on-containers)
    *   [---- Naming Containers](#-----naming-containers)
    *   [---- Docker Events](#-----docker-events)
    *   [---- Managing and Removing Base Images](#-----managing-and-removing-base-images)
    *   [---- Saving and Loading Docker Images](#-----saving-and-loading-docker-images)
    *   [---- Image History](#-----image-history)
    *   [---- Take Control of Our Tags](#-----take-control-of-our-tags)
    *   [---- Pushing to Docker Hub](#-----pushing-to-docker-hub)
*   [Integration and Use Cases](#integration-and-use-cases)
    *   [---- Building a Web Farm for Development and Testing](#-----building-a-web-farm-for-development-and-testing)

<!-- /TOC -->

## Docker Basics

### ---- Working with Multiple Images

```
# i: interactive, t: tty, d: daemon mode
docker run -i -t -d ubuntu:latest /bin/bash

# to attach to the container and edit the container
docker attach container_name
```

---

### ---- Packaging A Customized Container

Once you are attached to a container, anytime you create files, it is now part of that container!

You can do all of your updates etc.

From here, we can commit to create a base image.

```
docker commit -m "This is a new image" -a "dennis@presentcompany.co" dok/ubusshd:v1
```

Once this is commited, it is now put to a base container! Yay!

Let's create a simple Dockerfile to give some info about us.

```
# Dockerfile - example Ubuntu example with SSH already installed
FROM ubuntu:latest
MAINTAINER okeeffed <dennis@presentcompany.co>
RUN apt-get update
RUN apt-get -y install telnet openssh-server
```

For building:

```
# build a Dockerfile from the current location
docker build -t="dok/ubusshdonly:v2" .
```

### ---- Container Commands

```
top # shows the processes
docker logs container_name #shows history for container
docker exec container name /bin/cat /etc/profile

docker run container name /bin/bash -c "while true; do echo HELLO; sleep 1; done"
```

### ---- Exposing ports

```
docker run -d -p 80:80 nginx:latest
```

## The Dockerfile, Builds and Network Configuration

### ---- USER and RUN

```
# Dockerfile based on the latest CentOS 7 image - non-priviledged user entry
MAINTAINER dok@email.com
FROM centos:latest

RUN useradd -ms /bin/bash user
USER user
```

To connect as the root, you just need to start the container and run `docker exec -u 0 -it sleepy_allen /bin/bash`

**Order of Execution**

We had to run a super user command to add the User. Now let's say we want to run another command.

```
# Dockerfile based on the latest CentOS 7 image - non-priviledged user entry
MAINTAINER dok@email.com
FROM centos:latest

RUN useradd -ms /bin/bash user

# this will not give an issue - order of execution MATTERS
RUN echo 'EXPORT 129.168.0.0/24' >> /etc/exports.list # making up exports.list

USER user

# below will give an issue - order of execution MATTERS
RUN echo 'EXPORT 129.168.0.0/24' >> /etc/exports.list # making up exports.list
```

### ---- ENV

Example, let's install Java through the Dockerfile!

```
# Dockerfile based on the latest CentOS 7 image - non-priviledged user entry
MAINTAINER dok@email.com
FROM centos:latest

RUN useradd -ms /bin/bash user

# this will not give an issue - order of execution MATTERS
RUN echo 'EXPORT 129.168.0.0/24' >> /etc/exports.list # making up exports.list

RUN yum update -y
RUN yum install -y net-tools wget

RUN cd ~ && wget --no-cookies --no-check-certificate --header "url"

RUN yum localinstall -y ~/java_file.rpm

USER user

RUN cd ~ && echo "export JAVA_HOME=/usr/java/jdk1.8.0/jre" >> /home/user/.bashrc

# generates env variable for everyone
ENV JAVA_BIN /usr/java/jdk1.8.0/jre/bin
```

### ---- CMD vs RUN

Command generally sets the default command to run when there is nothing specified when container starts up.

```
# Dockerfile based on the latest CentOS 7 image - non-priviledged user entry
MAINTAINER dok@email.com
FROM centos:latest

RUN useradd -ms /bin/bash user

CMD 'echo' 'This is a custom container message'

USER user
```

### ---- ENTRYPOINT

The entrypoint itself will ALWAYS be the concrete default application everytime that the container is created.

`CMD` will only run when there is no argument, whereas `ENTRYPOINT` will always run.

```
FROM centos:latest
MAINTAINER dok@email.com

RUN useradd -ms /bin/bash user

ENTRYPOINT echo "This command will display this message on EVERY container that is run from it"

USER user
```

### ---- EXPOSE

EXPOSE will allow us to expose our ports.

The follow image will allow us to build a webserver and run it from basics.

```
FROM centos:latest
MAINTAINER dok@email.com

RUN yum update -y
RUN yum install -y httpd net-tools

RUN echo "This is a custom index file built during the image creation" > /var/www/html/index.html

ENTRYPOINT apachectl "-DFOREGROUND"
```

However, if we don't expose any ports, then using `-P` won't automatically expose those ports. We can still forcably expose ports using `docker run --name apacheweb -d -p 8080:80 container

To auto-expose, we can do this...

```
FROM centos:latest
MAINTAINER dok@email.com

RUN yum update -y
RUN yum install -y httpd net-tools

RUN echo "This is a custom index file built during the image creation" > /var/www/html/index.html

EXPOSE 80

ENTRYPOINT apachectl "-DFOREGROUND"
```

### ---- Container Volume Management

How do we work with mounts and file systems?

We can mount using `-v` for mounting volumes.

Scenario One: Create a directory at launchtime called `mydata`

```
docker run -it --name voltest1 -v /mydata centos:latest /bin/bash
# once logged in
df -h # shows that there is a mounted file

# back from host OS terminal
cd /var/lib/docker # will show us the volumes folder

# if we docker inspect the container
# it will show us the volume and the source
```

Once we have things that are mounted, we can access them from the container and anything that we edit in the underlying host, we can see in the container!

We can't do this from the Dockerfile, because the base image is designed to be portable.

### ---- Docker Network: List and Inspect

Thanks to Docker Swarm and Kubernetes, it has become easier to manage the Docker Network.

When you run a docker instance, it will auto pull the next available address.

```
# this will list all of the associated networks with the current host
docker network ls

docker network ls --no-trunc # to see the full address

docker network inspect bridge
```

**Creating Docker network configs**

To see things like a `man` page for docker, you essential just put dashes between multi-word commands.

`man docker-network-create` will bring up the network create manual.

```
docker network create --subnet 10.1.0.0/24 --gateway 10.1.0.1 mybridge01 # /24 is everything in that network

docker network ls
# the new bridge adapter is now there

# to remove the bridge
docker network rm mybridge01
```

### ---- Docker Network: Assign to Containers

```
# subnet itself can be 10.1.[1-254].[1-254] while ip-range is 10.1.4.[1-254]
# that is class b and class c respectively
docker network create --subnet 10.1.0.0/16 --gateway 10.1.0.1 --ip-range=10.1.4.0/24 --driver=bridge --label=host4network bridge04
```

If you then inspect the new above network config, it will have those settings within that inspect config.

So how do we now use this new network?

```
docker run -it --name nettest1 --net bridge04 --ip 10.1.4.100 centos:latest /bin/bash

# if we docker inspect nettest1 | grep IP we can see the address set at 10.1.4.100
```

---

## Docker commands and structures

### ---- Inspect Container Processes

From the outside, we can run `docker exec` to get some more details about the container itself.

`docker exec container_name /bin/ps aux | grep bash`

We can use `docker top` to see the top command run on a container.

`docker top container_name`

Let's execute a command to install `sshd`. We could attach to container and do so, but we have a few options. Instead of attaching, we could do the following:

`docker exec -i -t container_name /bin/bash`

This will ensure that the container doesn't stop, but will actually run two instances of `bash`. We can verify this by looking at the container processes.

So far, this can give us a momentary snap shot.

**See the history of previous processes and performances**

We can use `docker stats` to see a live set of information for that container.

`dock stats container_name`

This will keep a view that is constantly updated to see what is going on.

### ---- Previous Container Management

Just to see the previous containers not running with just their ids, we can run `docker ps -a -q`

Of course, for removing older containers, we can `docker rm` previous containers.

We can also remove containers from the `/var/lib/docker` folder as the super user. If you do it this way, you want to ensure that you have `systemctl stop/restart docker` to ensure that there aren't any issues with Docker.

### ---- Controlling Port Exposure on Containers

In this example, start up a nginx container in daemon mode without remapping the ports.

Again, we can inspect this container to find the IP etc. We know that we can get anything remapped to the localhost currently because there is no remapping.

In contrast, we can use `-P` to expose the ports and it will auto remap to high port value.

`-p 8080:80` will be use defining the port that we want to expose it to.

If we want to define a certain interface eg. localhost...

`docker run -itd -p 127.0.01:8081:80 nginx:latest` would ONLY allow localhost to access this site.

### ---- Naming Containers

To rename containers, we can run `docker rename currentname newname` - you can even rename container IDs, although there is likely no point.

You can also rename running containers!

### ---- Docker Events

How can we monitor certain events?

Startup a few containers.

When we interact with them, certain events are generated.

If we run `docker events`, it will begin a program to wait and register certain events.

If we run `docker events --since '1h'`, we can then see all the events that have happened in the last hour.

If we run just `docker events` and run a `dok exec -it mycontainerid /bin/bash` command, we will then see those events registered. This is useful for debugging and monitoring the entire host.

We may not care about every event though. What happens if we just care about an attachment?

`docker events --filter <keyword>` can then be used to filter for events we care about.

`docker events --filter event=attach`

We can also filter for multiple events with multiple `--filter event=<event>`

### ---- Managing and Removing Base Images

If you remove an image by name, then if there is a double up of the same ID, it will just remove the named image - however an ID removal will warn you if they share the ID. They only way to remove all of them is to use the force `-f` flag.

### ---- Saving and Loading Docker Images

**Saving**

When we pull images, we can pull from local or from Docker Hub. You will use base of an official release usually etc.

How can we manage our custom images? We can `tar` any file and migrate it to another compute etc.

`docker commit containername centos:mine`

This will allow us to save the image but remove the containers!

We can use

```
docker save --output centos.latest.tar centos:latest
```

If you `ls` the tar file, it will give you details about the image/container.

**Restoring**

`docker load --input centos.latest.tar`

If we have `gzip` a tar file, we can also load it directly from the `.tar.gz` file.

### ---- Image History

How can we get the history of the base image?

`docker history imagename`

This will give us a list of commands etc.

### ---- Take Control of Our Tags

Changes in the container is what is kept in storage layering.

`docker tag imageid mine/centos:v1.0` - this will create a new image with the repo tag.

`docker tag mine/centos:v1.0 dok.example.com/centos:v1.0b` will do the same.

### ---- Pushing to Docker Hub

`docker login --username=name` throw in the password and you'll be authenticated.

One authenticated, `docker push image`

Of course, to bring it back down, you will hit `docker pull name`

---

## Integration and Use Cases

### ---- Building a Web Farm for Development and Testing

_Prerequisites_

So far, we have not had a specific purpose for Docker containers. These following examples are for real world use cases.

Set up a web farm with two Apache web nodes on port 80 - both sharing one or more file systems.

_Part One_
