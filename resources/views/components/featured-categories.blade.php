@props(['categories' => $categories])

<script>
    function categoryClick(route) {
        location.href = route;
    }
</script>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-5 mx-auto">
        <div class="flex flex-wrap w-full mb-6 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-semibold title-font mb-2 text-gray-900">
                Categories
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                Find the curations you need in these categories.
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($categories as $category)
                <div class="p-4 sm:w-1/2 lg:w-1/4 cursor-pointer" onclick="categoryClick('{{ route('categories.show', ['categoryName' => str_replace(' ', '-', $category->name)]) }}')">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src={{ $category->photo }}
                            alt="coverPhoto">
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $category->name }}</h1>
                            <p class="leading-relaxed mb-3">{{ $category->description }}</p>
                            <div class="flex items-center flex-wrap ">
                                <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
