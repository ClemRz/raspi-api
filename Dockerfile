ARG ARCH

# pull official base image
FROM ${ARCH}httpd:alpine

# Activate rewrite module
RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

# Copy apache vhost file to proxy php requests to php-fpm container
COPY apache.conf /usr/local/apache2/conf/raspi.apache.conf

# Add the inclusion to the main conf
RUN echo "Include /usr/local/apache2/conf/raspi.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf