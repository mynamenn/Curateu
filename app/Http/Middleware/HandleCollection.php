<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleCollection
{
    /**
     * Checks if authorized user is authorized to edit its own collection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->user()->id;
        // Get user's collection id when authorized user tries to edit or delete a collection
        if ($request->route('collection')) {
            $userId = $request->route('collection')->user->id;
        }
        
        if (!(Auth::check() && Auth::user()->id == $userId)) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
