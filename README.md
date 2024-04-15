# banki-shop

Запуск проекта:
1. Скопировать ENV
```
cp .env.local .env
```
2. Создание сети для докера
```
docker network create  bs-network
```
3. Запуск докера
```
docker compose up -d
```
4. Накат миграции
```
docker compose run --rm bs-php-cli php ./yii.php migrate
```

Запуск проекта с помощью make:
```
make help
```

