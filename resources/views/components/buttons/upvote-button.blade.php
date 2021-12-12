@props(['object', 'actionPath'])

<script>
    function upvoteClick(e) {
        e.stopPropagation();
    }
</script>

@if (!auth()->user() || !$object->likedBy(auth()->user()))
    <form action="{{ $actionPath }}" method="post">
        @csrf
        <button type="submit"
            class="flex flex-col border-2 border-gray-200 p-3 ml-1 rounded-md text-center items-center transition duration-500 ease-in-out hover:bg-indigo-100"
            onclick="upvoteClick(event)">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                stroke="#4B587C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-chevron-up">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
            <p class="leading-relaxed">{{ $object->likes->count() }}</p>
        </button>
    </form>
@else
    <form action="{{ $actionPath }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="flex flex-col border-2 border-indigo-500 p-3 ml-1 rounded-md text-center items-center transition duration-500 ease-in-out hover:bg-indigo-100"
            onclick="upvoteClick(event)">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                stroke="#4B587C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-chevron-up">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
            <p class="leading-relaxed font-bold">{{ $object->likes->count() }}</p>
        </button>
    </form>
@endif
