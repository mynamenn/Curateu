<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $categories = DB::table('tags')->take(6)->get();
        $curations = DB::table('collections')->inRandomOrder()->take(8)->get();

        return view('home', [
            'categories' => $categories,
            'curations' => $curations,
        ]);
    }
}
