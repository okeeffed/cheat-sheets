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

After the build, run the container with port 3000 exposed using `docker run -d -p 3000:3000 --name node-app foo/node`.

First, we can test the Nginx latest container container using `docker run --rm -p 8000:80 nginx` to test out nginx:latest. This just removes the container after running.

In the `nginx` folder, we can create `default.conf` file to overwrite the initial one.

If settings are not defined below, Nginx will use the default values.

```
# config
server {
	location / {
		# host name first
		proxy_set_header Host $host;
		# extra headers for host IP address
		proxy_set_header X-Real-IP $remote_addr;
		proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
		# passing protocol used (http | https)
		proxy_set_header X-Forwarded-Proto $scheme;
		# where to proxy reqs to
		proxy_pass http://app:3000;
	}
}
```

For the Docker file.

```
FROM nginx
COPY default.cong /etc/nginx/conf.d/
```

Then build out this file using `docker built -t foo/nginx .`.

Running it: `docker run -p 8000:80 --link node-app:app`
