<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditRole
{
    /**
     * Checks if authorized user is admin and user on page is not admin.
     * Note: Admin cannot change role of another admin and their own role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currUser = $request->route('user');
        if (!(Auth::check() && Auth::user()->role->name == 'admin' && $currUser->role->name != 'admin')) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
