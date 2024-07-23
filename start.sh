echo "...CRIANDO .ENV A PARTIR DO .ENV.EXAMPLE..."

if [ ! -f ".env" ]
  then
    cp .env.example .env
fi

if [ ! -f "storage/oauth-private.key" ]
  then
    docker compose exec php php artisan passport:keys
    docker compose exec php sh -c "printf '\n\n' | php artisan passport:client --password"
fi

echo "...FIX STORAGE AND VENDOR FOLDER PERMISSION..."

docker compose exec php chmod -R 777 storage

composer install

php artisan serve --host=0.0.0.0 --port=8000
