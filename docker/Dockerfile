FROM php:8.3-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

#INI-Files
COPY ./opcache.ini "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini"
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get -y update && apt-get install -y libicu-dev libzip-dev zip libjpeg-dev libpng-dev libfreetype6-dev git libpq-dev
RUN docker-php-ext-install pdo_pgsql pgsql
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd '--with-jpeg' '--with-freetype'
RUN docker-php-ext-install intl opcache zip gd
RUN apt-get install -y libgmp-dev
RUN docker-php-ext-install gmp
#RUN pecl install xdebug
RUN a2enmod rewrite

#INSTALL APCU
RUN pecl install apcu-5.1.24 && docker-php-ext-enable apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/php.ini
RUN echo "apc.enable_cli=1" > /usr/local/etc/php/php.ini
RUN echo "apc.enable=1" > /usr/local/etc/php/php.ini
#APCU

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN a2enmod rewrite headers
