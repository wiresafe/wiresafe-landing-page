#!/bin/sh

docker build -t gcr.io/wiresafe-project/wiresafe-landing-page
gcloud docker -- push gcr.io/wiresafe-project/wiresafe-landing-page
# apply with kubectl to rebuild containers
kubectl apply -f deploy.yaml
