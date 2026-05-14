# syntax=docker/dockerfile:1.7

# ---------- Stage 1: build assets (Node + Vite) ----------
FROM node:20-alpine AS assets

WORKDIR /app

# Instala dependências JS
# Usa `npm ci` quando há package-lock.json; cai para `npm install` caso contrário.
COPY package*.json ./
RUN if [ -f package-lock.json ]; then npm ci --no-audit --no-fund; \
    else npm install --no-audit --no-fund; fi

# Copia somente o necessário para o build do Vite
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build


# ---------- Stage 2: instalar dependências PHP ----------
# Usa PHP 8.3 para casar com a imagem final e com o composer.lock atual.
# Composer é copiado da imagem oficial em vez de baixado.
FROM php:8.3-cli-alpine AS vendor

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache git unzip libzip-dev icu-dev oniguruma-dev $PHPIZE_DEPS \
    && docker-php-ext-install intl zip bcmath \
    && apk del $PHPIZE_DEPS

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader


# ---------- Stage 3: imagem final (PHP-FPM + Nginx via supervisord) ----------
FROM php:8.3-fpm-alpine AS app

# Pacotes do sistema + extensões PHP necessárias para Laravel + MySQL
RUN apk add --no-cache \
        nginx \
        supervisor \
        bash \
        git \
        curl \
        icu-dev \
        oniguruma-dev \
        libzip-dev \
        zip \
        unzip \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        intl \
        bcmath \
        zip \
        gd \
        opcache \
        exif \
        pcntl \
    && apk del $PHPIZE_DEPS \
    && rm -rf /var/cache/apk/*

# Configurações de PHP de produção
COPY docker/php/php.ini    /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/php/www.conf   /usr/local/etc/php-fpm.d/zz-www.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf   /etc/supervisord.conf
COPY docker/entrypoint.sh      /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

# Copia o código da aplicação
COPY . .

# Copia vendor e assets compilados
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Permissões para o Laravel
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
