# Docker Cheat Sheet

### 3 Parts of Docker

1. Docker Engine
2. Compose
3. Machine

```
// see versions in shell
docker --version
docker-compose --version
docker-machine --version
```

## Getting started

Open a command-line terminal, and run some Docker commands to verify that Docker is working as expected.
Some good commands to try are docker version to check that you have the latest release installed, and docker ps and docker run hello-world to verify that Docker is running.

```
docker version
docker ps
docker run hello-world
```

To start a Dockerized web server:

```
docker run -d -p 80:80 --name webserver nginx
```

Run `docker ps` while your web server is running to see details on the webserver container.

## Adding registries

As an alternative to using Docker Hub to store your public or private images or Docker Trusted Registry, you can use Docker to set up your own insecure registry. Add URLs for insecure registries and registry mirrors on which to host your images.

## HTTP proxy settings

Docker for Mac will detect HTTP/HTTPS Proxy Settings and automatically propagate these to Docker and to your containers. For example, if you set your proxy settings to http://proxy.example.com, Docker will use this proxy when pulling containers.

## File Sharing

You can decide which directories on your Mac to share with containers.

Add a Directory - Click + and navigate to the directory you want to add.

Click Apply & Restart to make the directory available to containers using Docker’s bind mount (-v) feature.

**There are some limitations on the directories that can be shared:**

They cannot be a subdirectory of an already shared directory.
They cannot already exist inside of Docker.

## Uninstalling

Docker for Mac can also be uninstalled using a command-line terminal:

```
(mdfind Docker.app)/Contents/MacOS/Docker --uninstall
```

## Autocompletion

To activate bash completion, these files need to be copied or symlinked to your bash_completion.d directory. For example, if you use Homebrew:

```
cd /usr/local/etc/bash_completion.d
ln -s /Applications/Docker.app/Contents/Resources/etc/docker.bash-completion
ln -s /Applications/Docker.app/Contents/Resources/etc/docker-machine.bash-completion
ln -s /Applications/Docker.app/Contents/Resources/etc/docker-compose.bash-completion
```

# Get started with Docker tutorial

## Show all of your containers

```
docker ps -a
```

## How to run images

Breakdown of `docker run hello-world`

An image is a filesystem and parameters to use at runtime. It doesn’t have state and never changes. A container is a running instance of an image. When you ran the command, Docker Engine:

checked to see if you had the hello-world software image
downloaded the image from the Docker Hub (more about the hub later)
loaded the image into the container and “ran” it
Depending on how it was built, an image might run a simple, single command and then exit. This is what Hello-World did.

A Docker image, though, is capable of much more. An image can start software as complex as a database, wait for you (or someone else) to add data, store the data for later use, and then wait for the next person.

Who built the hello-world software image though? In this case, Docker did but anyone can. Docker Engine lets people (or companies) create and share software through Docker images. Using Docker Engine, you don’t have to worry about whether your computer can run the software in a Docker image — a Docker container can always run it.

## Find and run the Whalesy Image

### Print random fortune cookie message
$ docker run mendlik/docker-whalesay

### Print custom message
$ docker run mendlik/docker-whalesay "Your message"

### Let's see what's inside the container
$ docker run -it --entrypoint /bin/bash mendlik/docker-whalesay

## See all of your images

```
docker images
```

# Create your own image

1. Make directory - this serves as the `context` for the build. The context just means it contains all the things you need to build your image.
2. Change into your new directory
3. `touch Dockerfile`

Open this file, and add...

`FROM docker/whalesay:latest`

The FROM keyword tells Docker which image your image is based on. Whalesay is cute and has the cowsay program already, so we’ll start there.

Add `RUN apt-get -y update && apt-get install -y fortunes`

Now, to build...

`docker build -t docker-whale .`

## The build process

The docker build -t docker-whale . command takes the Dockerfile in the current directory, and builds an image called docker-whale on your local machine. The command takes about a minute and its output looks really long and complex.

Once it is built, you can run it using the `docker run <name>` command! 
