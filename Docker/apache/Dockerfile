FROM httpd:2-alpine

RUN apk update;
RUN apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY apache.conf conf/project.conf

# Clean up
RUN rm -rf /usr/local/apache2/htdocs/*
RUN mkdir -p /var/www/html/public
RUN ln -s /var/www/html/public /usr/local/apache2/htdocs

RUN echo "Include conf/project.conf" >> conf/httpd.conf

# Turn on Apache extension
RUN sed -i \
    -e 's/^#\(LoadModule .*mod_deflate.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy_fcgi.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_rewrite.so\)/\1/' \
    conf/httpd.conf

s# SSL configuration
COPY apache_app.crt conf/server.crt
COPY apache_app.key conf/server.key
RUN sed -i \
    -e 's/^#\(Include .*httpd-ssl.conf\)/\1/' \
    -e 's/^#\(LoadModule .*mod_ssl.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_socache_shmcb.so\)/\1/' \
    conf/httpd.conf

WORKDIR /var/www/html

RUN yarn install