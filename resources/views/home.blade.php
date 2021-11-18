@extends('layouts.app')

@section('content')
    <div>
        <x-introduction></x-introduction>
        <x-featured-categories :categories="$categories"></x-featured-categories>
        <x-featured-collections :collections="$collections"></x-featured-collections>
    </div>
@endsection
