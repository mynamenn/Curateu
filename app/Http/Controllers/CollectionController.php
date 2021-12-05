<?php

namespace App\Http\Controllers;

use App\Mail\CollectionLiked;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Tag;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'handleCollection'])->except('index', 'show');
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
        $items = Item::with(['likes', 'comments', 'collection'])->where('collection_id', $collection->id)->paginate(5, ['*'], 'items');

        $comments = $collection->comments()->orderBy('created_at', 'desc')->paginate(5, ['*'], 'comments');

        $tags = Tag::get();

        return view('collection', [
            'collection' => $collection,
            'items' => $items,
            'comments' => $comments,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request, ImageService $imageService) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit(Null, $request->photo);

        Collection::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photo,
        ]);
        
        return back()->withSuccess('Collection created');
    }

    public function update(Collection $collection, Request $request, ImageService $imageService) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit($collection->photo, $request->photo);

        $collection->update([
            'name' => $request->name, 
            'description' => $request->description,
            'photo' => $photo,
        ]);
        
        return back()->withSuccess('Collection edited');
    }

    public function destroy(Collection $collection, ImageService $imageService) {
        $collection->delete();

        $imageService->delete($collection->photo);

        return back()->withSuccess('Collection deleted');
    }

    public function updateTags(Collection $collection, Request $request) {
        $collection->tags()->sync($request->selectedTags);

        return back()->withSuccess('Tags updated');
    }
}
