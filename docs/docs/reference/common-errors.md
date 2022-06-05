# Common Errors

This section has a list of common configuration errors and errors that are experienced when using MailEclipse.

## Environment not allowed

In some instances you will get a `403 Environment not allowed` error message when visiting the MailEclipse endpoints.

**Solution**
If this happens, please check if your .env `APP_ENV` value is set to one of the values that the configuration file is looking for in the `maileclipse.allowed_environments` array.

You can either adjust that array or change the `APP_ENV` value.

## Mail Stubs are ignored

You may experience an issue where after editing a mail.stub file your new mailables are not reflecting those edits.

**Solution**

You need to edit both the `markdown-mail.stub` and `mail.stub` file.

You can view issue [#185](https://github.com/Qoraiche/laravel-mail-editor/issues/185) for more details.

### Contributing

If you would like to add your errors and solutions, ones that come from misconfiguration errors. Please open a PR editing this document file.
