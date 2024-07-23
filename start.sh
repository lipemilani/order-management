echo "...CRIANDO .ENV A PARTIR DO .ENV.EXAMPLE..."

if [ ! -f ".env" ]
  then
    cp .env.example .env
fi

composer install

php artisan serve --host=0.0.0.0 --port=8000
