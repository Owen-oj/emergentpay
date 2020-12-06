# EmergentPay

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Simple Laravel package for emergent payment gateway

## Installation

Via Composer

``` bash
$ composer require owenoj/emergentpay
```

## Usage
Update your .env file with the following  and their values.
```
EMERGENT_ENVIRONMENT
EMERGENT_APP_ID
EMERGENT_API_KEY
```
```
class EmergentController extends Controller
{
    public function pay()
    {   
        EmergentPay::initialize(route('callback'));    
    }

```
## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Owen Jubilant][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/owenoj/emergentpay.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/owenoj/emergentpay.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/205626111/shield

[link-packagist]: https://packagist.org/packages/owenoj/emergentpay
[link-downloads]: https://packagist.org/packages/owenoj/emergentpay
[link-styleci]: https://styleci.io/repos/205626111
[link-author]: https://github.com/owen-oj
[link-contributors]: ../../contributors

