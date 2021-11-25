<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])->except('index', 'show');
    }

    public function index()
    {
        $categories = Tag::orderBy('created_at', 'desc')->paginate(5);

        return view('results.category-results', [
            'categories' => $categories,
        ]);
    }

    public function show($categoryName)
    {
        $categoryName = str_replace('-', ' ', $categoryName);

        $category = Tag::where('name', $categoryName)->first();

        $collections = $category->collections()->orderBy('created_at', 'desc')->paginate(5);

        return view('category', [
            'category' => $category,
            'collections' => $collections,
        ]);
    }
}
