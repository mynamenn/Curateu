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
    <div class="flex-column pt-10 pb-6 px-4 rounded-lg overflow-hidden align items-center justify-center text-center">
        <img class="w-24 h-24 mb-4 inline-flex items-center flex-shrink-0" src={{ $category->photo }} alt="content">

        <h1 class="title-font text-3xl font-bold text-indigo-500 mb-3">
            {{ $category->name }}
        </h1>
        <h2 class="tracking-widest text-lg title-font font-medium text-gray-500 mb-1">{{ $category->description }}
        </h2>
    </div>

    <p class="sm:mx-8 mx-2 font-semibold text-2xl">{{ $collections->total() }}
        {{ Str::plural('Collection', $collections->total()) }}</p>

    <div class="sm:mx-8 my-4 mx-2 border-2 border-gray-300 border-opacity-50 rounded-md">

        @foreach ($collections as $index => $collection)
            <div class="transition duration-500 ease-in-out hover:bg-gray-100 transform hover:translate-x-1 flex px-4 py-5 sm:flex-row flex-row cursor-pointer"
                onclick="collectionClick('{{ route('collections.show', ['collection' => $collection]) }}')">
                <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 rounded-full inline-flex items-center justify-center flex-shrink-0"
                    src={{ $collection->photo }} alt="content">
                <div class="flex-grow">
                    <h2 class="text-gray-900 text-lg title-font font-medium">{{ $collection->name }}</h2>
                    <p class="leading-relaxed text-base mb-1">
                        {{ $collection->description }}
                    </p>
                    <div class="flex flex-row items-center">
                        <svg viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg" color="light-gray" width="12"
                            height="18" class="mr-2">
                            <path
                                d="M6.5.75c-3.31 0-6 2.362-6 5.267 0 2.905 2.69 5.266 6 5.266a6.8 6.8 0 001.036-.08l2.725 1.486a.5.5 0 00.74-.44V9.46a4.893 4.893 0 001.5-3.443C12.5 3.112 9.81.75 6.5.75z"
                                fill="currentColor"></path>
                        </svg>
                        <p class="mr-3 font-semibold text-sm">{{ $collection->comments->count() }}</p>
                        @foreach ($collection->tags->take(2) as $index => $tag)
                            <p class="leading-relaxed text-sm mr-1 hidden sm:inline">{{ $tag->name }}
                                {{ ($collection->tags->count() > 1 and $index === 0) ? ' · ' : '' }}</p>
                        @endforeach
                    </div>

                </div>
                <button
                    class="flex flex-col h-full border-2 border-gray-200 p-3 ml-1 rounded-md text-center items-center transition duration-500 ease-in-out hover:border-indigo-200"
                    onclick="upvoteClick(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                        stroke="#4B587C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-up">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                    <p class="leading-relaxed">{{ $collection->likes->count() }}</p>
                </button>
            </div>
            {{-- If no pages and is at last element, don't show hr --}}
            @if (($collections->hasPages() == false && ($index == $collections->count() - 1 || $collections->count())))
                {{-- Do nothing --}}
            @else
                <hr class="border-t-2 border-gray-300 border-opacity-50" />
            @endif
        @endforeach

        @if ($collections->hasPages())
            <div class="py-3 px-4">
                {{ $collections->links() }}
            </div>
        @endif
    </div>
@endsection
