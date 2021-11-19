<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {

    }

    public function show(Collection $collection)
    {
        $items = Item::with(['likes', 'comments'])->where('collection_id', $collection->id)->paginate(5, ['*'], 'items');

        $comments = $collection->comments()->paginate(5, ['*'], 'comments');

        return view('collection-page', [
            'collection' => $collection,
            'items' => $items,
            'comments' => $comments,
        ]);
    }
}
