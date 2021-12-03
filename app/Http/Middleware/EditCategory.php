<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditCategory
{
    /**
     * Checks if authorized user is either admin or moderator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!(Auth::check() && in_array(Auth::user()->role->name, ['admin', 'moderator']))) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
