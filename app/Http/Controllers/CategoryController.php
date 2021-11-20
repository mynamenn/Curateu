<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

    }

    public function show($categoryName)
    {
        $categoryName = str_replace('-', ' ', $categoryName);

        $category = Tag::where('name', $categoryName)->first();

        $collections = $category->collections()->orderBy('created_at', 'desc')->paginate(2);

        return view('category', [
            'category' => $category,
            'collections' => $collections,
        ]);
    }
}
