Project: Pixel Board (local)

Short description
-----------------
This is a small PHP-based pixel board application (mobile/pc variants included). It uses MySQL and flat-file storage (pixelsDB/, bronpix/) for pixel reservations and purchases.

Prerequisites
-------------
- Windows (tested with OSPanel)
- OSPanel / Open Server or any local PHP+MySQL server
- PHP 7.4+ (recommend PHP 8)
- MySQL

Quick setup
-----------
1. Place the repo in your webserver folder (e.g., d:\OSPanel\domains\localhost).
2. Start Apache (or Nginx) and MySQL in OSPanel.
3. Create a database `main` and a `user` table. Example SQL:

   CREATE DATABASE main CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE main;
   CREATE TABLE `user` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `nick` VARCHAR(50) NOT NULL UNIQUE,
     `password` VARCHAR(255) NOT NULL,
     `aboutme` TEXT
   );

4. Update DB credentials (recommended: use an environment file, see Security below). The code currently connects at `vendor/connect.php`.
5. Open http://localhost/ in your browser.

Security & polishing notes (before publishing)
----------------------------------------------
- Do not commit credentials. Move DB credentials to a `.env` file and use `vlucas/phpdotenv` or environment variables. (I added a `.env.example` and `vendor/connect.php` now reads env vars if present.)
- Several SQL queries currently use string interpolation and were vulnerable to SQL injection. They should be converted to prepared statements (I updated `vendor/authorization.php`, `vendor/registration.php`, `vendor/isnickwrong.php` to use prepared statements).
- Add CSRF tokens for POST forms (sign-up/sign-in/checkout). I added a small helper `vendor/csrf.php` with `csrf_token()`, `csrf_input()` and `csrf_validate()`; include it in form pages and validate in handlers.
- Sanitize all output with `htmlspecialchars()` (or use a templating engine) to avoid XSS when rendering user-supplied data.
- Add `.gitignore` to avoid committing generated files (pixelsDB/, bronpix/, logs) and large image files in `photo/` (I added a `.gitignore` and `.gitattributes`).

What I can do next
------------------
- Add `.gitignore` and `.gitattributes` to ignore generated data and large files.
- Add `.env.example` and modify `vendor/connect.php` to use env vars.
- Replace vulnerable queries with prepared statements.

Local convenience (safe)
-------------------------
I've created a local `.env` file (ignored by git) with default local DB credentials so the app runs "as is" on your machine without entering DB creds. That file will NOT be pushed to GitHub.

Quick setup script
------------------
Run `php vendor/setup_db.php` to create the `main` database and `user` table automatically. To create a seed user for quick testing run:

  php vendor/setup_db.php --seed=testuser:testpass

Repository cleanup notes
------------------------
- If you previously committed credentials or large files, consider removing them from git history using tools like `git filter-repo` or the BFG Repo Cleaner (https://rtyley.github.io/bfg-repo-cleaner/).
- Make sure `.gitignore` is committed before adding generated folders like `pixelsDB/` and `bronpix/`, to avoid pushing runtime data.
- If you want, I can help produce a cleanup plan or perform an interactive review of the repository history for secrets.

Contact
-------
If you'd like, I can implement the above changes and create a minimal GitHub-ready structure (README, LICENSE, .gitignore, .env.example, CI file).