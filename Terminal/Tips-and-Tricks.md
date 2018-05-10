# Tips and Tricks

<!-- TOC -->

*   [Tips and Tricks](#tips-and-tricks)
    *   [Dealing with records](#dealing-with-records)
    *   [Load balancing](#load-balancing)
    *   [Ports](#ports)

<!-- /TOC -->

## Dealing with records

`curl -I <domain>`

Example response:

```
HTTP/1.1 301 Moved Permanently
x-amz-id-2: GhbglnY4TMT7NQy4HEFfBbrYo1L6OgepT1130/R80lZm6yDUCH8Ok
x-amz-request-id: C72E7BA4D7A6DEB8
Date: Thu, 31 Aug 2017 22:51:42 GMT
Location: https://www.domain.com/
Content-Length: 0
Server: AmazonS3
```

`dig afxr gitgood.club` - gives back record data.

## Load balancing

`ab -n 1000 -c 50 "https://staging.aemc.prescoapps.co/"` - test Load Balance with reqs
.

## Ports

`sudo lsof -i :3090` - what's using port 3090.

`telnet redrooster.com.au 22` - Does the server at redrooster.com.au listen on port 22 (standard ssh port)?
