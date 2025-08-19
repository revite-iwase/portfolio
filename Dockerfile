# --- Stage 1: Node.js を取得（公式） ---
FROM node:22-bookworm AS node

# --- Stage 2: PHP 8.4 + Apache 本体 ---
FROM php:8.4-apache

ENV TZ=Asia/Tokyo

# ビルドに必要なパッケージ
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zlib1g-dev libssl-dev pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Apache: vhost（Laravelのpublic配下を公開したい場合は下2行を有効化）
RUN a2enmod rewrite
COPY apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# GD（JPEG対応）
RUN docker-php-ext-configure gd --with-jpeg

# Laravel でよく使う拡張
RUN docker-php-ext-install -j"$(nproc)" \
    bcmath intl gd zip pdo_mysql exif pcntl opcache mbstring xml

# Redis（PECL）
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- Node / npm / npx を組み込み ---
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -sf /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
 && ln -sf /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

# --- グローバルに yarn / pnpm を導入（corepack は使わない）---
RUN npm i -g yarn pnpm

# 作業ディレクトリと権限
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# PHP の軽微調整
RUN { \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    echo "zend.assertions=-1"; \
  } > /usr/local/etc/php/conf.d/custom.ini

EXPOSE 80
