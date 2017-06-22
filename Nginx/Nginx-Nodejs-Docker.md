# Docker container with Nginx and Nodejs

First create a directory for both `nginx` and `nodejs`.

Within the Node folder, create a `Dockerfile` that contains the following to expose an app running on a particular port:

```
FROM mhart/alpine-node
# Pretend to copy the node app entry
# from current folder
COPY index.js .
# Expose the port that it is running on
EXPOSE 3000
# Run node - chances are you want pm2 here
CMD node index.js
```

Then we can build with `docker built -t foo/node .`

After the build, run the container with port 3000 exposed using `docker run -d -p 3000:3000`
