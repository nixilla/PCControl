# PC shutdown app

[![Build Status](https://travis-ci.org/nixilla/PCControl.svg?branch=master)](https://travis-ci.org/nixilla/PCControl)

Exposes API to shutdown PC remotely. Very useful when you have kids.

## How it works?

```
curl -v http://host:port

> GET / HTTP/1.1
> User-Agent: curl/7.38.0
> Host: host
> Accept: */*
> 
< HTTP/1.1 200 OK
* Server nginx/1.4.6 (Ubuntu) is not blacklisted
< Server: nginx/1.4.6 (Ubuntu)
< Content-Type: application/json
< Transfer-Encoding: chunked
< Connection: keep-alive
< Set-Cookie: PHPSESSID=0ntrbvh2j1a7qp4shrrtscohe0; path=/; HttpOnly
< Cache-Control: no-cache
< X-Debug-Token: 04c5a2
< X-Debug-Token-Link: /_profiler/04c5a2
< Date: Thu, 03 Mar 2016 14:23:26 GMT
< 

{"status":"running","hostname":"ubuntu-14","boottime":"about 1 hour ago","token":"b47f6a56070038bc7c6d1411b21ff1bfc14cef8b26c534a0ea488c1bc44d1103"}

curl -v http://host:port/ -X POST -H "Content-Type: application/json" \
--data '{"token":"b47f6a56070038bc7c6d1411b21ff1bfc14cef8b26c534a0ea488c1bc44d1103"}' \
--cookie "PHPSESSID=0ntrbvh2j1a7qp4shrrtscohe0"

> POST / HTTP/1.1
> User-Agent: curl/7.38.0
> Host: host
> Accept: */*
> Cookie: PHPSESSID=0ntrbvh2j1a7qp4shrrtscohe0
> Content-Type: application/json
> Content-Length: 76
> 
* upload completely sent off: 76 out of 76 bytes
< HTTP/1.1 200 OK
* Server nginx/1.4.6 (Ubuntu) is not blacklisted
< Server: nginx/1.4.6 (Ubuntu)
< Content-Type: application/json
< Transfer-Encoding: chunked
< Connection: keep-alive
< Cache-Control: no-cache
< X-Debug-Token: 84ce29
< X-Debug-Token-Link: /_profiler/84ce29
< Date: Thu, 03 Mar 2016 14:26:45 GMT
< 

{"status":"shutting down"}
```