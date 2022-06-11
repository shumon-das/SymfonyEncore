FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip supervisor \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Configure supervisord
RUN mkdir -p /etc/supervisor/conf.d

COPY conf/supervisord.conf /etc/supervisor
COPY conf/supervisord-programs.conf /etc/supervisor/conf.d/app.conf

RUN mkdir -p /var/www/html/public/uploads
RUN chown -R www-data /var/www/html/public/uploads

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
RUN git config --global user.email "shumonsb@gmail.com" \
    && git config --global user.name "monoranjan"

#RUN apt-get update && apt-get install -y nodejs npm

#COPY . /var/www/html/
#RUN npm install

