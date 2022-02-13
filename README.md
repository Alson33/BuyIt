<h1 align="center">BuyIT</h1>

## Steps to do

- In command line `git clone https://github.com/Alson33/BuyIt.git`
- then `cd BuyIt`
- then `composer install`
- copy your `.env.example` file into `.env` file in root folder
- change the `APP_URL=http://localhost` to `APP_URL=http://localhost:8000`
- change the `DB_DATABASE=laravel` field with `DB_DATABASE=yourdatabaseName`
- create the database in your local server engine
- change the following with your mailtrap.io credentails for testing email
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
```
to
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=yourusername (from mailtrap)
MAIL_PASSWORD=yourpassword (from mailtrap)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yourEmailAddress
```
- now in your command line run `php artisan migrate`
- then `php artisan db:seed`
- finally `php artisan serve`
- Go to http://localhost:8000

## About BuyIT

BuyIT is a small laravel project for adding, updating and listing different products. Basically it is an inventory system for products like electronics, clothes, etc.

## Libraries Used

- [Spatie/laravel-medialibrary](https://spatie.be/docs/laravel-medialibrary/v9/introduction).
- [Spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction).
