---
sidebar_position: 2
---

# Creating a Template

The template is needed to be able so you can edit the mailable blade file, this provides you the visual part of your mail.

:::info Linking Templates
Currently you will need to manually link the mail template blade file inside the `build()` function of the mail class.
:::

### Using a Predefined Template

From the MailEclipse sidebar you can click the Templates. This will show you a list of current templates you have created or nothing.

You can click <kbd>Add Template</kbd>

This will open a window with a list of reference images of the template themes available. It looks like this:

![maileclipse-templates](https://i.imgur.com/siqxWVa.png)

Selecting a theme will present a modal with layout options for that theme. Picking one will open an editor so you can adjust it to your needs.

Once you have made adjustments in the editor to the template you can then click <kbd>Create</kbd>. This will show you the option to set the name and also to add a decription (optional). When you click save then you will be redirected to the templates edit page.
### Modifying a template

:::info variable names
As of versions 4 and below, you can add variables, but when you preview it you will get an error. This is normal at the moment as it isn't linked to a mailable
:::

In the template table list you can click the template you want to modify and then it will open into the editor.

When modifying a template you will get a RichText (TinyMCE) editor that will show you either the raw Markdown or the html version of the mailable as editable RichText.

When using the markdown version of a template you can add the components that are from laravel. These are options for quick insert from the TinyMCE editor toolbar.

![md template tinymce](/img/tinymce_templates_md.png)
(Template actions for Markdown components)

Once you have made modifications you can click <kbd>Update</kbd>

### Linking the template

```diff
/**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
-        return $this->view('view.name');
+        return $this->view('maileclipse::templates.orderShipped');
    }
```
