<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleItem
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
        $userId = '';
        // Get user's item id when authorized user tries to edit or delete a item else, get collection id.
        if ($request->route('collection')) {
            $userId = $request->route('collection')->user->id;
        } else if ($request->route('item')) {
            $userId = $request->route('item')->itemOwner->id;
        }
        
        if (!(Auth::check() && Auth::user()->id == $userId)) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
