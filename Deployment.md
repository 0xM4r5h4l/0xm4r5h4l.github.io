# Deploying to Render.com

This assumes the `Dockerfile` and `docker/` folder from this delivery sit at your Laravel repo root.

## 1. Push to GitHub

Make sure `.env` is **not** committed (it's already in `.dockerignore`, but double-check `.gitignore` too — secrets baked into an image layer are hard to fully remove later).

## 2. Create the Web Service

Render Dashboard → **New** → **Web Service** → connect your repo.

- **Runtime:** Docker (Render auto-detects the `Dockerfile` at repo root)
- **Region:** pick the one closest to your target users (e.g. Frankfurt for EU clients, Oregon for US)
- **Instance type:** Free tier is fine to confirm it boots; move to at least **Starter** for anything real — php-fpm + nginx + opcache need more than the free tier's RAM ceiling to stay stable under load

## 3. Environment Variables

Set these in the Render dashboard (never in the Dockerfile):

```
APP_NAME=YourApp
APP_ENV=production
APP_KEY=                  # generate locally: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

LOG_CHANNEL=stderr         # Render captures stdout/stderr as logs — file logs are lost on restart since disk is ephemeral

DB_CONNECTION=mysql
DB_HOST=your-managed-db-host
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password

CACHE_STORE=redis
SESSION_DRIVER=redis        # do NOT use file/database sessions — see ephemeral disk note below
QUEUE_CONNECTION=redis
REDIS_HOST=your-redis-host
REDIS_PORT=6379
REDIS_PASSWORD=your_redis_password
```

> Render doesn't offer managed MySQL directly — use PlanetScale, AWS RDS, or DigitalOcean Managed MySQL. For Redis, Render's own managed Redis or Upstash both work fine.

## 4. Pre-Deploy Command

In the service settings, set:

```
php artisan migrate --force
```

This runs **before** the new container takes traffic. Deliberately not baked into `entrypoint.sh` — a bad migration should block the deploy, not crash-loop a container that's already serving requests.

## 5. Health Check Path

Set to `/up` (Laravel 11+ ships this route by default — confirm it exists in `routes/web.php`; add `Route::get('/up', fn () => response()->noContent());` if it doesn't).

## 6. Build & Start

Nothing to set here — Docker runtime builds the image from your `Dockerfile` and runs `entrypoint.sh` automatically. No separate "Build Command" or "Start Command" needed.

## 7. ⚠️ Important: your multi-tenant filesystem isolation will NOT survive on Render as-is

Your architecture uses **dynamic filesystem isolation per tenant**. Render's containers have an **ephemeral disk** — anything written locally disappears on every restart/redeploy, and isn't shared if you ever scale to multiple instances.

Fix: point tenant file storage at an S3-compatible bucket (AWS S3, Cloudflare R2, or DigitalOcean Spaces) using Laravel's `s3` filesystem driver, and reserve local disk only for genuinely disposable cache/temp data. Do this **before** you have real tenant data in production — migrating uploaded files after the fact is a much bigger job than configuring this on day one.

## 8. First Boot Checklist

- [ ] Visit the app — confirm `public/build/*` assets load (check Network tab for 404s on CSS/JS)
- [ ] Confirm `/up` returns 200
- [ ] Tail logs in Render dashboard — `config:cache` / `route:cache` / `view:cache` should run with no errors on every boot (see `entrypoint.sh`)
- [ ] Confirm Redis-backed sessions persist a login across a manual redeploy
- [ ] Enable **Auto-Deploy** on push to `main` once the above all check out