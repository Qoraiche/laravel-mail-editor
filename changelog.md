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
