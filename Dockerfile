FROM php:8.3-fpm-bookworm

ENV TZ Asia/Tokyo
WORKDIR /app

RUN --mount=type=cache,target=/var/cache/apt,sharing=locked \
    apt-get update \
    # Laravel 開発に必要なツール・ライブラリをインストール
    && apt-get install -y --no-install-recommends \
        bash \
        git \
        libzip-dev \
        libssl-dev \
        libpq-dev \
        zip \
        unzip \
    && docker-php-ext-install \
        zip \
        opcache \
        pcntl \
        pdo \
        pdo_pgsql \
    #不要なパッケージリストを削除してイメージサイズを縮小
    && rm -rf /var/lib/apt/lists/*

# Composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ホストとの権限ズレを防ぐための設定
ARG UID=1000
ARG GID=1000

RUN \
    # www-data グループの GID をホストと合わせる
    groupmod -g $GID www-data && \
    # www-data ユーザーの UID/GID をホストと合わせる
    usermod -u $UID -g $GID -s /bin/bash www-data && \
    # Composer キャッシュ・vendor ディレクトリを事前に作成
    mkdir -p /tmp/composer/cache /app/vendor && \
    # それらを www-data 所有にする
    chown -R www-data:www-data /app /tmp/composer/cache

#root 実行を避け、権限事故を防ぐ
USER www-data

# 依存関係定義ファイルのみ先にコピー
COPY --chown=www-data:www-data src/composer.* ./

# Composer キャッシュを利用しつつ依存関係をインストール
RUN --mount=type=cache,target=/tmp/composer/cache,sharing=locked \
    composer install --no-interaction --no-progress --no-scripts

# Laravel のソースコードをコピー
COPY --chown=www-data:www-data src/ ./

EXPOSE 8002
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8002"]
