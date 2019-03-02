@component('mail::message')

# Your [Product Name] trial ends in 3 days 

Thanks for trying [Product Name]. You've added a lot of data, so here are several options for you to consider going forward.

@component('mail::button',  ['url' => '#link', 'color' => 'success'])
Upgrade your account
@endcomponent

If you're not ready to upgrade to a paying account, you have a few other options available to you…

@component('mail::panel')
[Restart your trial](#) - If you didn't get a chance to fully try out the product or need a little more time to evaluate, just let us know. Simply reply to this email and we'll extend your trial period.

[Share feedback](#) - If [Product Name] isn't right for you, let us know what you were looking for and we might be able to suggest some alternatives that might be a better fit.

[Export your data](#) - If [Product Name] wasn't a good fit, you can export your data for use elsewhere.

[Close your account](#) - You can close your account and delete your data. Or, do nothing and we'll automatically close it and delete your data for you in 90 days. But don't worry, we'll send you another email before that happens.
@endcomponent

Regardless of your choice, we want to say thank you for trying [Product Name]. We know it's an investment of your time, and we appreciate you giving us a chance.

Thanks,<br>
[Sender Name] and the [Product Name] Team
			   
**P.S.** If you have any questions or need any help, please don't hesitate to reach out. You can reply to this email or join us on live chat during business hours.

@endcomponent