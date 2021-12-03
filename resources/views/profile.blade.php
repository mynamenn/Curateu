@extends('layouts.app')

@section('content')
<script>
    function collectionClick(route) {
            location.href = route;
        }

        function closeModal() {
            document.getElementById("collectionForm").style.display = "none";
        }

        function closeCollection(formId) {
            document.getElementById(formId).style.display = "none";
        }

        function showModal() {
            document.getElementById("collectionForm").style.display = "block";
        }

        function showProfileForm() {
            document.getElementById("profileForm").style.display = "block";
        }

        function showRoleForm() {
            document.getElementById("roleForm").style.display = "block";
        }
</script>

<div class="w-full bg-cover bg-center mb-4" style="height:28rem; background-image: url({{ $user->cover_picture }});">
    <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
        <div class="flex-column px-4 rounded-lg overflow-hidden align items-center justify-center text-center">

            <span class="relative inline-block">
                <img class="w-24 h-24 mb-4 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                    src={{ $user->profile_picture ? $user->profile_picture : url('/defaultUser.png') }}
                alt="user profile">
                {{-- Role tag --}}
                @if (AuthHelper::showRoleTag($user))
                <div
                    class="border-2 border-white px-2 py-1 rounded-full bg-green-500 absolute top-0 right-0 inline-flex items-center justify-center transform translate-x-1/2">
                    <p class="leading-relaxed text-xs text-white font-bold">{{ ucfirst($user->role->name) }}</p>
                </div>
                @endif

            </span>

            <h1 class="title-font text-3xl font-bold text-white md:text-4xl mr-2">
                {{ $user->name }}
            </h1>

            <h2 class="tracking-widest text-base title-font font-medium text-white mb-1 md:text-lg">
                {{ $user->headline }}
            </h2>

            <a class="block tracking-widest text-sm title-font font-bold text-white hover:text-blue-500 visited:text-purple-600 hover:underline mb-1 md:text-base"
                href="{{ '//' . $user->website }}" target="_blank">
                {{ $user->website }}
            </a>

            <h2 class="block tracking-widest text-sm title-font font-medium text-gray-200 md:text-base">
                {{ '@' }}{{ $user->username }}
            </h2>

            <div class="flex flex-row items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-md font-medium text-gray-200 md:text-base">
                    Joined {{ $user->created_at->format('M Y') }}
                </p>
            </div>

            @if (AuthHelper::canEditItself($user->id))
            <button onclick="showProfileForm()"
                class="inline-flex items-center text-sm text-white py-2 px-3 border-white border-2 rounded-md mt-2 hover:bg-gray-50 hover:text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-user mr-2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                EDIT PROFILE
            </button>
            @endif

            @if (AuthHelper::canEditRole($user))
            <button onclick="showRoleForm()"
                class="inline-flex items-center text-sm text-white py-2 px-3 border-white border-2 rounded-md mt-2 hover:bg-gray-50 hover:text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-tool mr-2">
                    <path
                        d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z">
                    </path>
                </svg>
                EDIT ROLE
            </button>
            @endif
        </div>
    </div>
</div>

{{-- Content --}}
<div class="sm:mx-8 mx-2">
    <x-banner class="mb-4"></x-banner>

    <x-forms.edit-profile-form :user="$user"></x-forms.edit-profile-form>

    <x-forms.edit-role-form :user="$user" :roles="$roles"></x-forms.edit-role-form>

    <div class="flex flex-row mb-4">
        <p class="mr-3 font-semibold text-2xl">{{ $collections->total() }}
            {{ Str::plural('Collection', $collections->total()) }}</p>

        @if (AuthHelper::canEditItself($user->id))
        <button type="button" onclick="showModal()"
            class="text-indigo-500 font-bold text-base hover:text-white border border-indigo-700 hover:bg-indigo-500 rounded-xl px-4 py-1 text-center">
            <span class="font-extrabold">+ </span>Add
        </button>
        @endif
    </div>

    @if (AuthHelper::canEditItself($user->id))
    {{-- New collection form --}}
    <form action="{{ route('collections.store') }}" method="post" enctype="multipart/form-data"
        class="p-4 border-2 mb-4 hidden border-gray-100" id="collectionForm">
        @csrf
        @method('POST')
        <p class="text-lg font-semibold mb-4">New Collection</p>
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
            <label for="photo" class="font-medium text-gray-900 block mb-2">Photo</label>
            <input id="photo" type="file" name="photo" accept="image/*" required>
            <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than 1MB</div>
        </div>

        <div class="flex flex-row-reverse">
            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                Save
            </button>
            <button type="button" onclick="closeModal()"
                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                Cancel
            </button>
        </div>
    </form>
    @endif

    @if ($collections->total() > 0)
    <div class="mb-6 border-2 border-gray-300 border-opacity-50 rounded-md">
        @foreach ($collections as $index => $collection)
        <div class="transition duration-500 ease-in-out hover:bg-gray-100 transform hover:-translate-y-1 flex px-4 py-5 sm:flex-row flex-row cursor-pointer {{ $collections->hasPages() == false && $index == $collections->total() - 1 ? '' : 'border-b border-gray-300' }}"
            onclick="collectionClick('{{ route('collections.show', ['collection' => $collection]) }}')">
            <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center bg-indigo-100 text-indigo-500 flex-shrink-0"
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
                        {{ ($collection->tags->count() > 1 and $index === 0) ? ' · ' : '' }}</p>
                    @endforeach
                </div>

            </div>

            <x-edit-delete-buttons :user="$user" :deletePath="route('collections.destroy', $collection)"
                :formId="'editCollection'.$collection->id">
            </x-edit-delete-buttons>

            <x-upvote-button :object="$collection" :actionPath="route('collections.likes', $collection->id)">
            </x-upvote-button>
        </div>

        @if (AuthHelper::canEditItself($user->id))
        <div id={{ 'editCollection' . $collection->id }} class="hidden">
            <hr class="border-t-2 border-gray-300 border-opacity-50" />
            {{-- Edit collection form --}}
            <form action="{{ route('collections.update', $collection) }}" method="post" enctype="multipart/form-data"
                class="p-4 border-gray-100">
                @method('PATCH')
                @csrf
                <p class="text-lg font-semibold mb-4">Edit Collection</p>
                <x-auth-validation-errors class="mb-4" :errors="$errors">
                </x-auth-validation-errors>
                <div class="mb-4">
                    <label for="name" class="font-medium text-gray-900 block mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ $collection->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Online tools" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="font-medium text-gray-900 block mb-2">Description</label>
                    <input type="text" name="description" id="description" value="{{ $collection->description }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Best online tools on the market!" required>
                </div>

                <div class="mb-4">
                    <label for="photo" class="font-medium text-gray-900 block mb-2">Photo</label>
                    @if ($collection)
                    <img class="w-20 h-20 mr-2 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                        src={{ $collection->photo }} alt="photo preview">
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
                    <button type="button" onclick="closeCollection('{{ 'editCollection' . $collection->id }}')"
                        class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        @endif
        @endforeach

        @if ($collections->hasPages())
        <div class="py-3 px-4">
            {{ $collections->links() }}
        </div>
        @endif
    </div>
    @else
    <p class="mt-5 font-medium text-lg">No collections found.</p>
    @endif
</div>
@endsection