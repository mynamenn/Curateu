<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col lg:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 lg:mb-0" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span class="ml-3 text-xl">Curatorial</span>
        </a>
        <input type="text" 
            class="lg:ml-4 lg:py-1 lg:pl-4 lg:mb-0 mb-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-0 pl-3 p-2"
            placeholder="Search...">
        <div class="lg:ml-auto ml-0 flex flex-wrap items-center text-base justify-center">
            @if (Auth::check())
                <a class="mr-5 hover:text-gray-900 hover:font-bold" href="/{{'@'}}{{Auth::user()->username}}">Profile</a>
            @endif
            
            <a class="mr-5 hover:text-gray-900 hover:font-bold" href="/categories">Categories</a>
            <a class="mr-5 hover:text-gray-900 hover:font-bold" href="/collections">Collections</a>
            <a class="mr-5 hover:text-gray-900 hover:font-bold" href="/curators">Curators</a>

            @if (Auth::check())
                <form action="{{ route('logout') }}" method="post" class="mb-0">
                    @csrf
                    <button type="submit" class="lg:mr-5 mr-0 hover:text-gray-900 hover:font-bold">
                        Logout
                    </button>
                </form>
            @else
                <a class="lg:mr-5 mr-0 hover:text-gray-900 hover:font-bold" href="/login">Login</a>
            @endif
        </div>
    </div>
    <hr class="border-t-2 border-gray-300 border-opacity-50" />
</header>
