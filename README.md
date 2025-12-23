# Pixelis

[![CI](https://github.com/Evalutik/pixelis/actions/workflows/php.yml/badge.svg)](https://github.com/Evalutik/pixelis/actions/workflows/php.yml)
[![Security Scan](https://github.com/Evalutik/pixelis/actions/workflows/security.yml/badge.svg)](https://github.com/Evalutik/pixelis/actions/workflows/security.yml)
[![Codecov](https://codecov.io/gh/Evalutik/pixelis/branch/main/graph/badge.svg)](https://codecov.io/gh/Evalutik/pixelis)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Pixelis is a small PHP app that lets users buy single pixels on a shared 1000×1000 canvas. Each pixel can be reserved, purchased and associated with a link and short message — useful as a tiny ad or a visual message board.

Why this repo is useful
- Lightweight, easy to run locally (Docker or native PHP)
- Tests and CI to exercise core functionality
- Small, focused codebase useful for demos or interviews

Quick links
- API spec: [openapi.yaml](openapi.yaml)
- API endpoint: [api/pixel.php](api/pixel.php)

Prerequisites
- PHP 8 (recommended) or PHP 7.4+
- MySQL
- Docker & Docker Compose (recommended for local development)

Quickstart (Docker - recommended)
1. Clone the repository and enter it:

  git clone <repo-url>
  cd <repo>

2. Start services:

  docker-compose up -d --build

3. Initialize the database (creates schema and optional seed user):

  docker-compose exec php php src/setup_db.php --seed=dev:dev

4. Open http://localhost:8080 in your browser.

Local (OSPanel / native PHP)
- Place the repo under your webroot (for example d:\\OSPanel\\domains\\localhost)
- Create a database `main` and update DB credentials via environment variables or a local `.env` file
- Run `php src/setup_db.php` to create schema and optionally seed a user

Running tests
- Install PHP dependencies: `composer install`
- Run unit tests locally: `vendor/bin/phpunit`
- Integration tests exercise the HTTP endpoints and are intended to run in Docker (CI runs them automatically)

Security notes
- Do not commit `.env` or credentials. Use `.env.example` as a template.
- Most DB queries use prepared statements; review any remaining interpolation and convert to prepared queries.
- Sanitize output with `htmlspecialchars()` (or use a templating engine) to prevent XSS.

Developer tips
- Use `make test` to run the full test suite (if Makefile is available/installed tools).
- Use `docker-compose exec php bash` to run commands inside the PHP container for debugging.

Recommended next cleanup steps
- Add and commit `.gitignore` (exclude `pixelsDB/`, `bronpix/`, runtime files)
- Provide a `.env.example` and update `src/connect.php` to prefer environment variables
- Replace any remaining string-interpolated SQL with prepared statements

License
- MIT — see `LICENSE`

If you want, I can:
- Add a short demo GIF or screenshot
- Create `.env.example` and `.gitignore` and commit them
- Run the test suite and push the README change for you

--
Generated/edited by a repo maintainer assistant to make the README concise and actionable.