@props(['categories' => $categories])

<section class="text-gray-600 body-font">
    <div class="container px-5 py-5 mx-auto">
        {{-- <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                    Categories
                </h1>
                <div class="h-1 w-20 bg-indigo-500 rounded"></div>
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                Find the curations you need in these categories.
            </p>
        </div> --}}
        <div class="flex flex-wrap w-full mb-10 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                Categories
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                Find the curations you need in these categories.
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($categories as $category)
                <div class="w-full xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <img class="h-40 rounded w-full object-cover object-center mb-6"
                            src={{ $category->photo }} alt="content">
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">SUBTITLE</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{ $category->name }}</h2>
                        <p class="leading-relaxed text-base">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
