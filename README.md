Laravel Socialite [Okta] (https://www.okta.com) provider 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tequilarapido/socialite-okta.svg?style=flat-square)](https://packagist.org/packages/tequilarapido/socialite-okta)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/76052550/shield)](https://styleci.io/repos/76052550)
[![Quality Score](https://img.shields.io/scrutinizer/g/tequilarapido/socialite-okta.svg?style=flat-square)](https://scrutinizer-ci.com/g/tequilarapido/socialite-okta)

<p align="center">
    <img src="docs/illustration.jpg" />
</p>


## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package using composer

``` bash
$ composer require tequilarapido/socialite-okta
```

## Usage

* Add service provider to `config.php`
``` php
Tequilarapido\Okta\OktaServiceProvider::class,
```

* If you already use Socialite in your app, remove the socialite service provider from `config/app.php`

* Add Socialite alias 
``` php
'Socialite' => Laravel\Socialite\Facades\Socialite::class,
```

* Add this entries to `config/services.php`

``` php
'okta' => [
    'url' => env('OKTA_URL'),
    'client_id' => env('OKTA_CLIENT_ID'),
    'client_secret' => env('OKTA_CLIENT_SECRET'),
    'redirect' => env('OKTA_REDIRECT'),
],
``` 
   
* Add config variables to your .env file 
```
# Okta
OKTA_URL=https://xxx.okta.com or https://xxx.oktapreview.com  
OKTA_REDIRECT=http://your-app-url/{callback-route-uri}
OKTA_CLIENT_ID=XXX
OKTA_CLIENT_SECRET=XXX
```   

* Use like any other Socialite driver 

[Laravel Socialite Documentation] (https://laravel.com/docs/5.0/authentication#social-authentication)

   
``` php

    // To get the auhtorization redirect
    return Socialite::with('okta')->redirect();
   
   
    // To get the okta user
    $oktaUser = Socialite::driver('okta')->user();
```   
   
## Security

If you discover any security related issues, please email nbourguig@gmail.com instead of using the issue tracker.

## Credits

- [Nassif Bourguig](https://github.com/nbourguig)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.






