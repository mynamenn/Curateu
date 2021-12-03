@extends('layouts.app')

<script>
    function collectionClick(route) {
        location.href = route;
    }

    function showEditCategoryModal() {
        document.getElementById("editCategoryForm").style.display = "block";
    }

    function closeEditCategoryModal() {
        document.getElementById("editCategoryForm").style.display = "none";
    }
</script>

@section('content')
<div class="w-full bg-cover bg-center mb-4" style="height:22rem; background-image: url({{ $category->photo }});">
    <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
        <div class="flex-column px-4 rounded-lg overflow-hidden align items-center justify-center text-center">
            <p class="text-5xl font-extrabold text-white drop-shadow-lg	 mb-3 md:text-6xl">
                {{ $category->name }}
            </p>
            <p class="tracking-widest text-xl font-medium text-white mb-2 md:text-2xl">{{
                $category->description }}
            </p>
            @if (AuthHelper::canHandleCategory())
            <form action="{{ route('categories.destroy', $category) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="showEditCategoryModal()"
                    class="mr-2 text-white font-bold text-base hover:text-white border border-white hover:bg-indigo-500 rounded-xl px-4 py-1 text-center">
                    Edit
                </button>
                <button type="submit"
                    class="text-white font-bold text-base hover:text-white border border-white hover:bg-indigo-500 rounded-xl px-4 py-1 text-center">
                    Delete
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<div
    class="sm:mx-8 mx-2 flex-column pt-10 pb-6 px-4 rounded-lg overflow-hidden">

    <x-banner class="mb-4"></x-banner>

    @if (AuthHelper::canHandleCategory())
    {{-- Edit category form --}}
    <form action="{{ route('categories.update', $category) }}" method="post" enctype="multipart/form-data"
        class="p-4 border-2 mb-4 hidden border-gray-200" id="editCategoryForm">
        @csrf
        @method('PATCH')
        <p class="text-lg font-semibold mb-4">Edit Category</p>
        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
        <div class="mb-4">
            <label for="name" class="font-medium text-gray-900 block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Online tools" required>
        </div>

        <div class="mb-4">
            <label for="description" class="font-medium text-gray-900 block mb-2">Description</label>
            <input type="text" name="description" id="description" value="{{ $category->description }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Best online tools on the market!" required>
        </div>

        <div class="mb-4">
            <label for="photo" class="font-medium text-gray-900 block mb-2">Photo</label>
            @if ($category)
            <img class="w-20 h-20 mr-2 inline-flex items-center bg-indigo-100 text-indigo-500 flex-shrink-0" src={{
                $category->photo }} alt="photo preview">
            @endif
            <input id="photo" type="file" name="photo" accept="image/*">
            <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than 1MB</div>
        </div>

        <div class="flex flex-row-reverse">
            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                Save
            </button>
            <button type="button" onclick="closeEditCategoryModal()"
                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                Cancel
            </button>
        </div>
    </form>
    @endif

    <p class="font-semibold text-2xl">{{ $collections->total() }}
        {{ Str::plural('Collection', $collections->total()) }}
    </p>

    @if ($collections->total() > 0)
    <div class="my-4 border-2 border-gray-300 border-opacity-50 rounded-md">

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
                        {{ ($collection->tags->count() > 1 and $index === 0) ? ' · ' : '' }}
                    </p>
                    @endforeach
                </div>
            </div>

            <x-upvote-button :object="$collection" :actionPath="route('collections.likes', $collection->id)">
            </x-upvote-button>
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
    @else
    <p class="mt-5 mb-6 font-medium text-lg">No items found.</p>
    @endif

</div>
@endsection