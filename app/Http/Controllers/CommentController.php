<?php

namespace App\Http\Controllers;

use App\Mail\CommentAdded;
use App\Models\Collection;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function store(Collection $collection, Request $request) {
        Comment::create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
            'commentable_id' => $collection->id,
            'commentable_type' => Collection::class,
        ]);

        Mail::to($collection->user)->send(new CommentAdded(auth()->user(), $collection));
        
        return back();
    }
}
