@component('mail::message')

# Hi, {name}!

{invite_sender_name} with {invite_sender_organization_name} has invited you to use [Product Name] to collaborate with them. Use the button below to set up your account and get started:


[component]: # ('mail::button',  ['url' => '#url'])
Set up account
[endcomponent]: #

If you have any questions for {invite_sender_name}, you can reply to this email and it will go right to them. Alternatively, feel free to [contact our customer success team](#link) anytime. (We're lightning quick at replying.) We also offer [live chat](#link) during business hours.

Welcome aboard,<br>
The [Product Name] Team

**P.S.** Need help getting started? Check out our help documentation.

-----

<small>If you’re having trouble with the button above, copy and paste the URL below into your web browser.</small>

{action_url}

@endcomponent