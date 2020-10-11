ARG ARCH

# pull official base image
FROM ${ARCH}php:7.3-apache

# update aptitude
RUN apt-get update

# install git
RUN apt-get install -y git

# install some extentions
RUN a2enmod rewrite

# copy the sources
COPY src/ /var/www/html/

# port exposure
EXPOSE 80