Создать сеть:

docker network create jurcorpus-traefik

При первом запуске:

php artisan migrate <!-- Создает базу -->

php artisan db:seed --class=AttachmentSeeder <!-- Создает empty картинки -->
php artisan db:seed <!-- Заполняет базу филиалами, сотрудниками и должностями -->