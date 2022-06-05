---
sidebar_position: 1
---

# Creating a Mailable

Creating new Mailables with the package will not require you to make them using the terminal like normal. This allows you to stay in the editor area and handle it that way.

## Create a mailable with the UI

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
| Markdown Template | optional checkbox, once checked you need to enter the view name |
| Force | ⚠️ This will force the creating of the mailable |

## Mail Stubs

When using Laravel ^8.7 there is the option to use stubs for your default mail option. This is an option provided by the Laravel framework, please make sure to follow Laravel's docs for any specific details. [https://laravel.com/docs/artisan#stub-customization](https://laravel.com/docs/artisan#stub-customization)

If you are editing the stubs, the stub is under the `stubs/mail.stub` and `stubs/markdown-mail.stub` files. These are available after running the `php artisan stub:publish` command.

It is recommended that you add you edits to both files. After that because the create process uses the Laravel artisan command to create Mailables it will inherit this correctly.

## Editing the Mail Class

The Mailable class that is created can now be edited. You can add your constructor arguments and also assignments to `public` values.

If you are adding Models to the `__constructor` please be sure to add Model factories for the models added in the constructor.

This is because they are hydrated and their relations by means of the factories to create preview mailables.

Without a factory you will receive an error that either the Mocked class is not the same type or 0 arguments were passed.

## Providing the view or blade file

Before you can view the preview of your mailable you will need to make use of a [template](/guides/create-a-template) or a blade file that you have already.

If you try to view the preview at this point you will only see a blank screen or a notice that you need to link a template.

In your mailable you need to add the following:

```diff
/**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
-        return $this->view('view.name');
+        return $this->view('my-view-file');
    }
```
