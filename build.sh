#!/bin/sh

docker build -t gcr.io/wiresafe-project/public-website .
gcloud docker -- push gcr.io/wiresafe-project/public-website
