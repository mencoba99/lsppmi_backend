FROM ticmiicamel/php7.2-nginx-debian:latest
LABEL Maintainer="Akmal Bashan <akmal.squal@gmail.com>" \
      Description="LSPPMI Backend Application"

RUN apt-get update && apt-get install -y fuse openrc vim-tiny \
&& mkdir /var/run/php

ADD docker/nginx/ /etc/nginx/
ADD docker/supervisor/conf.d/lsppmi-backend.conf /etc/supervisor/conf.d/lsppmi-backend.conf
ADD storage/app/gcp-key.json /var/www/storage/app/lsppmi-storage.json
#ADD docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

ADD . /var/www/
WORKDIR /var/www

RUN touch storage/logs/laravel.log \
&& mkdir -p bootstrap/cache \
&& chmod -R 777 /var/www/storage \
&& chmod -R 777 bootstrap/cache 
#&& rm -rf /etc/nginx/sites-available/default \
#&& ln -sf /dev/stderr /var/log/nginx/error.log \
#&& ln -sf /dev/stdout /var/log/nginx/access.log \
#&& ln -sf /dev/stdout /var/www/storage/logs/laravel.log \
#&& ln -sf /dev/stderr /var/www/storage/logs/laravel.log \
#&& ln -sf /dev/stdout /var/www/storage/logs/laravel.log
 
RUN composer install

