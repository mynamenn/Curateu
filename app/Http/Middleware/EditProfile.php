<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfile
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
        $user = User::where('username', $request->route('username'))->firstOrFail();
        if (!(Auth::check() && Auth::user()->id == $user->id)) {
            return back()->withErrors("Invalid access");
        }
        return $next($request);
    }
}
