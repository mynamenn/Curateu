<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Item;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function store(Collection $collection,Request $request, ImageService $imageService) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'link' => ['string', 'max:255', 'nullable'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit(Null, $request->photo);

        Item::create([
            'collection_id' => $collection->id,
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'photo' => $photo,
        ]);
        
        return back()->withSuccess('Item created');
    }

    public function update(Item $item, Request $request, ImageService $imageService) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'link' => ['string', 'max:255', 'nullable'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit($item->photo, $request->photo);

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'photo' => $photo,
        ]);
        
        return back()->withSuccess('Item edited');
    }

    public function destroy(Item $item, ImageService $imageService) {
        $item->delete();

        $imageService->delete($item->photo);

        return back()->withSuccess('Item deleted');
    }
}
