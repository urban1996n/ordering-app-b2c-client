dcomposer() {
   docker exec -it order_api php composer.phar $@
}

dconsole() {
   docker exec -it order_api php bin/console $@
}

newdb() {
   docker exec -it order_api php bin/console d:s:c 
}

fixturesload() {
    docker exec -it order_api php bin/console doctrine:fixtures:load
}  
