<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {

    }

    public function show(Collection $collection)
    {
        $items = Item::with(['likes', 'comments'])->where('collection_id', $collection->id)->paginate(2);

        return view('collection-page', [
            'collection' => $collection,
            'items' => $items,
        ]);
    }
}
