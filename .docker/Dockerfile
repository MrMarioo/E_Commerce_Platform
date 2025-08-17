FROM php:8.4-apache

RUN apt update
RUN apt install -y cron vim curl zip git default-mysql-client nano gpg gnupg2

RUN curl -s https://packages.stripe.dev/api/security/keypair/stripe-cli-gpg/public | gpg --dearmor | tee /usr/share/keyrings/stripe.gpg
RUN echo "deb [signed-by=/usr/share/keyrings/stripe.gpg] https://packages.stripe.dev/stripe-cli-debian-local stable main" | tee -a /etc/apt/sources.list.d/stripe.list

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        graphviz \
        optipng \
        imagemagick \
        iputils-ping \
        pdftk \
        poppler-utils \
        stripe

RUN apt-get install -y \
    libmagickwand-dev --no-install-recommends

RUN apt install -y sqlite3
# supervisor
ADD ./.docker/supervisor/conf.d/laravel-worker.conf /etc/supervisor/conf.d/
RUN apt install -y supervisor

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install bcmath mbstring pdo_mysql gd zip mysqli soap intl


RUN pecl install imagick
RUN docker-php-ext-enable imagick
#RUN sed -i '/disable ghostscript format types/,+6d' /etc/ImageMagick-6/policy.xml

RUN docker-php-ext-install exif
RUN docker-php-ext-enable exif

# composer
ARG INSTALL_COMPOSER=false
RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
;fi

# configure PHP
RUN sed -i -e "s/;\?max_input_vars = .*/max_input_vars = 5000/g"  /usr/local/etc/php/php.ini-production
RUN sed -i -e "s/post_max_size = 8M/post_max_size = 800M/g" /usr/local/etc/php/php.ini-production
RUN sed -i -e "s/upload_max_filesize = 2M/upload_max_filesize = 2000M/g" /usr/local/etc/php/php.ini-production
RUN sed -i -e "s/max_file_uploads = 20/max_file_uploads = 2000/g" /usr/local/etc/php/php.ini-production

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# NODE
ARG INSTALL_NODE=false
RUN if [ ${INSTALL_NODE} = true ]; then \
    apt install -y ca-certificates gnupg \
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_21.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list \
    && apt -y update \
    && apt -y install nodejs \
;fi

RUN apt -y install locales-all

#apache
RUN a2enmod rewrite
RUN a2enmod headers

RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN rm -r /var/www/html

RUN docker-php-ext-install opcache
COPY .docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www

ARG USERNAME=root
ARG UID=0
ARG GROUP=root
ARG ROOTPASS=l3tm31n

RUN usermod --password $(echo ${ROOTPASS} | openssl passwd -1 -stdin) root

RUN if [ ${USERNAME} != "root" ]; then \
    useradd -ms /bin/bash ${USERNAME} -u ${UID} \
;fi

USER ${USERNAME}:${GROUP}

RUN (crontab -l 2>/dev/null; echo "* * * * * su -l www-data -s /bin/bash -c 'cd /var/www/ && /usr/local/bin/php artisan schedule:run >> /var/www/storage/logs/cron-log 2>&1'") | crontab -
