FROM wyveo/nginx-php-fpm:php81

EXPOSE 80

COPY src/ /usr/share/nginx/html