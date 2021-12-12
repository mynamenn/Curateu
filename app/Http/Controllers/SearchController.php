<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Retrieves categories, collections and curators related to query.
     */
    public function show(Request $request)
    {
        $query = $request->query('query');

        $categories = Tag::where('name', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(3, ['*'], 'categories')->appends(request()->query());
        
        $collections = Collection::where('name', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(4, ['*'], 'collections')->appends(request()->query());

        $curators = User::where('name', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(4, ['*'], 'curators')->appends(request()->query());

        return view('results/search-results', [
            'categories' => $categories,
            'collections' => $collections,
            'curators' => $curators,
            'query' => $query,
        ]);
    }
}
