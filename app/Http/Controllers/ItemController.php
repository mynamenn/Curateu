<?php

namespace App\Http\Controllers;

use App\Mail\ItemLiked;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ItemController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function store(Item $item, Request $request) {
        if ($item->likedBy()) {
            return response(null, 409);
        }

        $item->likes()->create([
            'user_id' => $request->user()->id,
            'likeable_type' => Item::class,
            'likeable_id' => $item->id,
        ]);
        // dd($item->collection->user);
        // Only send notification if user liked item for the first time
        if (!$item->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($item->collection->user)->send(new ItemLiked(auth()->user(), $item));
        }

        return back();
    }

    public function destroy(Item $item, Request $request) {
        $item->likes()->where('user_id', $request->user()->id)->delete();

        return back();
    }
}
