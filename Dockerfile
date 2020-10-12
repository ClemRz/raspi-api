# pull official base image
FROM php:7.3-apache

# install some extentions
RUN a2enmod rewrite

# copy the sources
COPY src/ /var/www/html/

# port exposure
EXPOSE 80