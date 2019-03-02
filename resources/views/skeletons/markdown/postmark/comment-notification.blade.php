@component('mail::message')

{body}

{#attachment_details}

@component('mail::panel')

{#each . } {/each}
{attachment_name} ({attachment_size} {attachment_type})

@endcomponent

{/attachment_details}

@endcomponent