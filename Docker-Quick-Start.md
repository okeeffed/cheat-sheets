# Docker Quickstart

---

<!-- TOC -->

*   [Docker Quickstart](#docker-quickstart)
    *   [Basic commands](#basic-commands)
    *   [Running the whalesay container](#running-the-whalesay-container)
    *   [Inspecting Docker images](#inspecting-docker-images)
    *   [Container Lifecycle](#container-lifecycle)
    *   [Image and Container Management](#image-and-container-management)
    *   [Redirection - Ports and Volumes](#redirection---ports-and-volumes)
    *   [The Dockerfile](#the-dockerfile)

<!-- /TOC -->

## Basic commands

```
Usage: docker [OPTIONS] COMMAND [arg...]
       docker [ --help | -v | --version ]

A self-sufficient runtime for containers.

Options:

  --config=~/.docker              Location of client config files
  -D, --debug                     Enable debug mode
  -H, --host=[]                   Daemon socket(s) to connect to
  -h, --help                      Print usage
  -l, --log-level=info            Set the logging level
  --tls                           Use TLS; implied by --tlsverify
  --tlscacert=~/.docker/ca.pem    Trust certs signed only by this CA
  --tlscert=~/.docker/cert.pem    Path to TLS certificate file
  --tlskey=~/.docker/key.pem      Path to TLS key file
  --tlsverify                     Use TLS and verify the remote
  -v, --version                   Print version information and quit

Commands:
    attach    Attach to a running container
    build     Build an image from a Dockerfile
    commit    Create a new image from a container's changes
    cp        Copy files/folders between a container and the local filesystem
    create    Create a new container
    diff      Inspect changes on a container's filesystem
    events    Get real time events from the server
    exec      Run a command in a running container
    export    Export a container's filesystem as a tar archive
    history   Show the history of an image
    images    List images
    import    Import the contents from a tarball to create a filesystem image
    info      Display system-wide information
    inspect   Return low-level information on a container, image or task
    kill      Kill one or more running containers
    load      Load an image from a tar archive or STDIN
    login     Log in to a Docker registry.
    logout    Log out from a Docker registry.
    logs      Fetch the logs of a container
    network   Manage Docker networks
    node      Manage Docker Swarm nodes
    pause     Pause all processes within one or more containers
    port      List port mappings or a specific mapping for the container
    ps        List containers
    pull      Pull an image or a repository from a registry
    push      Push an image or a repository to a registry
    rename    Rename a container
    restart   Restart a container
    rm        Remove one or more containers
    rmi       Remove one or more images
    run       Run a command in a new container
    save      Save one or more images to a tar archive (streamed to STDOUT by default)
    search    Search the Docker Hub for images
    service   Manage Docker services
    start     Start one or more stopped containers
    stats     Display a live stream of container(s) resource usage statistics
    stop      Stop one or more running containers
    swarm     Manage Docker Swarm
    tag       Tag an image into a repository
    top       Display the running processes of a container
    unpause   Unpause all processes within one or more containers
    update    Update configuration of one or more containers
    version   Show the Docker version information
    volume    Manage Docker volumes
    wait      Block until a container stops, then print its exit code
```

## Running the whalesay container

Pull the image, run the image!

```
docker pull docker/whalesay:latest
docker images

### lists the images
REPOSITORY                TAG                 IMAGE ID            CREATED             SIZE
nginx                     latest              4efb2fcdb1ab        3 months ago        183.4 MB
hello-world               latest              c54a2cc56cbb        4 months ago        1.848 kB
mendlik/docker-whalesay   latest              552104437e78        8 months ago        172.3 MB
docker/whalesay           latest              6b362a9f73eb        18 months ago       247 MB

docker run docker/whalesay cowsay ayyyyyy mate
 ___________
< ayyy mate >
 -----------
    \
     \
      \
                    ##        .
              ## ## ##       ==
           ## ## ## ##      ===
       /""""""""""""""""___/ ===
  ~~~ {~~ ~~~~ ~~~ ~~~~ ~~ ~ /  ===- ~~~
       \______ o          __/
        \    \        __/
          \____\______/
```

## Inspecting Docker images

```
docker inspect whalesay
[
    {
        "Id": "sha256:6b362a9f73eb8c33b48c95f4fcce1b6637fc25646728cf7fb0679b2da273c3f4",
        "RepoTags": [
            "docker/whalesay:latest"
        ],
        "RepoDigests": [
            "docker/whalesay@sha256:178598e51a26abbc958b8a2e48825c90bc22e641de3d31e18aaf55f3258ba93b"
        ],
        "Parent": "",
        "Comment": "",
        "Created": "2015-05-25T22:04:23.303454458Z",
        "Container": "5460b2353ce4e2b3e3e81b4a523a61c5adc238ae21d3ec3a5774674652e6317f",
        "ContainerConfig": {
            "Hostname": "9ec8c01a6a48",
            "Domainname": "",
            "User": "",
            "AttachStdin": false,
            "AttachStdout": false,
            "AttachStderr": false,
            "Tty": false,
            "OpenStdin": false,
            "StdinOnce": false,
            "Env": [
                "PATH=/usr/local/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
            ],
            "Cmd": [
                "/bin/sh",
                "-c",
                "#(nop) ENV PATH=/usr/local/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
            ],
            "Image": "5d5bd9951e26ca0301423625b19764bda914ae39c3f2bfd6f1824bf5354d10ee",
            "Volumes": null,
            "WorkingDir": "/cowsay",
            "Entrypoint": null,
            "OnBuild": [],
            "Labels": {}
        },
        "DockerVersion": "1.6.0",
        "Author": "",
        "Config": {
            "Hostname": "9ec8c01a6a48",
            "Domainname": "",
            "User": "",
            "AttachStdin": false,
            "AttachStdout": false,
            "AttachStderr": false,
            "Tty": false,
            "OpenStdin": false,
            "StdinOnce": false,
            "Env": [
                "PATH=/usr/local/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
            ],
            "Cmd": [
                "/bin/bash"
            ],
            "Image": "5d5bd9951e26ca0301423625b19764bda914ae39c3f2bfd6f1824bf5354d10ee",
            "Volumes": null,
            "WorkingDir": "/cowsay",
            "Entrypoint": null,
            "OnBuild": [],
            "Labels": {}
        },
        "Architecture": "amd64",
        "Os": "linux",
        "Size": 247049019,
        "VirtualSize": 247049019,
        "GraphDriver": {
            "Name": "aufs",
            "Data": null
        },
        "RootFS": {
            "Type": "layers",
            "Layers": [
                "sha256:1154ba695078d29ea6c4e1adb55c463959cd77509adf09710e2315827d66271a",
                "sha256:528c8710fd95f61d40b8bb8a549fa8dfa737d9b9c7c7b2ae55f745c972dddacd",
                "sha256:37ee47034d9b78f10f0c5ce3a25e6b6e58997fcadaf5f896c603a10c5f35fb31",
                "sha256:5f70bf18a086007016e948b04aed3b82103a36bea41755b6cddfaf10ace3c6ef",
                "sha256:b26122d57afa5c4a2dc8db3f986410805bc8792af3a4fa73cfde5eed0a8e5b6d",
                "sha256:091abc5148e4d32cecb5522067509d7ffc1e8ac272ff75d2775138639a6c50ca",
                "sha256:5f70bf18a086007016e948b04aed3b82103a36bea41755b6cddfaf10ace3c6ef",
                "sha256:d511ed9e12e17ab4bfc3e80ed7ce86d4aac82769b42f42b753a338ed9b8a566d",
                "sha256:d061ee1340ecc8d03ca25e6ca7f7502275f558764c1ab46bd1f37854c74c5b3f",
                "sha256:5f70bf18a086007016e948b04aed3b82103a36bea41755b6cddfaf10ace3c6ef"
            ]
        }
    }
]
```

---

## Container Lifecycle

There is a lifecycle associated with starting, stopping, restarting etc.

```
docker run -d --name LifeCycle1 nginx:latest
docker attach LifeCycle1

// exec if the container started indirectly
docker exec -it LifeCycle1 /bin/bash
```

We don't have to attach to the container with the `exec` command. We can just connect to is just to execute a command - like a `ssh` prompt!

---

## Image and Container Management

```
# remove the image
docker rmi image-name

# remove all containers
docker rm `docker ps -a -q`
```

---

## Redirection - Ports and Volumes

**Ports**

Ports are exposed in a container so that you can connect via the container IP but must be exposed via the `dockerfile`.

We can direct the port for a http container to a port on the underlying host.

`docker run -d -P --name:webserver nginx:latest`

To find all the address redirection, we can write `docker port WebServer1 $CONTAINERPORT`

```
okeeffe_d@dok ~$ docker port WebServer1 $CONTAINERPORT

443/tcp -> 0.0.0.0:32768
80/tcp -> 0.0.0.0:32769
```

`docker run -d -p 8080:80 --name=webserver nginx:latest` is also useful for a variety of reasons.

We no longer have to worry about routing - we can do dev/set up the correct ports. We no longer have to do any static routing.

No we can pass stuff to the host without having to copy it.

This means we can mount underlying directories.

```
docker run -d -p 8080:80 --name=webserver -v /mnt/data nginx:latest # mount data
```

Good practise is to keep the container as emphemeral as possible. It should not contain things that won't stick around. We want to run a command and start a container without a complex configuration.

// 15 min mark

If we create a basic file and create a HTML page, we could then run

```
docker run -d -p 8080:80 --name=webserver -v /home/user/www:/usr/share/nginx/html nginx:latest

// this will mount the file and mount it to that directory. We can push multiple mounts!
```

---

## The Dockerfile

Very few times will you start with a generic list of packages for a base image and creating it from nothing.

You'll base on it on things like `debian, ubuntu` etc.

The Dockerfile is an easy to read, easy to write script to build an image following instructions.

You can name it whatever, but will probably just be stored in `Dockerfile` anyway.

Note, things will cache if they've already been done!

Example Dockerfile:

```
# most have FROM which image
FROM debian:stable
MAINTAINER dockerhubid <email>

# best practise is to combined commands
RUN apt-get update && age-get upgrade - y && apt-get install -y apache2 telnet elinks ssh openssh-server
ENV MYVALUE my-value
```

Then docker run!

```
docker run -it dockerhubid/myapache:latest /bin/bash

> echo MYVALUE
my-value
```

**Exposing or preventing exposing ports**

```
# most have FROM which image
FROM debian:stable
MAINTAINER dockerhubid <email>

# best practise is to combined commands
RUN apt-get update && age-get upgrade - y && apt-get install -y apache2 telnet elinks ssh openssh-server
ENV MYVALUE my-value

EXPOSE 80
EXPOSE 22

CMD ["/usr/sbin/apache2tl","-D","FOREGROUND"]
```

Now if we Docker inspect on the file and find the IPAddr, we can see that the Apache website is now running!
