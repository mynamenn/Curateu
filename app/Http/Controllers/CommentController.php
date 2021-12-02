<?php

namespace App\Http\Controllers;

use App\Mail\CommentAdded;
use App\Models\Collection;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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

        Mail::to($collection->user)->send(new CommentAdded(auth()->user(), $collection));

        return back()->withSuccess('Comment added');
    }

    public function update(Comment $comment, Request $request)
    {
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
}
