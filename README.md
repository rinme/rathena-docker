# rAthena Docker

This repository provides a Docker Compose setup to quickly get [rAthena](https://github.com/rathena/rathena) running on any OS. It is intended for **local development** and is **not suitable for production deployments**.

---

## Pre-Requisites

- A basic understanding of Linux-based operating systems.
- [Docker](https://docs.docker.com/get-docker/) installed and running on your machine.
- [Docker Compose](https://docs.docker.com/compose/install/) (included with Docker Desktop).

## Quick Start

1. Clone the rAthena repository next to this `rathena-docker` directory:

   ```bash
   git clone https://github.com/rathena/rathena.git
   ```

   Your directory layout should look like this:

   ```
   /home/your-user/
   ├── rathena/          <-- cloned rAthena source
   └── rathena-docker/   <-- this directory
   ```

2. Start all services:

   ```bash
   cd rathena-docker
   docker-compose up
   ```

   On the first run, Docker will pull the base images and then compile rAthena from source inside the `builder` container. Wait for the build to finish — you will see `rathena-builder exited with code 0` in the logs.

3. Press `Ctrl+C` to stop everything, then run:

   ```bash
   docker-compose up
   ```

   This time the servers will start normally because the binaries are already compiled.

4. Alternatively, run in detached mode:

   ```bash
   docker-compose up -d
   ```

   To shut down gracefully:

   ```bash
   docker-compose down
   ```

## Services

| Service   | Container Name     | Port   | Description             |
|-----------|--------------------|--------|-------------------------|
| `db`      | `rathena-db`       | 3306   | MariaDB database        |
| `builder` | `rathena-builder`  | —      | Compiles rAthena source |
| `login`   | `rathena-login`    | 6900   | Login server            |
| `char`    | `rathena-char`     | 6121   | Character server        |
| `map`     | `rathena-map`      | 5121   | Map server              |

## Directory Structure

```
rathena-docker/
├── docker-compose.yml   # Main compose file defining all services
├── Dockerfile           # Alpine-based image with build dependencies
├── builder.sh           # Script that compiles rAthena on first run
├── README.md            # This file
└── asset/
    ├── inter_conf.txt   # Inter-server config (DB host = "db")
    ├── char_conf.txt    # Char-server config (login host = "login")
    └── map_conf.txt     # Map-server config (char host = "char")
```

## Configuration

### Packet Version

To change the client packet version, edit the `BUILDER_CONFIGURE` environment variable in `docker-compose.yml`:

```yaml
environment:
    BUILDER_CONFIGURE: "--enable-packetver=20211103"  # Change this
```

### Database Credentials

The default database credentials are:

| Setting   | Value      |
|-----------|------------|
| Host      | `localhost`|
| Port      | `3306`     |
| User      | `ragnarok` |
| Password  | `ragnarok` |
| Database  | `ragnarok` |

On first startup, all `*.sql` files from `../rathena/sql-files/` are automatically imported into the database. This only happens once — subsequent restarts will reuse the persisted volume.

To fully erase the database and start fresh:

```bash
docker-compose down --volumes
```

### Network Layout

The inter-server config files in `asset/` use Docker container names as hostnames, so services can reach each other over the internal Docker network:

| File              | Purpose                                           |
|-------------------|---------------------------------------------------|
| `inter_conf.txt`  | All database IPs are set to `db`                  |
| `char_conf.txt`   | Login server = `login`; char IP = `127.0.0.1`    |
| `map_conf.txt`    | Char server = `char`; map IP = `127.0.0.1`       |

## Common Commands

| Command                              | Description                                              |
|--------------------------------------|----------------------------------------------------------|
| `docker-compose up -d`               | Start all services in detached mode                      |
| `docker-compose up`                  | Start all services with logs attached                    |
| `docker-compose down`                | Stop and remove all containers                           |
| `docker-compose down --volumes`      | Stop, remove containers **and** delete the database      |
| `docker-compose ps`                  | Check the status of running containers                   |
| `docker-compose run builder bash`    | Open a shell in the builder container                    |
| `docker-compose build`               | Rebuild the Docker image after modifying the Dockerfile  |
| `docker logs <container_name>`       | View logs for a specific container                       |

## Recompiling After Source Changes

If you modify files in the rAthena `src/` directory, you need to recompile:

1. Open a shell in the builder container:

   ```bash
   docker-compose run builder bash
   ```

2. Run the build commands:

   ```bash
   make clean server
   ```

3. Exit the shell and restart the servers:

   ```bash
   docker-compose down
   docker-compose up
   ```

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Port 3306 already in use | Ensure no local MySQL/MariaDB instance is running on port 3306. Stop it or change the port mapping in `docker-compose.yml`. |
| `ls: can't open '.': Permission denied` | Turn off SELinux on your host system. |
| Builder fails to compile | Check that the `BUILDER_CONFIGURE` packet version matches the one expected by your client. Ensure the rAthena source is at the correct relative path (`../../` from this directory). |

## Useful Links

- [rAthena GitHub Repository](https://github.com/rathena/rathena)
- [rAthena Docker User Guide](https://rathena.github.io/user-guides/installing/docker/)
- [rAthena Wiki — Installations](https://github.com/rathena/rathena/wiki/installations)
