FROM php:8.2-apache

# Installeer benodigde extensies en tools (zip, unzip, git)
RUN apt-get update && \
    apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zip \
    git \
    unzip && \
    docker-php-ext-install mysqli pdo_mysql gd && \
    rm -rf /var/lib/apt/lists/*

# Installeer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Zet werkmap
WORKDIR /var/www/html

# Kopieer bestanden naar container
COPY . /var/www/html/

# Stel de omgevingsvariabele in om Composer als root toe te staan
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installeer PHPMailer via Composer
RUN composer require phpmailer/phpmailer

# Schakel Apache's mod_rewrite in
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

CMD ["apache2-foreground"]
