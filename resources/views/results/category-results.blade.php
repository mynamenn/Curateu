@extends('layouts.app')

<script>
    function showCategoryModal() {
        document.getElementById("categoryForm").style.display = "block";
    }

    function closeCategoryModal() {
        document.getElementById("categoryForm").style.display = "none";
    }
</script>

@section('content')
    <div class="px-5 pt-10 pb-5 mx-auto">
        <div class="flex flex-wrap w-full mb-2 flex-col items-center text-center">
            <div class="flex flex-row mb-4">
                <h1 class="sm:text-4xl text-3xl mr-4 font-semibold title-font text-gray-900">
                    All Categories
                </h1>
                @if (AuthHelper::canHandleCategory())
                    <button type="button" onclick="showCategoryModal()"
                        class="text-indigo-500 font-bold text-base hover:text-white border border-indigo-700 hover:bg-indigo-500 rounded-xl px-4 py-1 text-center">
                        <span class="font-extrabold">+ </span>Add
                    </button>
                @endif
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500 text-lg">
                {{ $categories->total() }} Results
            </p>
        </div>

        @if (AuthHelper::canHandleCategory())
            <div class="px-4">
                <x-success-banner class="mb-4"></x-success-banner>
                {{-- New category form --}}
                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data"
                    class="p-4 border-2 mb-4 hidden border-gray-200" id="categoryForm">
                    @csrf
                    @method('POST')
                    <p class="text-lg font-semibold mb-4">New Category</p>
                    <x-auths.auth-validation-errors class="mb-4" :errors="$errors"></x-auths.auth-validation-errors>
                    <div class="mb-4">
                        <label for="name" class="font-medium text-gray-900 block mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Online tools" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="font-medium text-gray-900 block mb-2">Description</label>
                        <input type="text" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Best online tools on the market!" required>
                    </div>

                    <div class="mb-4">
                        <label for="photo" class="font-medium text-gray-900 block mb-2">Photo</label>
                        <input id="photo" type="file" name="photo" accept="image/*" required>
                        <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than 1MB</div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <button type="submit"
                            class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                            Save
                        </button>
                        <button type="button" onclick="closeCategoryModal()"
                            class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        @endif
        

        <div class="flex flex-wrap mb-2">
            @foreach ($categories as $category)
                <x-category-card :category="$category"></x-category-card>
            @endforeach
        </div>
        {{ $categories->links() }}
    </div>
@endsection
