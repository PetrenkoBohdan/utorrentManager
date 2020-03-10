FROM webdevops/php-nginx:7.4

ADD ./default.conf /opt/docker/etc/nginx/vhost.common.d/utorrent.conf
ADD ./location-root.conf /opt/docker/etc/nginx/vhost.common.d/10-location-root.conf
ADD ./auth /etc/nginx/.auth

WORKDIR /app
