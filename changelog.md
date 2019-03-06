# Changelog

All notable changes to `laravel-mail-editor` will be documented in this file.

## Version 1.0

- Everything
- Fix error `Call to a member function sortBy() on null` that happens when mailables directory not created yet.
- Replace jquery `$.ajax` with `axios` library, also adding notie confirmation for save-template action
- Fix javascript error `plaintextEditor is not defined` when save mailable view template.

## Version 1.1

- Fix mailable with multiple constructor args type error ([issue](https://github.com/Qoraiche/laravel-mail-editor/issues/1)).