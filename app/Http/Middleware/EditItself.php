<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditItself
{
    /**
     * Checks if authorized user is authorized to edit its own stuffs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->route('user')->id;
        if (!(Auth::check() && Auth::user()->id == $userId)) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
