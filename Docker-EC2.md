# Docker EC2

<!-- TOC -->

*   [Docker EC2](#docker-ec2)
    *   [Steps](#steps)
    *   [Useful Commands](#useful-commands)

<!-- /TOC -->

## Steps

1.  Deploy an EC2 Instance
2.  Install Docker onto that instance
3.  Create SSH Key
4.  Add that the key to Github
5.  Git pull using that key
6.  Docker build

[Installing Docker onto EC2](http://docs.aws.amazon.com/AmazonECS/latest/developerguide/docker-basics.html)
[Github: Generating SSH Keys](https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/)

## Useful Commands

*   `docker build . -t='dok/name:latest'`
*   `docker run -p 80:80 -d -t dok/name:latest`
