---
sidebar_position: 2
---

# Creating a Template

The template is needed to be able to edit the mailable blade file for providing you the visual part of your mail.

:::info Linking Templates
Currently you will need to manually link the mail template blade file inside the `build()` function of the mail class.
:::

### Choosing a Predefined Template

From the MailEclipse sidebar you can click the Templates. This will show you a list of current templates you have created or nothing.

You can click <kbd>Add Template</kbd>

This will open a window with a list of reference images of the template themes available. It looks like this:

![maileclipse-templates](https://i.imgur.com/siqxWVa.png)

Selecting a them will present a modal with options for that theme. Picking one will open an editor for that template file.



## Linking the template

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
