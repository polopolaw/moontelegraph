### DEVELOPMENT
``` bash
composer install
npm install
npm run dev

php artisan migrate --seed
php artisan moonshine:user
php artisan storage:link
```

### CODE STYLE
``` bash
./vendor/bin/pint
```

### PRODUCTION
``` bash
npm run build
php artisan optimize
```
