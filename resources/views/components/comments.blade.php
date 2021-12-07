@props(['user', 'comments', 'collection'])

<script>
    function showCommentForm(formId) {
        document.getElementById(formId).style.display = "block";
    }

    function hideCommentForm(formId) {
        document.getElementById(formId).style.display = "none";
    }

    // window.onload = function() {
    //     new Vue({
    //         el: "#testVue",
    //         data: {
    //             comments: [],
    //             newComment: "Testing123",
    //         },
    //         mounted: function() {
    //             id = document.getElementById("testVue").getAttribute("data-id");
    //             axios.post("/comments/apiIndex", {
    //                     collectionId: id
    //                 })
    //                 .then(response => {
    //                     this.comments = response.data;
    //                 })
    //                 .catch(response => {
    //                     console.log(response);
    //                 })
    //         },
    //         methods: {
    //             createComment: function(event) {
    //                 collectionId = event.target.getAttribute("data-id");

    //                 axios.post("/comments/apiStore", {
    //                         collectionId: collectionId,
    //                         body: this.newComment,
    //                     })
    //                     .then(response => {
    //                         this.comments.push(response.data);
    //                         this.newComment = "";
    //                     })
    //                     .catch(response => {
    //                         console.log(response);
    //                     })
    //             },
    //             hideCommentForm: function(formId) {
    //                 console.log(formId);
    //                 document.getElementById(formId).style.display = "none"
    //             }
    //         }
    //     });
    // }
</script>

<p class="text-lg text-gray-600 font-semibold">Comments</p>

<div class="my-4 border-2 border-gray-300 border-opacity-50 rounded-md">
    <div class="flex w-full px-4 py-6 border-b-2 border-gray-300">
        <img class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"
            src={{Auth::check() && Auth::user()->profile_picture ? Auth::user()->profile_picture : url('/img/defaultUser.png') }}
            alt="profile picture" />
        <form action="{{ route('comments.store', $collection) }}" method="post" class="flex flex-row flex-grow ml-4">
            @csrf
            <textarea class="w-full p-3 bg-transparent border border-gray-500 rounded-sm" name="body" id="" rows="1"
                placeholder="Write a comment..." required></textarea>

            <button
                class="w-15 flex items-center h-8 px-3 py-4 text-base ml-2 rounded-sm font-semibold text-white bg-indigo-500 transition duration-200 ease-in-out hover:bg-indigo-600">
                Post
            </button>
        </form>
    </div>

    <div id="testVue" data-id="{{ $collection->id }}">
        <h1>@{{ newComment }}</h1>
        <input name="body" type="text" id="input" v-model="newComment">
        <button data-id="{{ $collection->id }}" @click="createComment">Post</button>

        {{-- <div v-for="(comment, index) in comments"> --}}
            {{-- <div class="flex w-full py-8 px-4 border-b border-gray-300">
                <img class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full" :src="comment.user.profile_picture" />
            
                <div class="flex flex-col flex-grow ml-4"
                    onclick="usernameClick('{{ route('user.show', ['username' => $comment->user->username]) }}')"
                >
                    <span class="font-semibold">@{{ comment.user.name }}</span>
                    <span
                        class="ml-1 text-xs text-gray-600 cursor-pointer transition duration-200 ease-in-out hover:text-indigo-600 hover:underline">
                        {{ '@' }}@{{ comment.user.username }}
                    </span>
                </div>
                <p class="mt-1">@{{ comment.body }}</p>
                <div class="flex mt-2 text-gray-500">
                    <span class="text-sm">@{{ comment.created_at.diffForHumans() }}</span>
                </div> --}}
                {{-- <x-edit-delete-buttons :user="comment.user" :deletePath="route('comments.destroy', comment)"  :formId="'editComment' + comment.id"> --}}
                {{-- </x-edit-delete-buttons> --}}

                {{-- @if (AuthHelper::canEditItself('comment.user_id'))
                    <form action="{{ route("comments.update", comment) }}" method="post" enctype="multipart/form-data"
                    class="p-4 mb-2 border-b-2" :id="'editComment' + comment.id">
                        @method('PATCH')
                        @csrf
                        <p class="text-lg font-semibold mb-4">Edit Comment</p>
                
                        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
                        <div class="mb-4">
                            <textarea class="w-full p-3 bg-transparent border border-gray-500 rounded-sm" name="body" id="" rows="1"
                                placeholder="Write a comment..." required>@{{ comment.body }}</textarea>
                        </div>
                
                        <div class="flex flex-row-reverse">
                            <button type="submit"
                                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                                Save
                            </button>
                            <button type="button" @click="hideCommentForm('editComment' + comment.id)"
                                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                                Cancel
                            </button>
                        </div>
                    </form>
                @endif --}}
            {{-- </div>
        </div>
    </div> --}}
    
    @foreach ($comments as $index => $comment)
    <div class="flex w-full py-8 px-4 {{ $comments->hasPages() == False && $index == $comments->total() - 1 ?  : "
        border-b border-gray-300" }}" tabindex="0">
        <img class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full" src={{$comment->user->profile_picture }} />
        <div class="flex flex-col flex-grow ml-4">
            <div class="flex cursor-pointer items-center" tabindex="0"
                onclick="usernameClick('{{ route('user.show', ['username' => $comment->user->username]) }}')">
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
        <x-edit-delete-buttons :user="$comment->user" :deletePath="route('comments.destroy', $comment)"
            :formId="'editComment'.$comment->id">
        </x-edit-delete-buttons>
    </div>

    {{-- Edit comment form --}}
    @if (AuthHelper::canEditItself($comment->user_id))
    <form action="{{ route('comments.update', $comment) }}" method="post" enctype="multipart/form-data"
        class="hidden p-4 mb-2 border-b-2" id={{ "editComment" .$comment->id }}>
        @method('PATCH')
        @csrf
        <p class="text-lg font-semibold mb-4">Edit Comment</p>

        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
        <div class="mb-4">
            <textarea class="w-full p-3 bg-transparent border border-gray-500 rounded-sm" name="body" id="" rows="1"
                placeholder="Write a comment..." required>{{ $comment->body }}</textarea>
        </div>

        <div class="flex flex-row-reverse">
            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                Save
            </button>
            <button type="button" onclick="hideCommentForm('{{ 'editComment' . $comment->id }}')"
                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                Cancel
            </button>
        </div>
    </form>
    @endif

    @endforeach

    @if ($comments->hasPages())
    <div class="py-3 px-4">
        {{ $comments->links() }}
    </div>
    @endif
</div>