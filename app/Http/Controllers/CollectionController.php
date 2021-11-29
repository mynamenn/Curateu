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
        $collections = Collection::with(['likes', 'comments'])->orderBy('created_at', 'desc')->paginate(6);

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

    public function store(Request $request) {
        $this->validateRequest($request);

        Collection::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'photo' => "https://via.placeholder.com/500x500.png/003344?text=ipsum",
        ]);
        
        return back()->withSuccess('Collection created');
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            // 'photo' => ['required', 'image'],
        ]);
    }

    public function update(Collection $collection, Request $request) {
        $this->validateRequest($request);

        $collection->update(['name' => $request->name, 'description' => $request->description]);
        
        return back()->withSuccess('Collection edited');
    }

    public function destroy(Collection $collection, Request $request) {
        $collection->delete();

        return back()->withSuccess('Collection deleted');
    }
}
