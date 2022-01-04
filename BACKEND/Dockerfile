FROM php:7.3-fpm-alpine
RUN apk add --update --no-cache libgd libpng-dev libjpeg-turbo-dev freetype-dev
RUN docker-php-ext-install -j$(nproc) gd
ADD php.ini /usr/local/etc/php.ini
CMD php -S localhost:8000 -t public

#sudo docker build -t ems-micro-service
#sudo docker image ls
#sudo docker images
#sudo docker run ems-micro-service
