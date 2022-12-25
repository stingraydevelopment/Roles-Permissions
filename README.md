# Roles and Permissions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stingraydevelopment/roles-and-permissions.svg?style=flat-square)](https://packagist.org/packages/stingraydevelopment/roles-and-permissions)
[![Total Downloads](https://img.shields.io/packagist/dt/stingraydevelopment/roles-and-permissions.svg?style=flat-square)](https://packagist.org/packages/stingraydevelopment/roles-and-permissions)
![GitHub Actions](https://github.com/stingraydevelopment/roles-and-permissions/actions/workflows/main.yml/badge.svg)

This Roles & Permissions by StingrayDevelopment helps add roles & permissions capabilities along with the relationship between each other and the users.

## Installation

You can install the package via composer:

```bash
composer require stingraydevelopment/roles-and-permissions
```

### Publish
Publish the package in your Laravel app using the following command.
```php
php artisan vendor:publish
```
You will see something similiar to the following

```php
Which provider or tags files would you like to publish?
  Publish files from all providers and tags listed below ......................................................................................... 0
  Provider: Illuminate\Foundation\Providers\FoundationServiceProvider ............................................................................ 1
  Provider: Illuminate\Mail\MailServiceProvider .................................................................................................. 2
  Provider: Illuminate\Notifications\NotificationServiceProvider ................................................................................. 3
  Provider: Illuminate\Pagination\PaginationServiceProvider ...................................................................................... 4  
  Provider: Laravel\Sail\SailServiceProvider ..................................................................................................... 5
  Provider: Laravel\Sanctum\SanctumServiceProvider ............................................................................................... 6
  Provider: Laravel\Tinker\TinkerServiceProvider ................................................................................................. 7
  Provider: Stingraydevelopment\RolesAndPermissions\RolesAndPermissionsServiceProvider ........................................................... 8
```
Type the number next to Stingraydevelopment\RolesAndPermissions\RolesAndPermissionsServiceProvider and click Enter. This will copy all of the necessary files you need in order use and manage Roles & Permissions easily within your Laravel app. 

### Integrate

There are some additional steps needed to use Roles & Permissions. Please follow the next few steps carefully.

#### User Class

Roles & Permissions was built with a default Laravel installation we assume that the initial user model location remains the same. "App/Models/User.php"

Open your User.php and add the following functions.
```php
    /**
     * Roles relationship.
     * Roles imported using the StingrayDevelopment\RolesAndPermissions package.
     * 
     * @return Collection   Collection of Role objects.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Permissions relationship.
     * Permissions imported using the StingrayDevelopment\RolesAndPermissions package.
     * 
     * @return Collection   Collection of Permission objects.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
```

### Vue

## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dan@stingraydev.com instead of using the issue tracker.

## Credits

-   [Dan Castanera](https://github.com/stingraydevelopment)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


