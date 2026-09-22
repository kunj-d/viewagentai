# viewagentai

CodeIgniter 3.1.13 application behind **View Agent AI** — a multi-tenant SaaS where
each workspace gets its own subdomain (`<workspace>.viewagentai.com`).

## Requirements

| | |
|---|---|
| PHP | 7.2 – 7.4 (developed against 7.4; `system/` carries a PHP 8 session wrapper) |
| Extensions | `mysqli curl gd mbstring openssl zip fileinfo bcmath exif` |
| Database | MySQL 5.6+ / MariaDB 10.4+ |
| Web server | Apache with `mod_rewrite` and `AllowOverride All` |
| Optional | `ffmpeg` + `ffprobe` on `PATH` (audio/video features), `grpc` ext (Google Cloud TTS over gRPC) |

`composer install` is **not** part of setup. The top-level `vendor/` is committed
because `composer.json` only declares `php>=5.3.7` — its 123 packages are not
recorded anywhere and cannot be reinstalled.

Two dependency folders *are* excluded because they carry their own lockfile.
Restore them with:

```bash
cd chat                                            && composer install
cd application/libraries/autoresponder/aweber      && composer install
```

`ffmpeg`/`ffprobe` binaries are excluded too — download them from
<https://ffmpeg.org/download.html> for your platform.

## Setup

**1. Credentials.** Nothing real is committed. Create both files from their samples:

```bash
cp application/config/secrets.sample.php application/config/secrets.php
cp chat/secrets.sample.php               chat/secrets.php
```

`application/config/secrets.php` holds the database login plus every API key
(AWS, OpenAI, Google, HeyGen, Speechify, DupDub, Aweber, Stripe/PayPal IPN …).
`config.php` copies each key into the config array, so application code reads
them with `config_item('aws_access_key')`. `database.php` reads `db_username`,
`db_password` and `db_database` from the same file.

**2. Database.** Import a dump into the database named in `db_database`. The
schema is 144 tables; there is no migration set.

**3. Web server.** Three constraints drive the vhost:

- `config.php` sets `base_url` to `http(s)://HTTP_HOST/` with no sub-folder, so
  the app must answer at the **root** of the host.
- The same file sets `assetsPath` to `base_url . 'app/assets/'`, so `/app/…`
  must resolve too.
- Several controllers build filesystem paths as
  `$_SERVER['DOCUMENT_ROOT'] . "/app/assets/..."` (see `Images_loads_ajax.php`,
  which feeds the editor's shape/pattern/background galleries). Point the
  document root straight at the app folder and those resolve to `app/app/...`
  and silently return an empty gallery.

So the document root must be the **parent** of the app folder, exactly like
production (`public_html`, with the app in `public_html/app`):

```apache
<VirtualHost *:80>
    ServerName   www.viewagentai.local
    ServerAlias  *.viewagentai.local
    DocumentRoot "/path/to/parent"          # NOT /path/to/parent/app

    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/app/
    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_URI} !-f
    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_URI} !-d
    RewriteRule ^(.*)$ /app/index.php/$1 [L]

    <Directory "/path/to/parent">
        AllowOverride All
        Require all granted
    </Directory>

    # index.php line 62 reads $_GET['index_on'] without isset(), so PHP emits a
    # notice before CodeIgniter can disable display_errors. Any output that early
    # breaks every header()/redirect in the app.
    php_flag display_errors off
</VirtualHost>
```

**4. Hostnames.** Add the login host and one entry per workspace subdomain to
your `hosts` file, e.g. `www.viewagentai.local` and `acme.viewagentai.local`.
`AppDefault::checkAlreadyLogin()` compares the Host header against
`config_item('productSite')`, so that value must match the domain you serve from.

## Local config notes

`config.php` ships a few switches worth knowing:

- `islive` — `"on"` uploads to the live S3 bucket and deletes live objects.
  Set it to `"off"` on any non-production machine.
- `cookie_secure` — `TRUE` means the session cookie is HTTPS-only; login will
  loop over plain HTTP.
- `log_threshold` — `0` disables CodeIgniter logging entirely; `1` logs errors
  to `application/logs/`.

## Known rough edges

- `$route['404_override']` points at `Error/index`, but no `Error` controller
  exists — PHP's built-in `Error` class is matched instead, so 404s render blank.
- `Library.php` includes `libraries/google/vendor/autoload.php`, which is not in
  the tree; those code paths fatal.
- Six tables (`user_logs`, `languages`, `paypal_integration`, `plan_templates`,
  `product_sales`, `funnel_user_templates`) are missing `AUTO_INCREMENT` on their
  primary key in the production schema, so inserts fail after the first row.
