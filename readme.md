# Introduction
## List packages adding more to basic laravel 5.2
 - barryvdh/laravel-ide-helper : using for generate helper for IDE coding (https://github.com/barryvdh/laravel-ide-helper)
 - laracasts/flash : using for Flash message (https://github.com/laracasts/flash)
 - intervention/image && intervention/imagecache : using for Image (http://image.intervention.io/getting_started/installation#laravel)
 - cviebrock/eloquent-sluggable : using for slug URL (https://github.com/cviebrock/eloquent-sluggable)
 - laravelcollective/html : using for HTML && Form (https://laravelcollective.com/docs/5.2/html)
 - https://github.com/Maatwebsite/Laravel-Excel 
 - Social Login Using Facebook And Google.
 
## Javascript Packages :
### ckeditor and kcfinder
  Using for editor and upload image in editor to `public/upload`
  
## Install 
 * `sh setup.sh` 
 * Configure Database Config in `.env` and run `php artisan migrate`.
 * Change `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET`
 * Using `php artisan add:admin --email=test@gmail.com` to add Admin google Authenticate.
 * Note : Admin Need Permission to access New Backend Controller, please add to `config/permission.php`
 * If you need Facebook Authenticate at Frontend, enable in `app/Http/routes.php` and config `Facebook App` at `.env`