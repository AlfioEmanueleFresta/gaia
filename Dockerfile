FROM ubuntu:12.04

# Installazione delle dipendenze
RUN sh scripts/installa-dipendenze.sh

# Sposto Gaia su /var/www
RUN rm -rf /var/www/*
ADD . /var/www

# Configuro apache
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www
ADD core/conf/apache.conf /etc/apache2/sites-available/default
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# Esponi servizio HTTP
EXPOSE 80

# Avvia Apache
CMD ["/usr/sbin/apache2", "-D",  "FOREGROUND"]
