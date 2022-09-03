FROM httpd:2-alpine
RUN apk update;
RUN apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY apache.conf /usr/local/apache2/conf/project.conf

# Clean up
RUN rm -rf /usr/local/apache2/htdocs
RUN mkdir -p /var/www/html
RUN ln -s /var/www/html /usr/local/apache2/htdocs

RUN echo "Include conf/project.conf" >> /usr/local/apache2/conf/httpd.conf

# Configuration update
RUN sed -i \
#    -e 's/^ *Options Indexes FollowSymLinks/#\0/' \
    -e 's/^\( *DirectoryIndex \)index.html/\1app.php/' \
    /usr/local/apache2/conf/httpd.conf

# Turn on Apache extension
RUN sed -i \
    -e 's/^#\(LoadModule .*mod_deflate.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_proxy_fcgi.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_rewrite.so\)/\1/' \
    /usr/local/apache2/conf/httpd.conf

# SSL configuration
COPY server.crt conf/server.crt
COPY server.key conf/server.key
RUN sed -i \
    -e 's/^#\(Include .*httpd-ssl.conf\)/\1/' \
    -e 's/^#\(LoadModule .*mod_ssl.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_socache_shmcb.so\)/\1/' \
    /usr/local/apache2/conf/httpd.conf