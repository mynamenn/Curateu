@props(['category'])

<button class="p-4 text-left sm:w-1/2 lg:w-1/3 transform hover:-translate-y-1 transition duration-500 ease-in-out"
    onclick="categoryClick('{{ route('categories.show', ['categoryName' => str_replace(' ', '-', $category->name)]) }}')">
    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden focus:border-black">
        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src={{ $category->photo }} alt="coverPhoto">
        <div class="p-6">
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $category->name }}</h1>
            <p class="leading-relaxed mb-1">{{ $category->description }}</p>
        </div>
    </div>
</button>
