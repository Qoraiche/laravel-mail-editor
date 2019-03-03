# laravel-mail-editor (Known as mailEclipse)

[![Total Downloads](https://poser.pugx.org/qoraiche/laravel-mail-editor/downloads)](https://packagist.org/packages/qoraiche/laravel-mail-editor)
[![License](https://poser.pugx.org/qoraiche/laravel-mail-editor/license)](https://packagist.org/packages/qoraiche/laravel-mail-editor)

This Package inspired from [JoggApp/laravel-mail-viewer](https://github.com/JoggApp/laravel-mail-viewer) & [laravel/telescope](https://github.com/laravel/telescope) (Design).

## Features

* Beautiful & responsive front-end.
* View/edit all your mailables at a single place.
* Templates (more than 20+ ready to use email templates).
* WYSIWYG Email HTML/Markdown editor.
* Suitable for laravel beginners.
* and many more... (promise).

## Requirements

* Laravel 5.6+.

## Installation

Via Composer

``` bash
$ composer require qoraiche/laravel-mail-editor
```

The package will automatically register itself.

Publish configuration file and public assets:

``` bash
php artisan vendor:publish --provider="qoraiche\mailEclipse\mailEclipseServiceProvider"
```

Migrate database:

```bash
php artisan migrate
```

## Usage

After setting up the package as described above, you can now access the application by visiting the `/maileclipse` route (considering the default url is `maileclipse` in the config file). You can modify it to whatever you want as per your needs.

![maileclipse-img](https://i.imgur.com/cWD5odh.png)

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email author email [qoraicheofficiel@hotmail.com](mailto:qoraicheofficiel@hotmail.com) instead of using the issue tracker.

## License

license. Please see the [license file](LICENSE) for more information.

## Donate :heart:

If this package helps you, so why not buy me a coffe [Paypal.me](https://www.paypal.me/streamaps), thank you!

[ico-version]: https://img.shields.io/packagist/v/qoraiche/maileclipse.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/qoraiche/maileclipse.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/qoraiche/maileclipse/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/qoraiche/maileclipse
[link-downloads]: https://packagist.org/packages/qoraiche/maileclipse
[link-travis]: https://travis-ci.org/qoraiche/maileclipse
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/qoraiche
[link-contributors]: ../../contributors
