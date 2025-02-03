FROM php:8.2-apache

# Update en installeer benodigde extensies
RUN apt-get update && \
    docker-php-ext-install mysqli pdo_mysql

# Schakel Apache's mod_rewrite in
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
