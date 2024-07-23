echo "...CRIANDO .ENV A PARTIR DO .ENV.EXAMPLE..."

if [ ! -f ".env" ]
  then
    cp .env.example .env
fi

chmod -R 777 storage

if [ ! -f "storage/oauth-private.key" ]
  then
    php artisan passport:keys
    sh -c "printf '\n\n\n' | php artisan passport:client --password"
fi

echo "...FIX STORAGE AND VENDOR FOLDER PERMISSION..."

composer install

php artisan serve --host=0.0.0.0 --port=8000

