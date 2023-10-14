#!/bin/sh
echo "Mbatek Teko Git"
echo -n "Tulis Jenenge Branch e: "
read branch

echo "\nProses Mbatek ..."
# Pull from git branch
git pull origin $branch
echo "Mbatek Mari\n"

# Build Docker
echo "\nProses Mbangun Docker Compose ..."
docker compose build
echo "Mbangun Mari\n"

# Compose Down
echo "\nProses Bongkar Docker Compose ..."
docker compose down
echo "Bongkar Mari\n"

# Compose Up
echo "\nProses Ngunggahne Docker Compose ..."
docker compose up -d
echo "Ngunggahne Mari\n"

# Run Npm Build vite
docker exec porto-app npm run build
# Storage Link
docker exec porto-app rm -r ./public/storage
docker exec porto-app php artisan storage:link
# Run chmod for logs
docker exec porto-app chmod -R 0777 ./storage/logs
docker exec porto-app chmod -R 0777 ./storage/app

# prune image
docker image prune -f

# Prune System
docker image prune -f

