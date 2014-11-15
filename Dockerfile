##
## Dockerfile per ambiente AWS ElasticBeanstalk di PRODUZIONE
## 
## Altre immagini Docker di sviluppo possono essere trovate a 
##  https://github.com/AlfioEmanueleFresta/gaia-docker/
##

FROM alfioemanuele/gaia-req:v2

# Sposto Gaia su /var/www
RUN rm -rf /var/www/*
ADD . /var/www

# Spengo e configuro apache
RUN service apache2 stop
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www
ADD core/conf/apache2/apache.conf /etc/apache2/sites-available/default
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

# Configuro Gaia
RUN cd /var/www && sh scripts/aws.sh

# Esponi servizio HTTP
EXPOSE 80

# Avvia Apache
CMD ["/usr/sbin/apache2", "-D",  "FOREGROUND"]
