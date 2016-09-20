# docker-phpipam

## How to build phpipam image

```
# (optional)if you are in proxy env
$ cat env.sh
export BUILD_ARGS='--build-arg "http_proxy=\"http://proxy_ip:port\"" --build-arg "https_proxy=\"http://proxy_ip:port\"" '

# build
$ ./build_image.sh phpipam:1.2
```
