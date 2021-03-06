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
            <p class="text-lg lg:w-1/2 w-full leading-relaxed text-gray-500">
                Find the tools and resources you need in each category
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($categories as $category)
                <div class="p-4 sm:w-1/2 lg:w-1/4 cursor-pointer transform hover:-translate-y-1 transition duration-500 ease-in-out" tabindex="0"
                onclick="categoryClick('{{ route('categories.show', ['categoryName' => str_replace(' ', '-', $category->name)]) }}')">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src={{ $category->photo }}
                            alt="coverPhoto">
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $category->name }}</h1>
                            <p class="leading-relaxed mb-1">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
