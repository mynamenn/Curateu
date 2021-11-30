@extends('layouts.app')

@section('content')
    <script>
        function usernameClick(route) {
            location.href = route;
        }

        function redirectToLink(link) {
            window.open("//" + link);
        }

        function showItemForm() {
            document.getElementById("itemForm").style.display = "block";
        }

        function closeItemForm() {
            document.getElementById("itemForm").style.display = "none";
        }

        function closeSpecificItem(formId) {
            document.getElementById(formId).style.display = "none";
        }

        function openSpecificItem(formId) {
            document.getElementById(formId).style.display = "block";
        }
    </script>

    <div class="flex-column pt-10 pb-6 px-4 rounded-lg overflow-hidden align items-center justify-center text-center">
        <img class="w-24 h-24 mb-4 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
            src={{ $collection->photo }} alt="content">

        <h1 class="title-font text-2xl font-semibold text-gray-900 mb-1">
            {{ $collection->name }}
        </h1>
        <h2 class="tracking-widest text-base title-font font-medium text-gray-500 mb-1">{{ $collection->description }}
        </h2>
        <h2 onclick="usernameClick('{{ route('user.show', ['username' => $collection->user->username]) }}')"
            class="block tracking-widest text-base title-font font-medium text-gray-500 mb-4 cursor-pointer transition duration-200 ease-in-out hover:text-indigo-600 hover:underline">
            {{ '@' }}{{ $collection->user->username }}
        </h2>

        {{-- Tags --}}
        @if ($collection->tags->count() > 0)
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
        @endif

        {{-- Upvote --}}
        @if (!auth()->user() || !$collection->likedBy(auth()->user()))
            <form action="{{ route('collections.likes', $collection->id) }}" method="post">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center bg-indigo-500 px-8 py-3 rounded-md m-auto transition duration-200 ease-in-out hover:bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-up mr-1">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                    <p class="text-sm font-semibold text-white mr-2">UPVOTE</p>
                    <p class="text-sm font-extrabold text-white">{{ $collection->likes->count() }}</p>
                </button>
            </form>
        @else
            <form action="{{ route('collections.likes', $collection->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center justify-center border-2 border-indigo-500 bg-white px-8 py-3 rounded-md m-auto transition duration-200 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#3F51B5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-up mr-1">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                    <p class="text-sm font-semibold text-indigo-500 mr-2">UPVOTED</p>
                    <p class="text-sm font-extrabold text-indigo-500">{{ $collection->likes->count() }}</p>
                </button>
            </form>
        @endif
    </div>

    {{-- Content --}}
    <div class="sm:mx-8 mx-2">
        <x-banner class="mb-4"></x-banner>
        <div class="flex flex-row mb-4">
            <p class="mr-3 font-semibold text-2xl">{{ $items->total() }}
                {{ Str::plural('Item', $items->total()) }}</p>

            @if (AuthHelper::canMakeEdits($collection->user->id))
                <button type="button" onclick="showItemForm()"
                    class="text-indigo-500 font-bold text-base hover:text-white border border-indigo-700 hover:bg-indigo-500 rounded-xl px-4 py-1 text-center">
                    <span class="font-extrabold">+ </span>Add
                </button>
            @endif
        </div>

        @if (AuthHelper::canMakeEdits($collection->user->id))
            {{-- New item form --}}
            <form action="{{ route('items.store', $collection) }}" method="post" enctype="multipart/form-data"
                class="p-4 border-2 mb-4 hidden border-gray-100" id="itemForm">
                @csrf
                @method('POST')
                <p class="text-lg font-semibold mb-4">New Item</p>
                <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
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
                    <label for="link" class="font-medium text-gray-900 block mb-2">Link</label>
                    <input type="text" name="link" id="link"
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
                    <button type="button" onclick="closeItemForm()"
                        class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                        Cancel
                    </button>
                </div>
            </form>
        @endif

        @if ($items->total() > 0)
            <div class="mt-4 mb-6 border-2 border-gray-300 border-opacity-50 rounded-md">
                @foreach ($items as $index => $item)
                    <div class="transition duration-500 ease-in-out hover:bg-gray-100 transform hover:-translate-y-1 flex px-4 py-5 sm:flex-row flex-row cursor-pointer"
                        onclick="redirectToLink('{{ $item->link }}')">
                        <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center bg-indigo-100 text-indigo-500 flex-shrink-0"
                            src={{ $item->photo }} alt="content">
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium">{{ $item->name }}</h2>
                            <p class="leading-relaxed text-base mb-1">
                                {{ $item->description }}
                            </p>
                            <div class="flex flex-row items-center">
                                <p class="mr-3 text-gray-500">Posted {{ $item->created_at->diffForHumans() }}</p>
                            </div>

                        </div>
                        <x-edit-delete-buttons :user="$collection->user" :deletePath="route('items.destroy', $item)"
                            :formId="'editItem'.$item->id">
                        </x-edit-delete-buttons>
                        <x-upvote-button :object="$item" :actionPath="route('items.likes', $item->id)"></x-upvote-button>
                    </div>

                    @if (AuthHelper::canMakeEdits($collection->user->id))
                        <div id={{ 'editItem' . $item->id }} class="hidden">
                            <hr class="border-t-2 border-gray-300 border-opacity-50" />
                            {{-- Edit item form --}}
                            <form action="{{ route('items.update', $item) }}" method="post" enctype="multipart/form-data"
                                class="p-4 border-gray-100">
                                @method('PATCH')
                                @csrf
                                <p class="text-lg font-semibold mb-4">Edit Item</p>
                                <x-auth-validation-errors class="mb-4" :errors="$errors">
                                </x-auth-validation-errors>
                                <div class="mb-4">
                                    <label for="name" class="font-medium text-gray-900 block mb-2">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $item->name }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Online tools" required>
                                </div>

                                <div class="mb-4">
                                    <label for="description"
                                        class="font-medium text-gray-900 block mb-2">Description</label>
                                    <input type="text" name="description" id="description"
                                        value="{{ $item->description }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Best online tools on the market!" required>
                                </div>

                                <div class="mb-4">
                                    <label for="link" class="font-medium text-gray-900 block mb-2">Link</label>
                                    <input type="text" name="link" id="link" value="{{ $item->link }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Best online tools on the market!" required>
                                </div>

                                <div class="mb-4">
                                    <label for="photo" class="font-medium text-gray-900 block mb-2">Photo</label>
                                    @if ($item)
                                        <img class="w-20 h-20 mr-2 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                                            src={{ $item->photo }} alt="photo preview">
                                    @endif
                                    <input id="photo" type="file" name="photo" accept="image/*">
                                    <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than
                                        1MB</div>
                                </div>

                                <div class="flex flex-row-reverse">
                                    <button type="submit"
                                        class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                                        Save
                                    </button>
                                    <button type="button" onclick="closeSpecificItem('{{ 'editItem' . $item->id }}')"
                                        class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    {{-- If no pages and is at last element, don't show hr --}}
                    @if ($items->hasPages() == false && $index == $items->count() - 1)
                        {{-- Do nothing --}}
                    @else
                        <hr class="border-t-2 border-gray-300 border-opacity-50" />
                    @endif
                @endforeach

                @if ($items->hasPages())
                    <div class="py-3 px-4">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        @else
            <p class="mt-5 mb-6 font-medium text-lg">No items found.</p>
        @endif

        <x-comments :user="$collection->user" :comments="$comments" :collection="$collection"></x-comments>
    </div>
@endsection
