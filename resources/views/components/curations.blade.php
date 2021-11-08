@props(['curations' => $curations])

<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap">
        {{-- <div class="flex flex-wrap w-full mb-3">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                    Featured curations
                </h1>
                <div class="h-1 w-20 bg-indigo-500 rounded"></div>
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                Best curations on the platform.
            </p>
        </div> --}}
        <div class="flex flex-wrap w-full mb-10 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                Featured curations
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                Best curations on the platform.
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($curations as $curation)
                <div class="p-4 lg:w-1/2 w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                        <div
                            class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <img src={{ $curation->photo }} alt="content">
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">{{ $curation->name }}</h2>
                            <p class="leading-relaxed text-base">
                                {{ $curation->description }}
                            </p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
