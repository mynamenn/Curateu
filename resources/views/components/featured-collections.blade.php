@props(['collections'])

<script>
    function collectionClick(route) {
        location.href = route;
    }

    function upvoteClick(e) {
        e.stopPropagation();
    }
</script>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-7 mx-auto flex flex-wrap">
        <div class="flex flex-wrap w-full mb-6 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-semibold title-font mb-2 text-gray-900">
                Featured Collections
            </h1>
            <p class="text-lg lg:w-1/2 w-full leading-relaxed text-gray-500">
                Best collections on the platform.
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($collections as $collection)
                <div class="p-2 lg:w-1/2 w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-4 sm:flex-row flex-row cursor-pointer transform hover:-translate-y-1 transition duration-500 ease-in-out"
                        onclick="collectionClick('{{ route('collections.show', ['collection' => $collection]) }}')" tabindex="0">
                        <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                            src={{ $collection->photo }} alt="content">
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium">{{ $collection->name }}</h2>
                            <p class="leading-relaxed text-base mb-1">
                                {{ $collection->description }}
                            </p>
                            <div class="flex flex-row items-center">
                                <svg viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg" color="light-gray"
                                    width="12" height="18" class="mr-2">
                                    <path
                                        d="M6.5.75c-3.31 0-6 2.362-6 5.267 0 2.905 2.69 5.266 6 5.266a6.8 6.8 0 001.036-.08l2.725 1.486a.5.5 0 00.74-.44V9.46a4.893 4.893 0 001.5-3.443C12.5 3.112 9.81.75 6.5.75z"
                                        fill="currentColor"></path>
                                </svg>
                                <p class="mr-3 font-semibold text-sm">{{ $collection->comments->count() }}</p>
                                {{-- Tags --}}
                                @foreach ($collection->tags->take(2) as $index => $tag)
                                    <p class="leading-relaxed text-sm mr-1">{{ $tag->name }}
                                        {{ ($collection->tags->count() > 1 and $index === 0) ? ' · ' : '' }}</p>
                                @endforeach
                            </div>

                        </div>

                        <x-upvote-button :object="$collection" :actionPath="route('collections.likes', $collection->id)"></x-upvote-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
