# rAthena Docker Compose

Complete Docker Compose setup for running [rAthena](https://github.com/rathena/rathena) with a full web stack. Includes the game servers, database, **phpMyAdmin**, and **FluxCP** control panel — all configurable via a single `.env` file.

This setup is intended for **local development** and is **not suitable for production deployments**.

---

## Pre-Requisites

- [Docker](https://docs.docker.com/get-docker/) installed and running on your machine.
- [Docker Compose](https://docs.docker.com/compose/install/) (included with Docker Desktop).
- Basic understanding of Linux-based operating systems.

---

## Directory Layout

Your directory structure should look like this:

```
/home/your-user/
├── rathena/              <-- cloned rAthena source (git clone https://github.com/rathena/rathena.git)
└── rathena-docker/       <-- this directory
    ├── docker-compose.yml
    ├── Dockerfile
    ├── builder.sh
    ├── .env
    ├── .gitignore
    ├── README.md
    ├── asset/
    │   ├── inter_conf.txt
    │   ├── char_conf.txt
    │   └── map_conf.txt
    └── fluxcp/
        ├── Dockerfile
        ├── .htaccess
        ├── config/
        │   ├── application.php
        │   └── servers.php
        └── (FluxCP source files...)
```

---

## Quick Start

1. Clone the rAthena repository next to this directory:

   ```bash
   git clone https://github.com/rathena/rathena.git
   ```

2. Copy and edit the environment file:

   ```bash
   cd rathena-docker
   cp .env .env   # Already present — just edit the values you need
   ```

3. Start all services:

   ```bash
   docker-compose up
   ```

   On the first run, Docker will pull images and compile rAthena from source. Wait for `rathena-builder exited with code 0`.

4. Press `Ctrl+C`, then restart:

   ```bash
   docker-compose up
   ```

   Or run in detached mode:

   ```bash
   docker-compose up -d
   ```

---

## Services

| Service       | Container              | Host Port | Internal Port | Description                    |
|---------------|------------------------|-----------|---------------|--------------------------------|
| `db`          | `rathena-db`           | 3306      | 3306          | MariaDB database               |
| `builder`     | `rathena-builder`      | —         | —             | Compiles rAthena from source   |
| `login`       | `rathena-login`        | 6900      | 6900          | Login server                   |
| `char`        | `rathena-char`         | 6121      | 6121          | Character server               |
| `map`         | `rathena-map`          | 5121      | 5121          | Map server                     |
| `phpmyadmin`  | `rathena-phpmyadmin`   | 8080      | 80            | Web-based database manager     |
| `fluxcp`      | `rathena-fluxcp`       | 80        | 80            | rAthena web control panel      |

---

## Accessing the Web Interfaces

After starting the services, you can access:

| Service       | URL                                    |
|---------------|----------------------------------------|
| **phpMyAdmin** | `http://localhost:8080`               |
| **FluxCP**     | `http://localhost:80`                 |

Log in to phpMyAdmin with your database credentials (defaults: `ragnarok` / `ragnarok`).

For FluxCP, on first visit you will be asked for the **Installer Password** (default: `secretpassword`). This is used to run the database migrations that set up FluxCP's internal tables.

---

## Configuration via `.env`

All configurable values are in the `.env` file. Every variable uses `${VAR:-default}` syntax in `docker-compose.yml`, so **the `.env` file is optional** — but it is the recommended way to customize your setup without editing YAML.

### Database

| Variable              | Default      | Description                 |
|-----------------------|--------------|-----------------------------|
| `DB_IMAGE`            | `mariadb:noble` | MariaDB Docker image     |
| `DB_HOST_PORT`        | `3306`       | Host port for database      |
| `DB_ROOT_PASSWORD`    | `ragnarok`   | MySQL root password         |
| `DB_NAME`             | `ragnarok`   | Database name               |
| `DB_USER`             | `ragnarok`   | Database user               |
| `DB_PASSWORD`         | `ragnarok`   | Database password           |

### Builder / Packet Version

| Variable              | Default                                 | Description                    |
|-----------------------|-----------------------------------------|--------------------------------|
| `BUILDER_CONFIGURE`   | `--enable-packetver=20211103`           | Packet version for compilation |

### Server Ports

| Variable           | Default | Description        |
|--------------------|---------|--------------------|
| `LOGIN_HOST_PORT`  | `6900`  | Login server port  |
| `CHAR_HOST_PORT`   | `6121`  | Char server port   |
| `MAP_HOST_PORT`    | `5121`  | Map server port    |

### phpMyAdmin

| Variable                | Default | Description                     |
|-------------------------|---------|---------------------------------|
| `PHPMYADMIN_HOST_PORT`  | `8080`  | Host port for phpMyAdmin        |
| `PHPMYADMIN_ARBITRARY`  | `0`     | Allow arbitrary server login    |

### FluxCP

| Variable                   | Default        | Description                          |
|----------------------------|----------------|--------------------------------------|
| `FLUXCP_HOST_PORT`         | `80`           | Host port for FluxCP                 |
| `FLUXCP_SERVER_ADDRESS`    | `localhost:80` | URL displayed in FluxCP footer       |
| `FLUXCP_BASE_URI`          | `/`            | Base URI path                        |
| `FLUXCP_FORCE_HTTPS`       | `false`        | Force HTTPS connections              |
| `FLUXCP_INSTALLER_PASSWORD`| `secretpassword`| Installer/updater password           |
| `FLUXCP_SERVER_NAME`       | `FluxRO`       | Server name shown in FluxCP          |
| `FLUXCP_DB_HOSTNAME`       | `db`           | Database hostname (Docker internal)  |
| `FLUXCP_DB_USERNAME`       | `ragnarok`     | Database username                    |
| `FLUXCP_DB_PASSWORD`       | `ragnarok`     | Database password                    |
| `FLUXCP_DB_DATABASE`       | `ragnarok`     | Database name                        |
| `FLUXCP_LOGIN_ADDR`        | `login`        | Login server hostname (Docker)       |
| `FLUXCP_LOGIN_PORT`        | `6900`         | Login server port                    |
| `FLUXCP_CHAR_ADDR`         | `char`         | Char server hostname (Docker)        |
| `FLUXCP_CHAR_PORT`         | `6121`         | Char server port                     |
| `FLUXCP_MAP_ADDR`          | `map`          | Map server hostname (Docker)         |
| `FLUXCP_MAP_PORT`          | `5121`         | Map server port                      |
| `FLUXCP_BASE_EXP_RATE`     | `100`          | Base exp rate (display)              |
| `FLUXCP_JOB_EXP_RATE`      | `100`          | Job exp rate (display)               |
| `FLUXCP_MVP_EXP_RATE`      | `100`          | MVP exp rate (display)               |
| `FLUXCP_SITE_TITLE`        | `Flux Control Panel` | Site title                     |
| `FLUXCP_TIMEZONE`          | `UTC`          | Default timezone                     |
| `FLUXCP_MAILER_FROM`       | `noreply@localhost` | From email address              |
| `FLUXCP_MAILER_NAME`       | `FluxCP`       | From email name                      |

---

## Common Commands

| Command                                | Description                                           |
|----------------------------------------|-------------------------------------------------------|
| `docker-compose up -d`                 | Start all services in detached mode                   |
| `docker-compose up`                    | Start all services with logs attached                 |
| `docker-compose down`                  | Stop and remove all containers                        |
| `docker-compose down --volumes`        | Stop, remove containers **and** delete the database   |
| `docker-compose ps`                    | Check the status of running containers                |
| `docker-compose run builder bash`      | Open a shell in the builder container                 |
| `docker-compose build fluxcp`          | Rebuild the FluxCP image after modifying configs      |
| `docker-compose build`                 | Rebuild all custom images                             |
| `docker logs <container_name>`         | View logs for a specific container                    |

---

## Recompiling After Source Changes

If you modify files in the rAthena `src/` directory:

```bash
docker-compose run builder bash
make clean server
exit
docker-compose down
docker-compose up
```

---

## Resetting the Database

To fully erase the database and start fresh:

```bash
docker-compose down --volumes
docker-compose up
```

On the first startup, all `*.sql` files from `../rathena/sql-files/` are automatically imported. This only happens once — subsequent restarts reuse the persisted volume.

---

## Network Architecture

All services communicate over an internal Docker network using container names as hostnames:

```
┌─────────────┐     ┌──────────────┐     ┌──────────────┐
│   phpMyAdmin │     │    FluxCP     │     │   Client     │
│  (port 8080) │     │  (port 80)    │     │  (game)      │
└──────┬──────┘     └──────┬───────┘     └──────┬───────┘
       │                   │                     │
       │                   │                     ▼
       │                   │              ┌──────────────┐
       │                   │              │    login     │
       │                   │              │  (port 6900)  │
       │                   │              └──────┬───────┘
       │                   │                     │
       │                   │              ┌──────▼───────┐
       │                   └─────────────▶│     char     │
       │                                  │  (port 6121)  │
       │                                  └──────┬───────┘
       │                                         │
       │                                  ┌──────▼───────┐
       └─────────────────────────────────▶│      db      │
                                          │  (port 3306)  │
                                          └──────┬───────┘
                                                 │
                                          ┌──────▼───────┐
                                          │     map      │
                                          │  (port 5121)  │
                                          └──────────────┘
```

The FluxCP and phpMyAdmin config files use Docker container names (`db`, `login`, `char`, `map`) so they resolve correctly within the Docker network. External clients connect via the published host ports.

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Port 3306 already in use | Ensure no local MySQL/MariaDB is running on port 3306, or change `DB_HOST_PORT` in `.env`. |
| Port 80 already in use | Change `FLUXCP_HOST_PORT` in `.env` to something like `8080`. |
| `ls: can't open '.': Permission denied` | Turn off SELinux on your host system. |
| Builder fails to compile | Check that `BUILDER_CONFIGURE` packet version matches your client. Ensure the rAthena source is at the correct relative path. |
| FluxCP shows "Unable to connect" | Verify `FLUXCP_DB_HOSTNAME`, `FLUXCP_DB_USERNAME`, and `FLUXCP_DB_PASSWORD` match your database settings. Ensure the database container is running. |
| FluxCP data directory permission errors | The FluxCP Dockerfile sets proper ownership, but if issues persist, run: `docker-compose run fluxcp chown -R www-data:www-data /var/www/html/data/` |

---

## Useful Links

- [rAthena GitHub Repository](https://github.com/rathena/rathena)
- [rAthena Docker User Guide](https://rathena.github.io/user-guides/installing/docker/)
- [rAthena Wiki — Installations](https://github.com/rathena/rathena/wiki/installations)
- [FluxCP GitHub Repository](https://github.com/rathena/FluxCP)
- [phpMyAdmin Docker Image](https://hub.docker.com/r/phpmyadmin/phpmyadmin)
