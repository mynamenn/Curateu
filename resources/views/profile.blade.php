@extends('layouts.app')

@section('content')
    <script>
        function collectionClick(route) {
            location.href = route;
        }
    </script>

    <div>
        <div class="w-full bg-cover bg-center mb-6"
            style="height:28rem; background-image: url({{ $user->cover_picture }});">
            <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
                <div class="flex-column px-4 rounded-lg overflow-hidden align items-center justify-center text-center">
                    <img class="w-24 h-24 mb-4 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                        src={{ $user->profile_picture }} alt="content">

                    <h1 class="title-font text-3xl font-bold text-white md:text-4xl">
                        {{ $user->name }}
                    </h1>

                    <h2 class="tracking-widest text-base title-font font-medium text-white mb-1 md:text-lg">
                        {{ $user->headline }}
                    </h2>

                    <a class="block tracking-widest text-sm title-font font-bold text-white hover:text-blue-400 visited:text-purple-600 hover:underline mb-1 md:text-base"
                        href="{{ $user->website }}" target="_blank">
                        {{ $user->website }}
                    </a>

                    <h2 class="block tracking-widest text-sm title-font font-medium text-gray-200 mb-1 md:text-base">
                        {{ '@' }}{{ $user->username }}
                    </h2>
                    <div class="flex flex-row items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-md font-medium text-gray-200 md:text-base">
                            Joined {{ $user->created_at->format('M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="sm:mx-8 mx-2 font-semibold text-2xl">{{ $collections->total() }}
            {{ Str::plural('Collection', $collections->total()) }}</p>

        <div class="sm:mx-8 mt-4 mb-6 mx-2 border-2 border-gray-300 border-opacity-50 rounded-md">
            @foreach ($collections as $index => $collection)
                <div class="transition duration-500 ease-in-out hover:bg-gray-100 transform hover:-translate-y-1 flex px-4 py-5 sm:flex-row flex-row cursor-pointer"
                    onclick="collectionClick('{{ route('collections.show', ['collection' => $collection]) }}')">
                    <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center bg-indigo-100 text-indigo-500 flex-shrink-0"
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
                    
                    <x-upvote-button :object="$collection" :actionPath="route('collections.likes', $collection->id)"></x-upvote-button>
                </div>
                <hr class="border-t-2 border-gray-300 border-opacity-50" />
            @endforeach

            @if ($collections->hasPages())
                <div class="py-3 px-4">
                    {{ $collections->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
