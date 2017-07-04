# wiresafe-landing-page
Wiresafe.com public website

## build
Any changes to src/* must be compiled to a docker image and pushed to the
private docker repo in gcloud.

```sh
$ build.sh
```

or

```sh
docker build -t gcr.io/wiresafe-project/wiresafe-landing-page
gcloud docker -- push gcr.io/wiresafe-project/wiresafe-landing-page
# apply with kubectl to rebuild containers
kubectl apply -f deploy.yaml

```
