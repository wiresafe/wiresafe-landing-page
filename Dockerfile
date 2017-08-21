FROM php:7.0-apache
COPY php/ /var/www/html/
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
