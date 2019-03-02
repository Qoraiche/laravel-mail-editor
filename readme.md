# laravel-mail-editor (Known as mailEclipse)

[![Total Downloads](https://poser.pugx.org/qoraiche/laravel-mail-editor/downloads)](https://packagist.org/packages/qoraiche/laravel-mail-editor)
[![License](https://poser.pugx.org/qoraiche/laravel-mail-editor/license)](https://packagist.org/packages/qoraiche/laravel-mail-editor)

This Package inspired from [JoggApp/laravel-mail-viewer](https://github.com/JoggApp/laravel-mail-viewer) & [laravel/telescope](https://github.com/laravel/telescope).

## Features

* View/edit all your mailables at a single place.
* Manage mail templates (more than 20+ ready to use mail template).
* Suitable for laravel beginners.
* and you will discover many more... (i promise).

## Requirements

* Laravel 5.7+ (may work on 5.5+ but not tested).
* Lumen (will added soon).

## Installation

Via Composer

``` bash
$ composer require qoraiche/laravel-mail-editor
```

The package will automatically register itself.

Publish configuration file and public assets.

``` bash
php artisan vendor:publish --provider="qoraiche\mailEclipse\mailEclipseServiceProvider"
```

Migrate database

```bash
php artisan migrate
```

## Usage

After setting up the package as described above, you can now access the application by visiting the `/maileclipse` route (considering the default url is `maileclipse` in the config file). You can modify it to whatever you want as per your needs.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email author email (qoraicheofficiel@hotmail.com) instead of using the issue tracker.

## License

license. Please see the [license file](LICENSE) for more information.

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
