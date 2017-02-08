# Laravel 5.4

## Laravel Installation and Composer

Laravel is a PHP framework - basic.

Laravel also requires composer.

| Commands | Description |
| ----------- | ----------- |
| `composer global require "laravel/installer"` | Global install command laravel |
| `laravel new blog` | Create a new blog |
| `composer create-project --prefer-dist laravel/laravel blog` | Create Blog with Composer Create-Project |
| `php artisan serve` | Serve the project locally |

If you are adding the `laravel` command globally, then ensure `$HOME/.composer/vendor/bin:$PATH` is in your path.

## Basic Routing and Views

There will be a whole bunch of files etc after generating a Laravel program.

Likely we can ignore the middleware once we're in the situation that requires it.

The `routes` is where you will find the routes.

This will do a standard `Routes::get('/', function () {})` for the `blade` template engine.

**Defining**

```php
Route::get('/welcome', function () {
	return view('welcome')
});
```

## Laravel Valet

In the `Dev Environments`, you can see `Homestead` and `Valet` - `Homestead` is a preconfigured Vagrant box which uses VMs.

`Valet` is specifically for the Mac. It is a Laravel Dev Environment. No need to set up or alter any files.

If you go `laravel new app` you could straight away hit up `app.dev`.

This requires PHP 7.1. You can install `Valet` with composer as a global requirement. Run `valet install`.

`brew services start mysql` will start `mysql` if it was installed via Brew and you're wishing to use.

`valet park` is used to park the root of the directory that you wish to use for finding projects.

`valet secure` will even secure the website.