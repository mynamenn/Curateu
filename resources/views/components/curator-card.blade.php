@props(['curator'])

<button class="p-2 text-left lg:w-1/2 w-full" onclick="usernameClick('{{ route('user.show', ['username' => $curator->username]) }}')">
    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-4 sm:flex-row flex-row cursor-pointer transform hover:-translate-y-1 transition duration-500 ease-in-out">
        <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
            src={{ $curator->profile_picture ? $curator->profile_picture : url('/img/defaultUser.png') }} alt="content">
        <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-semibold">{{ $curator->name }}</h2>
            <p class="leading-relaxed text-base">
                {{ $curator->headline }}
            </p>
            <p class="leading-relaxed text-base text-gray-600">
                {{ '@' }}{{ $curator->username }}
            </p>
        </div>
    </div>
</button>