FROM php:8.2-fpm

# Install necessary extensions
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

COPY php-lab.ini /etc/php/8.2/fpm/conf.d/82-php-ini-lab.ini
COPY php-lab.ini /etc/php/8.2/cli/conf.d/82-php-ini-lab.ini
COPY php-fpm.conf /etc/php/8.2/fpm/php-fpm.conf

RUN echo 'cd /var/www/test'>>/root/.bashrc

#RUN echo "fix rights"
#RUN cd /var/www/jsnow
#RUN date
#RUN echo "chown -R :www-data ."
#RUN chown -R :www-data .
#RUN date
#RUN echo "chmod -R g+w ."
#RUN chmod -R g+w .
#RUN date
