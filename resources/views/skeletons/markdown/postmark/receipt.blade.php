@component('mail::message')

**Hi {name},**

Thanks for using [Product Name]. This email is the receipt for your purchase. No payment is due.

This purchase will appear as “[Credit Card Statement Name]” on your credit card statement for your {credit_card_brand} ending in {credit_card_last_four}. Need to [update your payment information](#link)?


@component('mail::promotion')

# 10% off your next purchase!

Thanks for your support! Here's a coupon for 10% off your next purchase if used by {expiration_date}.


@component('mail::button',  ['url' => '#link', 'color' => 'success'])
Use this discount now...
@endcomponent
			    
@endcomponent


@component('mail::table')
| {receipt_id} | {date} |
| ------------- |:-------------:|
| { #each receipt_details} {/each} |
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

@component('mail::button',  ['url' => '#link'])
Download as PDF
@endcomponent

@endcomponent