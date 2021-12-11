<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\CommentAdded;
use App\Models\Collection;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['apiIndex']);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'body' => ['required', 'string'],
        ]);
    }

    public function store(Collection $collection, Request $request)
    {
        $this->validateRequest($request);

        Comment::create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
            'commentable_id' => $collection->id,
            'commentable_type' => Collection::class,
        ]);

        SendEmailJob::dispatch($collection->user, new CommentAdded(auth()->user(), $collection));

        return back()->withSuccess('Comment added');
    }

    public function update(Comment $comment, Request $request)
    {
        if ($comment->user->id != auth()->user()->id) {
            return back()->withError('Please edit your own comment');
        }

        $this->validateRequest($request);

        $comment->update([
            'body' => $request->body,
        ]);

        return back()->withSuccess('Comment updated');
    }

    public function destroy(Comment $comment, Request $request)
    {
        $comment->delete();

        return back()->withSuccess('Comment deleted');
    }

    // public function apiIndex(Request $request)
    // {
    //     $collectionId = $request->collectionId;

    //     $comments = Comment::with(['user'])->where('commentable_type', Collection::class)->where('commentable_id', $collectionId)->get();

    //     return response($comments);
    // }

    // public function apiStore(Request $request)
    // {
    //     // $this->validateRequest($request);
    //     $collectionId = $request->collectionId;
    //     $collection = Collection::find($collectionId);

    //     $comment = Comment::create([
    //         'user_id' => $request->user()->id,
    //         'body' => $request->body,
    //         'commentable_id' => $collection->id,
    //         'commentable_type' => Collection::class,
    //     ]);

    //     // Mail::to($collection->user)->send(new CommentAdded(auth()->user(), $collection));
    //     SendEmailJob::dispatch($collection->user, new CommentAdded(auth()->user(), $collection));

    //     return $comment;
    // }
}
