# 🐳 Docker — AutoPrime

Imagem única (PHP-FPM + Nginx via supervisord) + MySQL 8 via `docker-compose`.

## Estrutura

```
Dockerfile
.dockerignore
docker-compose.yml
docker/
  entrypoint.sh
  supervisord.conf
  nginx/default.conf
  php/php.ini
  php/www.conf
```

## Build & Run

```bash
# 1) Defina variáveis no .env (na raiz, lido pelo docker-compose)
cp .env.example .env
# Edite ao menos: APP_KEY (deixe vazio na 1ª vez), ADMIN_PASSWORD, DB_PASSWORD

# 2) Subir tudo
docker compose up -d --build

# 3) Gerar APP_KEY (somente na primeira vez se não definida)
docker compose exec app php artisan key:generate --force

# 4) Rodar seeders (cria admin a partir de ADMIN_EMAIL/ADMIN_PASSWORD)
docker compose exec app php artisan db:seed --force
```

App ficará disponível em `http://localhost:8080`.

## Comandos úteis

```bash
docker compose logs -f app
docker compose exec app bash
docker compose exec app php artisan migrate:fresh --seed --force
docker compose exec app php artisan tinker
docker compose down            # mantém volumes
docker compose down -v         # apaga volumes (zera DB)
```

## Notas

- `APP_DEBUG=false` por padrão; **não** habilite em produção real.
- O entrypoint roda automaticamente: `migrate`, `config:cache`, `route:cache`, `view:cache` e `storage:link`.
- Para desabilitar migrations automáticas: `RUN_MIGRATIONS=false`.
- O volume `app-storage` persiste `storage/` (logs, sessions, uploads).
- A imagem expõe a porta `8080` internamente; mapeie via `APP_PORT`.
- Build multi-stage compila assets do Vite com Node 20, instala dependências PHP com Composer, e gera imagem final em `php:8.3-fpm-alpine`.
