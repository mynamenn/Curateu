@props(['user' => $user, 'comments' => $comments])

<div class="flex w-full px-4 pt-4 pb-6 border-b-2 border-gray-300">
    <img class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full" src={{ $user->profile_picture }} />
    <div class="flex flex-row flex-grow ml-4">
        <textarea class="w-full p-3 bg-transparent border border-gray-500 rounded-sm" name="" id="" rows="1"
            placeholder="Write a comment..."></textarea>
        <button
            class="w-15 flex items-center h-8 px-3 py-4 text-base ml-2 rounded-sm font-semibold text-white bg-indigo-500 transition duration-200 ease-in-out hover:bg-indigo-600">
            Post
        </button>
    </div>
</div>

{{-- Comments --}}
@foreach ($comments as $comment)
    <div class="flex w-full py-8 px-4 border-b border-gray-300">
        <img class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full" src={{ $comment->user->profile_picture }} />
        <div class="flex flex-col flex-grow ml-4">
            <div class="flex cursor-pointer items-center"
                onclick="usernameClick('{{ route('user', ['username' => $comment->user->username]) }}')">
                <span class="font-semibold">{{ $comment->user->name }}</span>
                <span
                    class="ml-1 text-xs text-gray-600 cursor-pointer transition duration-200 ease-in-out hover:text-indigo-600 hover:underline">
                    {{ '@' }}{{ $comment->user->username }}
                </span>
            </div>
            <p class="mt-1">{{ $comment->body }}</p>
            <div class="flex mt-2 text-gray-500">
                <span class="text-sm">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
@endforeach
<div class="m-4">
    {{ $comments->links() }}
</div>
