@component('mail::message')
# {{ $item->name }} was liked

{{ $liker->name }} liked one of your items.

@component('mail::button', ['url' => route('collections.show', $item->collection)])
    View Item In Collection
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent