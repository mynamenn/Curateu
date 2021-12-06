<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col lg:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 lg:mb-0" href="/">
            <img src="{{ asset('img/curateu.png') }}" alt="logo" class="h-8 w-32">
        </a>
        <input type="text" 
            class="lg:ml-4 lg:py-1 lg:pl-4 lg:mb-0 mb-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-0 pl-3 p-2"
            placeholder="Search...">
        <div class="lg:ml-auto ml-0 flex flex-wrap items-center text-base justify-center">
            @if (Auth::check())
                <a class="mr-5 hover:text-gray-900 hover:font-bold" href="/{{'@'}}{{Auth::user()->username}}">Profile</a>
            @endif
            
            <a class="mr-5 hover:text-indigo-500 focus:text-indigo-500 focus:font-bold" href="/categories">Categories</a>
            <a class="mr-5 hover:text-indigo-500 focus:text-indigo-500 focus:font-bold" href="/collections">Collections</a>
            <a class="mr-5 hover:text-indigo-500 focus:text-indigo-500 focus:font-bold" href="/curators">Curators</a>

            @if (Auth::check())
                <form action="{{ route('logout') }}" method="post" class="mb-0">
                    @csrf
                    <button type="submit" class="lg:mr-5 mr-0 hover:font-bold hover:text-indigo-500 focus:text-indigo-500">
                        Logout
                    </button>
                </form>
            @else
                <a class="lg:mr-5 mr-0 hover:text-indigo-500 focus:text-indigo-500" href="/login">Login</a>
            @endif
        </div>
    </div>
    <hr class="border-t-2 border-gray-300 border-opacity-50" />
</header>
