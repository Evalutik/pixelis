<!-- markdownlint-disable MD013 MD033 -->
# Pixelis

[![CI](https://github.com/Evalutik/pixelis/actions/workflows/php.yml/badge.svg)](https://github.com/Evalutik/pixelis/actions/workflows/php.yml)
[![Security Scan](https://github.com/Evalutik/pixelis/actions/workflows/security.yml/badge.svg)](https://github.com/Evalutik/pixelis/actions/workflows/security.yml)
[![Codecov](https://codecov.io/gh/Evalutik/pixelis/branch/main/graph/badge.svg)](https://codecov.io/gh/Evalutik/pixelis)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

> Small PHP app for buying single pixels on a shared 1000×1000 canvas. Each pixel can be reserved, purchased and associated with a link and a short message.

Table of contents
-----------------
- [Quick links](#quick-links)
- [Prerequisites](#prerequisites)
- [Quickstart (Docker)](#quickstart-docker)
- [Local (OSPanel / native PHP)](#local-ospanel--native-php)
- [Running tests](#running-tests)
- [Security notes](#security-notes)
- [Developer tips](#developer-tips)
- [Recommended next steps](#recommended-next-steps)

Quick links
-----------
- API spec: [openapi.yaml](openapi.yaml)
- API endpoint: [api/pixel.php](api/pixel.php)

Prerequisites
-------------
- PHP 8 (recommended) or PHP 7.4+
- MySQL
- Docker & Docker Compose (recommended for local development)

Quickstart (Docker)
-------------------
1. Clone the repository and enter it:

```bash
git clone <repo-url>
cd <repo>
```

2. Start services:

```bash
docker-compose up -d --build
```

3. Initialize the database (creates schema and optional seed user):

```bash
docker-compose exec php php src/setup_db.php --seed=dev:dev
```

4. Open http://localhost:8080 in your browser.

Local (OSPanel / native PHP)
---------------------------
- Place the repo under your webroot (for example `d:\OSPanel\domains\localhost`).
- Create a database `main` and update DB credentials via environment variables or a local `.env` file.
- Run the DB setup script:

```bash
php src/setup_db.php
# optional: php src/setup_db.php --seed=testuser:testpass
```

Running tests
-------------
- Install PHP dependencies:

```bash
composer install
```

- Run unit tests locally:

```bash
vendor/bin/phpunit
```

- Integration tests exercise the HTTP endpoints and are intended to run in Docker (CI runs them automatically).

Security notes
--------------
- Do **not** commit `.env` or credentials. Use `.env.example` as a template.
- Most DB queries use prepared statements; review any remaining interpolation and convert to prepared queries.
- Sanitize output with `htmlspecialchars()` (or use a templating engine) to prevent XSS.

Developer tips
--------------
- Use `make test` to run the full suite (if your environment has the required tools).
- Use `docker-compose exec php bash` to run commands inside the PHP container for debugging.

Recommended next steps
----------------------
- Add and commit a `.gitignore` that excludes `pixelsDB/`, `bronpix/`, runtime files and other generated data.
- Add a `.env.example` and prefer environment variables in `src/connect.php`.
- Replace any remaining string-interpolated SQL with prepared statements.

License
-------
MIT — see `LICENSE`

Contributing / help
-------------------
If you'd like, I can:

- Add a short demo GIF or screenshot to the README.
- Create `.env.example` and `.gitignore`, commit them.
- Run the test suite inside Docker and report results.

---
_README reformatted for clarity and better developer experience._

<!-- markdownlint-enable MD013 MD033 -->
--
Generated/edited by a repo maintainer assistant to make the README concise and actionable.