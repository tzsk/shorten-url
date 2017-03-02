# Shorten Url

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


Package for Shortening URL and Expanding URL with Google.
This  is a great combination if you plan to send Links in 
your Text Messages fired from your Application.


## Install

Via Composer

``` bash
$ composer require tzsk/shorten-url
```


## Configure

First add the Service Provider and Facade in your app config file.

``` php
'providers' => [
    ...
    Tzsk\ShortenUrl\Provider\ShortenUrlServiceProvider::class,
    ...
]
...
'aliases' => [
    ...
    'GoogleUrl' => Tzsk\ShortenUrl\Facade\GoogleUrl::class,
    ...
]
```

After that run `vendor:publish` with flag `config`:

```bash
$ php artisan vendor:publish --tag=config
```

Once you do that you will have a new file in your config folder. 
`config/url.php`

There is only one criteria. Google API key for Shortening URL.
Just login with google account and go to [https://console.developers.google.com]

Now create a new Application there. And `Enable API` for URL Shortening. 
And generate `API Key` to use in `Credentials` section. 


## Usage

``` php
# Use Class Path at the top of the File.
use Tzsk\ShortenUrl\Facade\GoogleUrl;

# Inside your Controller Method for Shortening.

$short = GoogleUrl::shorten("LONG URL"); # Returns String.
# OR...
$short_data = GoogleUrl::extended()->shorten("LONG URL");
/**
* For extended it will give the full response that google provides.
*/


# Inside your Controller Method for Expanding.
$long = GoogleUrl::expand("SHORT URL"); # Returns String.
# OR...
$long_data = GoogleUrl::extended()->expand("SHORT URL");
/**
* For extended it will give the full response that google provides.
*/
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mailtokmahmed@gmail.com instead of using the issue tracker.

## Credits

- [Kazi Mainuddin Ahmed][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/tzsk/shorten-url.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/tzsk/shorten-url/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/tzsk/shorten-url.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/tzsk/shorten-url.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tzsk/shorten-url.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tzsk/shorten-url
[link-travis]: https://travis-ci.org/tzsk/shorten-url
[link-scrutinizer]: https://scrutinizer-ci.com/g/tzsk/shorten-url/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/tzsk/shorten-url
[link-downloads]: https://packagist.org/packages/tzsk/shorten-url
[link-author]: https://github.com/tzsk
[link-contributors]: ../../contributors
