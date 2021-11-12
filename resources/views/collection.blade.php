@extends('layouts.app')

@section('content')
    <div>
        <p>{{ $collection->name }}</p>

        <a href="{{ url()->previous() }}">Back</a>

        @foreach ($items as $item)
            <p>{{ $item->name }}</p>
        @endforeach
        {{ $items->links() }}
    </div>
@endsection
