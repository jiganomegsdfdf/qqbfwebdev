#!/bin/bash
set -ex
rm -rf /var/www/html
mkdir /var/www/html
cp -r /system/* /var/www/html

service nginx stop
rm -rf /etc/nginx/sites-enabled/default
rm -rf /etc/nginx/sites-available/default
mkdir /etc/nginx/sites-enabled/
mkdir /etc/nginx/sites-available/
cp /system/default /etc/nginx/sites-enabled/default
mv /system/default /etc/nginx/sites-available/default

rm -rf /etc/nginx/nginx.conf
mv /system/nginx.conf /etc/nginx/nginx.conf
mv /system/nginxconfig.io /etc/nginx

service php7.4-fpm start
#nginx
exec supervisord -c /system/supervisord.conf
