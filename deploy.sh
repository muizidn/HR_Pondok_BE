#!/bin/bash

IMAGE_NAME="hr-pondok-laravel-api"
CONTAINER_NAME="hr-pondok-laravel-api"

# Stop and remove existing container if running
docker stop $CONTAINER_NAME 2>/dev/null
docker rm $CONTAINER_NAME 2>/dev/null

# Build the Docker image
docker build -t $IMAGE_NAME .

# Run the Docker container
docker run -p 8000:8000 -e APP_ENV=production --name $CONTAINER_NAME $IMAGE_NAME
