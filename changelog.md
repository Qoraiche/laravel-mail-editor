# Changelog

All notable changes to `laravel-mail-editor` will be documented in this file.

## Version 1.0.0

- initial release

## Version 1.0.1

- fix error `Call to a member function sortBy() on null` that happens when mailables directory not created yet.
- replace jquery `$.ajax` with `axios` library, also adding notie confirmation for save-template action.
- fix javascript error `plaintextEditor is not defined` when save mailable view template.
- other minor fixes.

## Version 1.0.2

- remove unwanted routes
- fix mailable with multiple constructor args type error ([issue](https://github.com/Qoraiche/laravel-mail-editor/issues/1)).
- Replace route closure with controller based route ([issue](https://github.com/Qoraiche/laravel-mail-editor/issues/2)).
- other minor fixes.

## Version 1.1.0

- look for the equivalent factory and check if the dependency is an eloquent model.
- resolve all other non-eloquent objects.
- markdown editor will output no object variables in the following format: {{ varname }}.

## Version 1.1.1

- fix template view path encoding for windows env.

## Version 1.1.2

- Add constructor auto detect for arrays.

## Version 1.1.3

- rollback db after generating a model factory.

## Version 1.1.4

- Fix error saving template error `Request failed with status code 500`.

## Version 1.1.5

- Enable source code editing plugin for WYSIWYG.

## Version 1.1.6

- Add `vendor:publish` for template production.

## Version 1.1.7

- Moving away templates metadata from DB to a JSON file to avoid production problems.

## Version 1.1.10

- Fixes issues #15, #16 
- Adds the ability to have params mocked for a Mailable's constructor where a type isn't available

## Version 1.1.11

- Fixes issue where the **tinyMCE editor** would take the blade directive `{{ $user->name }}` and then render the thing as this in the `.blade.php` file `{{ $user-&gt;name }}`.

## Version 1.1.14

- Add ui anchor icon for each simple variable.
- Fix error that occured when updating template details: Error: Request failed with status code 500 #32.
- Add route groups.

## Version 1.1.15

- Add Legacy output plugin and inline_styles option to TinyMCE editor.

## Version 1.1.16

- Add web middleware

## Version 1.1.20

- Add advanced editor params.
- Optional factory usage configuration.
- Add with data to params list.
- Remove web middleware which disables markdown preview to render.

## Version 1.1.21

- Rename config middleware option to middlewares and add a simple middleware example.

## Version 1.2.0

- Save created templates to maileclipse vendor resources path.
- Fix editor view data anchor.
- Rename configuration option `mail_dir` to `mailables_dir`.

## Version 1.2.1

- Fix markdown template preview error request **419**.

## Version 1.2.3

- Fixed generation of test instance
- StyleCi integration

## Version 1.2.4

- Fix typo in error message

## Version 1.2.5

- Fix mailable deletion

## Version 1.3.0

- Supports Laravel 6
- Backwards compatibility

## Version 1.3.1

- Update footer minor version

## Version 1.3.2

- Fix constructor type hints
- Type hints in mailable constructor must be an object

## Version 1.3.3

- minor fixes

## Version 1.4.3

- Minor Bug fixes: #87 #86 #78

## Version 2.0

- Laravel 7 support
- Minor bug fixes

## Version 2.0.4

- fix bug #82 (Function ReflectionType::__toString() is deprecated)

## Version 2.0.6

- Fix Mailables deletion
- Read properties of the Mailable parent classes

## Version 2.1.0

### Addition
- Laravel 8 Support
- Laravel legacy factories for L8 support 
see #107, #106 

## Version 2.2.0

IMPORTANT: Version 2.2.0 will only support Laravel versions 5, 6 and 7 for future releases.

### Addition
- Revert Laravel 8 support
- Console command for installing assets see PR #111, credit: @yogendra-revanna

## Version 3.0.0
Laravel 8 Support release

## Version 3.0.1
- PSR standards for console command class name, see #115, credit @ivebe

## Version 3.1.0
- Improve the sanitization of class names for mailables to align with PHP expectations. credit @ivebe

## Version 3.2.1
- Add the ability to send test mail with fake factory model data
- Fix model factories builder not loaded in laravel 8
- Formatting 

## Addition

- The package now has an install command `php artisan laravel-mail-editor:install` see #111 

## Changes

- Supports only Laravel v8
- See [#108](https://github.com/Qoraiche/laravel-mail-editor/pull/108)
- PSR Classnames #112, thank you @yogendra-revanna

## Potential Breaking Change

The name spaces of the package now use PSR classname standards, if you were referencing them before in an application, please update them to reflect everything correctly.
