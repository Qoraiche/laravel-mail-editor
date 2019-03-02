@component('mail::message')

We received a request to reset the password to access [Product Name] with your email address ({email_address}) from a {operating_system} device using {browser_name}, but we were unable to find an account associated with this address.

If you use [Product Name] and were expecting this email, consider trying to request a password reset using the email address associated with your account.

@component('mail::button',  ['url' => '#link'])
Try a different email
@endcomponent

If you do not use [Product Name] or did not request a password reset, please ignore this email or contact support if you have questions.

Thanks,<br>
The [Product Name] Team

-----

<small>If you’re having trouble with the button above, copy and paste the URL below into your web browser.</small>

{action_url}

@endcomponent