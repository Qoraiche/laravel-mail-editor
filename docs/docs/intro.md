---
sidebar_position: 1
---

# Introduction

MailEclipse is a mailable editor package for your Laravel applications to create and manage mailables using a web UI. You can use this package to develop mailables without using the command line, and edit templates associated with mailables using a WYSIWYG editor, among other features.

## Getting Started

Install MailEclipse using Composer

``` bash
composer require qoraiche/laravel-mail-editor
```

Publish configuration file and public assets:

``` bash
php artisan laravel-mail-editor:install
```

:::note Registering the Service Provider
MailEclipse will automatically register itself with the Laravel service container. To do so manually see [Service Provider](#service-provider) Details.
:::

## Additional Installation Details

Below is a list of other details to be aware of when installing the package.

### Service Provider

```php {3}
'providers' => [
    // Other Service Providers
    Qoraiche\\MailEclipse\\MailEclipseServiceProvider::class,
],
```
