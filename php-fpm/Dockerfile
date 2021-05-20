FROM php:8.0.2-fpm-alpine3.13

ENV PHPIZE_DEPS \
     autoconf \
     cmake \
     file \
     g++ \
     gcc \
     libc-dev \
     pcre-dev \
     make \
     git \
     pkgconf \
     re2c \
     # for GD
     freetype-dev \
     libpng-dev  \
     libjpeg-turbo-dev \
     # for xslt
     libxslt-dev \
     # for intl extension
     icu-dev \
     libzip-dev \
     gmp-dev \
     openssl-dev \
     libssh-dev

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    && docker-php-source extract \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        intl \
        gd \
        opcache

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer

COPY volt.ini /usr/local/etc/php/conf.d/
#COPY volt.pool.conf /usr/local/etc/php/php-fpm.d/

WORKDIR /var/www

EXPOSE 9000
