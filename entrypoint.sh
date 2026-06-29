#!/bin/sh
set -e

# Render injects $PORT at runtime. Default kept only for local `docker run` testing.
: "${PORT:=10000}"
export PORT

# Substitute ONLY $PORT — nginx's own $uri/$document_root/etc. must stay untouched.
envsubst '${PORT}' < /etc/nginx/http.d/default.conf.template > /etc/nginx/http.d/default.conf

# Safe to (re)run on every boot — these are derived/generated, never hand-edited.
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations are intentionally NOT run here.
# Run them as Render's "Pre-Deploy Command" instead (see DEPLOYMENT.md) so a failed
# migration blocks the deploy rather than crash-looping a container that's already live.

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf