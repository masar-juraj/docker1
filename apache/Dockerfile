FROM php:7.4.33-apache-bullseye
RUN docker-php-ext-install mysqli
RUN ln -s /etc/apache2/mods-available/ssl.conf /etc/apache2/mods-enabled/ssl.conf && \
    ln -s /etc/apache2/mods-available/ssl.load /etc/apache2/mods-enabled/ssl.load && \
    ln -s /etc/apache2/mods-available/socache_shmcb.load /etc/apache2/mods-enabled/socache_shmcb.load && \
    ln -s /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
COPY ./index.php /var/www/html/
