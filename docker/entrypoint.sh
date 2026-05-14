#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

# Garante existência das pastas necessárias e permissões corretas
mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache

# Gera APP_KEY se não houver
if [ -z "${APP_KEY:-}" ] && [ -f .env ]; then
    if ! grep -qE '^APP_KEY=base64:' .env; then
        php artisan key:generate --force --no-interaction || true
    fi
elif [ -z "${APP_KEY:-}" ]; then
    php artisan key:generate --force --no-interaction || true
fi

# Cria link simbólico do storage (idempotente)
php artisan storage:link --force >/dev/null 2>&1 || true

# Espera o banco ficar pronto (DB_HOST/DB_PORT)
if [ -n "${DB_HOST:-}" ] && [ -n "${DB_PORT:-}" ]; then
    echo "Aguardando banco em ${DB_HOST}:${DB_PORT}..."
    for i in $(seq 1 60); do
        if (echo > /dev/tcp/${DB_HOST}/${DB_PORT}) >/dev/null 2>&1; then
            echo "Banco respondendo."
            break
        fi
        sleep 1
    done
fi

# Migrations (opcional via env). Default: rodar.
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force --no-interaction || true
fi

# Caches de produção
php artisan config:cache  || true
php artisan route:cache   || true
php artisan view:cache    || true

exec "$@"
