FROM php:8-apache

# Copy static HTML pages (when building a new image)
COPY src /var/www/html

# COPY docker_run.sh /docker_run.sh
# CMD sh /docker_run.sh
# CMD ["nginx", "-g", "daemon off;"]

# FOR NGINX
# docker run -it -p 8000:80 -v $PWD/html:/usr/share/nginx/html 2dukes/lbaw2135

# FOR PHP (NOW)
# docker build -t 2dukes/lbaw2135 .
# docker run -p 80:80 -it --rm --name lbaw -v $PWD/src:/var/www/html lbaw2135

# docker build -t lbaw2135/lbaw2135-piu .
# docker push lbaw2135/lbaw2135-piu