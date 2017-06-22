# Docker container with Nginx and Nodejs

First create a directory for both `nginx` and `nodejs`.

Within the Node folder, create a `Dockerfile` that contains the following to expose an app running on a particular port:

```
FROM mhart/alpine-node
# Pretend to copy the node app entry
# from current folder
COPY index.js .
```
