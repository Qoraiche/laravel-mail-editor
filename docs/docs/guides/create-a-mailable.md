---
sidebar_position: 1
---

# Creating a Mailable

Creating new Mailables with the package will not require you to make them using the terminal like normal. This allows you to stay in the editor area and handle it that way.

## Create one with the UI

To create a new mailable you will need to visit the main url for MailEclipse, this is from the defined setting in the config file. If you used `php artisan serve` you will find the page here:

`http://localhost:8000/maileclipse/mailables`

This will show you the page with a table and the sidebar.

To create a mailable you can click <kbd>Add Mailable</kbd>.

A modal will open and you will be presented with the below:

![maileclipse-new-mailable](https://i.imgur.com/AiMEtY0.png)

### Options

| Form Label | Input Options |
|:----|:------|
| Name | `Welcome User` or `WelcomeUser` |
| Markdown Template | optional checkbox, once active you need to enter the view name |
| Force | ⚠️ This will force the creating of the mailable |

## Mail Stubs

When using Laravel ^8.7 there is the option to use stubs for your default mail option.

If you are editing the stubs, the stub is under the `stubs/mail.stub` and `stubs/markdown-mail.stub` files. This are available after running the `php artisan stub:publish` command.

It is recommended that you add you edits to both files. After that because the create process uses the Laravel artisan command to create Mailables it will inherit this correctly.

## Editing the Mail Class

The Mailable class that is created can now be edited. You can add your constructor arguments and also assignments to `public` values.

If you are adding Models to the `__constructor` please be sure to review ...
