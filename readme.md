<h6 align="center">
    <img src="https://i.imgur.com/QpAJLql.png" width="150"/>
</h6>

<h2 align="center">
    Laravel Mail Editor (Aka MailEclipse)
</h2>

<p align="center">
<a href="https://packagist.org/packages/qoraiche/laravel-mail-editor" alt="sponsors on Open Collective"><img src="https://poser.pugx.org/qoraiche/laravel-mail-editor/v/stable" /></a> <a href="https://packagist.org/packages/qoraiche/laravel-mail-editor" alt="Sponsors on Open Collective"><img src="https://poser.pugx.org/qoraiche/laravel-mail-editor/license" /></a> 
</p>
<br/><br/>

This Package inspired from [JoggApp/laravel-mail-viewer](https://github.com/JoggApp/laravel-mail-viewer) & [laravel/telescope](https://github.com/laravel/telescope) (Design).

## WORK IN PROGRESS

Please note that this package is still under active development. We encourage everyone to try it and give feedback.

## Features

* Create mailables without using command line.
* Preview/Edit all your mailables at a single place.
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

[![Package tutorial](https://i.imgur.com/sBCiFyt.png)](https://www.youtube.com/watch?v=QFgEGNBY3FI)


After setting up the package as described above, you can now access the application by visiting the `/maileclipse` route (considering the default url is `maileclipse` in the config file). You can modify it to whatever you want as per your needs.

![maileclipse-img](https://i.imgur.com/cWD5odh.png)

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email author email [qoraicheofficiel@hotmail.com](mailto:qoraicheofficiel@hotmail.com) instead of using the issue tracker.

## License

MIT license. Please see the [license file](LICENSE) for more information.

## Screenshots

![maileclipse-new-mailable](https://i.imgur.com/AiMEtY0.png)

![maileclipse-templates](https://i.imgur.com/siqxWVa.png)

![maileclipse-templates-create](https://i.imgur.com/8OQrEIS.png)

## TODO

__Contributions are welcome__

* Frontend enhancement (jquery to vue.js).
* Add more email templates (HTML/Markdown).
* Expand documentation pages.

## Donate :heart:

If you benefit from and/or like using MailEclipse then please help drive the future development of the project by [donating today](https://www.paypal.me/streamaps)!

### Donators list:

1. **Flavius Borlovan** (6,99 $ USD) - `#teamcookie says HELLOO 🥳😉 Thanks for this really helpful Package (MailEclipse) bro. 😉💪🏽` - 12 March 2019
2. **Maik Kasper** - (6,99 $ USD) - `We {teamcookie:github. com/flavius-constantin} 💥 love to support good developers and their awesome work! 🌪🔥` - 13 March 2019
