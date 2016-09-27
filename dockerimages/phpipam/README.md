# docker-phpipam

## How to use docker image

```
docker pull hitsumabushi/phpipam
```

## How to build phpipam image

```
# (optional)if you are in proxy env
$ export BUILD_ARGS='--build-arg "http_proxy=\"http://proxy_ip:port\"" --build-arg "https_proxy=\"http://proxy_ip:port\"" '

# build
$ ./build_image.sh phpipam:latest
```
