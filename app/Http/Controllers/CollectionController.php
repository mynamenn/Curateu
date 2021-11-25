<?php

namespace App\Http\Controllers;

use App\Mail\CollectionLiked;
use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CollectionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])->except('index', 'show');
    }

    public function index()
    {
        $collections = Collection::with(['likes', 'comments'])->orderBy('created_at', 'desc')->paginate(5);

        return view('results/collection-results', [
            'collections' => $collections,
        ]);
    }

    public function show(Collection $collection)
    {
        $items = Item::with(['likes', 'comments'])->where('collection_id', $collection->id)->paginate(5, ['*'], 'items');

        $comments = $collection->comments()->orderBy('created_at', 'desc')->paginate(5, ['*'], 'comments');

        return view('collection', [
            'collection' => $collection,
            'items' => $items,
            'comments' => $comments,
        ]);
    }

    public function store(Collection $collection, Request $request) {
        if ($collection->likedBy()) {
            return response(null, 409);
        }

        $collection->likes()->create([
            'user_id' => $request->user()->id,
            'likeable_type' => Collection::class,
            'likeable_id' => $collection->id,
        ]);

        // Only send notification if user liked collection for the first time
        if (!$collection->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($collection->user)->send(new CollectionLiked(auth()->user(), $collection));
        }

        return back();
    }

    public function destroy(Collection $collection, Request $request) {
        $collection->likes()->where('user_id', $request->user()->id)->delete();

        return back();
    }
}
