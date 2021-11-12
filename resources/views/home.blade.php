@extends('layouts.app')

@section('content')
    <div>
        <x-introduction></x-introduction>
        <x-categories :categories="$categories"></x-categories>
        <x-collections :collections="$collections"></x-collections>
    </div>
@endsection
