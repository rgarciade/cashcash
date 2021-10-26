## nueva implementación

instalar php y npm

sail up
sail npm install "primer lanzamiento"
sail artisan passport:install "crea el token, primer lanzamiento"

##activar debbug
cambiar la variable APP_DEBUG a true en .env y lanzar sail build

sail npm run watch

lanzar serve php artisan serve --host=localhost --port=8000

---

docker

-   cd docker-compose

1º montar docker

docker-compose --env-file ../.env build app

2ºlanzar el entorno en segundo plano

docker-compose --env-file ../.env up -d

3º docker composer

docker-compose exec app composer install

3º npm install

docker-compose exec app npm install

4º llenar db

docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

docker lanzar en server

-js
docker-compose exec app npm run development -- --watch
docker-compose exec app npm npm run development
