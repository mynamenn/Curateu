@component('mail::message')
# {{ $collection->name }} was commented

{{ $liker->name }} commented on your collection.

@component('mail::button', ['url' => route('collections.show', $collection)])
    View Comment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent