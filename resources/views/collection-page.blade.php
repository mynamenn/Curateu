@extends('layouts.app')

@section('content')
    <script>
        function usernameClick(route) {
            location.href = route;
        }

        function upvoteClick(e) {

        }
    </script>

    <div>
        <div class="flex-column pt-16 pb-4 px-4 rounded-lg overflow-hidden align items-center justify-center text-center">
            <img class="w-24 h-24 mb-4 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                src={{ $collection->photo }} alt="content">

            <h1 class="title-font text-2xl font-semibold text-gray-900 mb-1">
                {{ $collection->name }}
            </h1>
            <h2 class="tracking-widest text-base title-font font-medium text-gray-500 mb-1">{{ $collection->description }}
            </h2>
            <h2 onclick="usernameClick('{{ route('user', ['username' => $collection->user->username]) }}')"
                class="block tracking-widest text-base title-font font-medium text-gray-500 mb-4 cursor-pointer transition duration-200 ease-in-out hover:text-indigo-600 hover:underline">
                {{ '@' }}{{ $collection->user->username }}
            </h2>

            {{-- Tags --}}
            <div class="flex items-center justify-center mb-4">
                @foreach ($collection->tags->take(3) as $index => $tag)
                    <div class="border-2 border-gray-200 mr-2 px-1 rounded-sm bg-gray-50">
                        <p class="leading-relaxed text-xs text-gray-600 ">{{ Str::upper($tag->name) }}</p>
                    </div>
                @endforeach
                @if ($collection->tags->count() > 3)
                    <p class="leading-relaxed text-xs text-gray-600 ">+ {{ $collection->tags->count() - 3 }}</p>
                @endif
            </div>

            {{-- Upvote --}}
            <button
                class="flex items-center justify-center bg-indigo-500 px-8 py-3 rounded-md m-auto transition duration-200 ease-in-out hover:bg-indigo-600"
                onclick="upvoteClick(event)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-up mr-1">
                    <polyline points="18 15 12 9 6 15"></polyline>
                </svg>
                <p class="text-sm font-semibold text-white mr-2">UPVOTE</p>
                <p class="text-sm font-extrabold text-white">{{ $collection->likes->count() }}</p>
            </button>
        </div>

        <a href="{{ url()->previous() }}">Back</a>

        <hr class="border-t-1 border-gray-300 border-opacity-50">
        @foreach ($items as $item)
            <div class="transition duration-500 ease-in-out hover:bg-gray-100 transform hover:-translate-y-1 flex px-4 my-6 sm:flex-row flex-row cursor-pointer"
                {{-- onclick="collectionClick('{{ route('collections.show', ['collection' => $collection]) }}')" --}}>
                <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center bg-indigo-100 text-indigo-500 flex-shrink-0"
                    src={{ $item->photo }} alt="content">
                <div class="flex-grow">
                    <h2 class="text-gray-900 text-lg title-font font-medium">{{ $item->name }}</h2>
                    <p class="leading-relaxed text-base mb-1">
                        {{ $item->description }}
                    </p>
                    <div class="flex flex-row items-center">
                        <svg viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg" color="light-gray" width="12"
                            height="18" class="mr-2">
                            <path
                                d="M6.5.75c-3.31 0-6 2.362-6 5.267 0 2.905 2.69 5.266 6 5.266a6.8 6.8 0 001.036-.08l2.725 1.486a.5.5 0 00.74-.44V9.46a4.893 4.893 0 001.5-3.443C12.5 3.112 9.81.75 6.5.75z"
                                fill="currentColor"></path>
                        </svg>
                        <p class="mr-3 font-semibold text-sm">{{ $item->comments->count() }}</p>
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
                    <p class="leading-relaxed">{{ $item->likes->count() }}</p>
                </button>
            </div>
        @endforeach
        <div class="m-4">
            {{ $items->links() }}
        </div>
        <hr class="border-t-1 border-gray-300 border-opacity-50 my-2">

        <p class="text-lg text-gray-600 font-semibold ml-4">Comments</p>

        <x-comments :user="$collection->user" :comments="$comments"></x-comments>
    </div>
@endsection
