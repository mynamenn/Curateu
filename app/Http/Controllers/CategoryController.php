<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\ImageService;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'show');
        $this->middleware(['editCategory'])->only('update', 'destroy');
    }

    public function index()
    {
        $categories = Tag::orderBy('created_at', 'desc')->paginate(6);

        return view('results.category-results', [
            'categories' => $categories,
        ]);
    }

    public function show($categoryName)
    {
        $categoryName = str_replace('-', ' ', $categoryName);

        $category = Tag::where('name', $categoryName)->firstOrFail();

        $collections = $category->collections()->orderBy('created_at', 'desc')->paginate(5);

        return view('category', [
            'category' => $category,
            'collections' => $collections,
        ]);
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags'],
            'description' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit(Null, $request->photo);

        Tag::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photo,
        ]);

        return back()->withSuccess('Category created');
    }

    public function update(Tag $tag, Request $request, ImageService $imageService)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('tags')->ignore($tag)],
            'description' => ['required', 'string', 'max:255'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $imageService->edit($tag->photo, $request->photo);

        $tag->update([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photo,
        ]);

        return redirect('/categories/' . $request->name)->withSuccess('Category edited');
    }

    public function destroy(Tag $tag, ImageService $imageService)
    {
        $tag->delete();

        $imageService->delete($tag->photo);

        return redirect('/categories')->withSuccess('Tag deleted');
    }
}
