@extends('layouts.app')

<script>
    function collectionClick(route) {
        location.href = route;
    }

    function upvoteClick(e) {
        e.stopPropagation();
    }
</script>

@section('content')
    <div class="container px-5 pt-10 pb-5 mx-auto">
        {{-- Category results --}}
        <div class="flex flex-wrap w-full mx-2 mb-4 flex-col text-left">
            <h1 class="sm:text-3xl text-2xl font-bold title-font mb-2 text-gray-900">
                Categories with "{{ $query }}"
            </h1>
            <p class="w-full leading-relaxed text-gray-500 text-lg">
                {{ $categories->total() }} Results
            </p>
        </div>
        <div class="flex flex-wrap">
            @foreach ($categories as $category)
                <x-category-card :category="$category"></x-category-card>
            @endforeach
        </div>
        <div class="mx-2 mb-6">
            {{ $categories->links() }}
        </div>

        {{-- Collection results --}}
        <div class="flex flex-wrap w-full mx-2 mb-4 flex-col text-left">
            <h1 class="sm:text-3xl text-2xl font-bold title-font mb-2 text-gray-900">
                Collections with "{{ $query }}"
            </h1>
            <p class="w-full leading-relaxed text-gray-500 text-lg">
                {{ $collections->total() }} Results
            </p>
        </div>
        <div class="flex flex-wrap">
            @foreach ($collections as $collection)
                <x-collection-card :collection="$collection"></x-collection-card>
            @endforeach
        </div>
        <div class="mx-2 mb-6">
            {{ $collections->links() }}
        </div>

        {{-- Curator results --}}
        <div class="flex flex-wrap w-full mx-2 mb-4 flex-col text-left">
            <h1 class="sm:text-3xl text-2xl font-bold title-font mb-2 text-gray-900">
                Curators with "{{ $query }}"
            </h1>
            <p class="w-full leading-relaxed text-gray-500 text-lg">
                {{ $curators->total() }} Results
            </p>
        </div>
        <div class="flex flex-wrap">
            @foreach ($curators as $curator)
                <x-curator-card :curator="$curator"></x-curator-card>
            @endforeach
        </div>
        <div class="mx-2 mb-6">
            {{ $curators->links() }}
        </div>

    </div>
@endsection
