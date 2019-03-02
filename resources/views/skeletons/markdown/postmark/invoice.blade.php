@component('mail::message')

**Hi {name},**

Thanks for using [Product Name]. This is an invoice for your recent purchase.

**Amount Due:** {total}<br>
**Due By:** {due_date}


@component('mail::button',  ['url' => '#link', 'color' => 'success'])
Pay this Invoice
@endcomponent

@component('mail::table')
| {invoice_id} | {date} |
| ------------- |:-------------:|
| { #each invoice_details} {/each} |
@endcomponent

@component('mail::table')
| Description | Amount |
| ------------- |:-------------:|
| {description} | {amount} |
| |
| | **Total** {total} |
@endcomponent
			    
If you have any questions about this receipt, simply reply to this email or reach out to our [support team](#link) for help.

Cheers,
The [Product Name] Team

-----

<small>If you’re having trouble with the button above, copy and paste the URL below into your web browser.</small>

{action_url}

@endcomponent