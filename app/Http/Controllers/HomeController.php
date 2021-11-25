<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $categories = Tag::take(4)->get();
        $collections = Collection::with(['likes', 'comments', 'tags'])->inRandomOrder(Carbon::today()->toDateString())->take(8)->get();

        return view('home', [
            'categories' => $categories,
            'collections' => $collections,
        ]);
    }
}
