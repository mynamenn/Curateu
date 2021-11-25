@component('mail::message')
# {{ $collection->name }} was liked

{{ $liker->name }} liked one of your collections.

@component('mail::button', ['url' => route('collections.show', $collection)])
    View Collection
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent