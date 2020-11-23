Order delivery estimates
========================

To run the stack:
```
docker-compose up -d
```

If its the first time you run it please initialize the db:
```
docker-compoer exec php ./bin/console doctrine:schema:create
```

To connect to the webclient open in your browser:

> https://localhost/


To run the tests:
```
docker-compoer exec php ./bin/phpunit
```
