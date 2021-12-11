<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\CollectionLiked;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CollectionLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Collection $collection, Request $request)
    {
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
            // Mail::to($collection->user)->queue(new CollectionLiked(auth()->user(), $collection));
            SendEmailJob::dispatch($collection->user, new CollectionLiked(auth()->user(), $collection));
        }

        return back();
    }

    public function destroy(Collection $collection, Request $request)
    {
        $collection->likes()->where('user_id', $request->user()->id)->delete();

        return back();
    }
}
