dconsole() {
   docker exec -it php_api php bin/console $@
}

dcomposer() {
   docker exec -it php_api php composer.phar $@
}