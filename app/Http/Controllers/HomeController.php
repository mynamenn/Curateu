<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Tag;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $categories = Tag::orderBy('created_at', 'desc')->take(4)->get();
        $collections = Collection::with(['likes', 'comments', 'tags'])->orderBy('created_at', 'desc')->inRandomOrder(Carbon::today()->toDateString())->take(8)->get();

        return view('home', [
            'categories' => $categories,
            'collections' => $collections,
        ]);
    }
}
