# MyCalculator

A simple Laravel calculator app for testing Docker, Multipass, GitHub image builds, and control-plane tenant provisioning.

## Run locally or in Multipass

```bash
cp .env.example .env
docker compose build --no-cache
docker compose up -d
```

Open:

```text
http://localhost:8199
```

Health check:

```bash
curl http://localhost:8199/health
```

## Run on a Multipass VM

From your Mac:

```bash
multipass launch --name mycalculator-vm --memory 2G --disk 15G
multipass shell mycalculator-vm
```

Inside the VM:

```bash
sudo apt update
sudo apt install -y docker.io docker-compose-plugin unzip
sudo usermod -aG docker $USER
newgrp docker
```

Copy this ZIP into the VM, unzip it, then run:

```bash
cd mycalculator
cp .env.example .env
docker compose build --no-cache
docker compose up -d
```

Find VM IP:

```bash
multipass info mycalculator-vm
```

Open:

```text
http://VM_IP:8199
```

## Production image deployment

Your control plane/worker should not copy source code to tenant servers. It should copy only:

```text
docker-compose.prod.yml
.env
infrastructure/nginx/default.conf
```

Then run:

```bash
docker compose -f docker-compose.prod.yml pull
docker compose -f docker-compose.prod.yml up -d
```

Set the image tag with:

```bash
export MYCALCULATOR_IMAGE=ghcr.io/wafariko-limited/mycalculator:latest
```
