# Changelog

All notable changes to `laravel-mail-editor` will be documented in this file.

## Version 1.0.0

- initial release

## Version 1.0.1

- fix error `Call to a member function sortBy() on null` that happens when mailables directory not created yet.
- replace jquery `$.ajax` with `axios` library, also adding notie confirmation for save-template action
- fix javascript error `plaintextEditor is not defined` when save mailable view template.
- other minor fixes

## Version 1.0.2

- remove unwanted routes
- fix mailable with multiple constructor args type error ([issue](https://github.com/Qoraiche/laravel-mail-editor/issues/1)).
- Replace route closure with controller based route
- other minor fixes