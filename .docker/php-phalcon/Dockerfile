FROM php:7.3-cli

# Workaround for https://github.com/docker-library/php/pull/542
RUN rm -f /etc/apt/preferences.d/no-debian-php

# Install phalcon (mainline repository)
RUN apt-get update \
 && curl -s "https://packagecloud.io/install/repositories/phalcon/mainline/script.deb.sh" | bash \
 && apt-get install -y php7.3-phalcon

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www

