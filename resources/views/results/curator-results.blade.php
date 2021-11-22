@extends('layouts.app')

<script>
    function usernameClick(route) {
        location.href = route;
    }
</script>

@section('content')
    <div class="container px-5 pt-10 pb-5 mx-auto">
        <div class="flex flex-wrap w-full mb-4 flex-col items-center text-center">
            <h1 class="sm:text-4xl text-3xl font-semibold title-font mb-2 text-gray-900">
                All Curators
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500 text-lg">
                {{ $curators->total() }} Results
            </p>
        </div>
        <div class="flex flex-wrap mb-2">
            @foreach ($curators as $curator)
                <div class="p-2 lg:w-1/2 w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-4 sm:flex-row flex-row cursor-pointer transform hover:-translate-y-1 transition duration-500 ease-in-out"
                        onclick="usernameClick('{{ route('user.show', ['username' => $curator->username]) }}')">
                        <img class="sm:mb-0 sm:w-20 sm:h-20 w-16 h-16 mr-8 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                            src={{ $curator->profile_picture }} alt="content">
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
                </div>
            @endforeach
        </div>
        {{ $curators->links() }}
    </div>
@endsection
