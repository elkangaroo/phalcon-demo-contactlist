FROM php:7.3-cli

# Install needed dependencies
RUN pecl install -f psr-0.7.0 \
 && docker-php-ext-enable psr

# Compile phalcon from source...
RUN mkdir -p /tmp/zephir-parser \
 && curl -sSL "https://github.com/phalcon/php-zephir-parser/archive/v1.3.2.tar.gz" | tar xz -C /tmp/zephir-parser --strip-components=1 \
 && docker-php-ext-configure /tmp/zephir-parser \
 && docker-php-ext-install /tmp/zephir-parser \
 && rm -r /tmp/zephir-parser \
 && curl -sSL "https://github.com/phalcon/zephir/releases/download/0.12.10/zephir.phar" -o /tmp/zephir.phar \
 && mkdir -p /tmp/phalcon \
 && curl -sSL "https://github.com/phalcon/cphalcon/archive/v4.0.0-rc.1.tar.gz" | tar xz -C /tmp/phalcon --strip-components=1 \
 && ( \
    cd /tmp/phalcon \
    && php /tmp/zephir.phar fullclean \
    && php /tmp/zephir.phar compile \
    && docker-php-ext-configure /tmp/phalcon/ext \
    && docker-php-ext-install /tmp/phalcon/ext \
    ) \
 && rm -r /tmp/phalcon \
 && docker-php-ext-enable phalcon

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www

