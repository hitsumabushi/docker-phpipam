#!/bin/sh

TAG=$1

if [ $# != 1 ]; then
  echo "Invarid number of argment." 1>&2
  echo "$0 _IMAGE_TAG_" 1>&2
  return 1
fi

IMAGE_BUILD_DATE=$(date --iso-8601=seconds)
IMAGE_VCS_REF=$(git rev-parse HEAD)
PHPIPAM_VERSION=$(cat PHPIPAM_VERSION | tr -d ' ' | tr -d '\n')

docker build \
  --build-arg "IMAGE_BUILD_DATE=${IMAGE_BUILD_DATE}" \
  --build-arg "IMAGE_VCS_REF=${IMAGE_VCS_REF}" \
  --build-arg "PHPIPAM_VERSION=${PHPIPAM_VERSION}" \
  ${BUILD_ARGS} \
  -t ${TAG} \
  -f dockerimages/phpipam/Dockerfile \
  dockerimages/phpipam/
