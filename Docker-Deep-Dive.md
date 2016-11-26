## Docker Deep Dive

***

## Docker Basics 

### ---- Working with Multiple Images

```
# i: interactive, t: tty, d: daemon mode
docker run -i -t -d ubuntu:latest /bin/bash

# to attach to the container and edit the container
docker attach container_name
```

***

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

__Order of Execution__

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

__Creating Docker network configs__

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

***

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

__See the history of previous processes and performances__

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











































