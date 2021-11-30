@props(['user'])

<script>
    function hideProfileForm() {
        document.getElementById("profileForm").style.display = "none";
    }
</script>

@if (AuthHelper::canMakeEdits($user->id))
    <form action="{{ route('user.update', $user->username) }}" method="post" enctype="multipart/form-data"
        class="p-4 border-2 mb-4 hidden border-gray-100" id="profileForm">
        @method('PATCH')
        @csrf
        <p class="text-lg font-semibold mb-4">Edit Profile</p>
        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
        <div class="mb-4">
            <label for="name" class="font-medium text-gray-900 block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John Madison" required>
        </div>

        <div class="mb-4">
            <label for="username" class="font-medium text-gray-900 block mb-2">Username</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="johnmad99" required>
        </div>

        <div class="mb-4">
            <label for="headline" class="font-medium text-gray-900 block mb-2">Headline</label>
            <input type="text" name="headline" id="headline" value="{{ $user->headline }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="I curate the best tools on Product Hunt!">
        </div>

        <div class="mb-4">
            <label for="website" class="font-medium text-gray-900 block mb-2">Website</label>
            <input type="text" name="website" id="website" value="{{ $user->website }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="https:://www.eklan.my">
        </div>

        <div class="mb-4">
            <label for="profile_picture" class="font-medium text-gray-900 block mb-2">Profile Picture</label>
            @if ($user->profile_picture)
                <img class="w-20 h-20 mr-2 inline-flex items-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                    src={{ $user->profile_picture }} alt="profile preview">
            @endif
            <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
            <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than 1MB</div>
        </div>

        <div class="mb-4">
            <label for="cover_picture" class="font-medium text-gray-900 block mb-2">Cover Picture</label>
            @if ($user->cover_picture)
                <img class="w-20 h-20 mr-2 inline-flex items-center bg-indigo-100 text-indigo-500 flex-shrink-0"
                    src={{ $user->cover_picture }} alt="cover preview">
            @endif
            <input id="cover_picture" type="file" name="cover_picture" accept="image/*">
            <div class="mt-1 text-sm text-gray-500" id="photo_help">Upload an image less than 1MB</div>
        </div>

        <div class="flex flex-row-reverse">
            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                Save
            </button>
            <button type="button" onclick="hideProfileForm()"
                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                Cancel
            </button>
        </div>
    </form>
@endif
