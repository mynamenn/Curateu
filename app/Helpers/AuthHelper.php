<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Checks if authorized user is authorized to make edits.
     */
    public static function canMakeEdits($userId)
    {
        return Auth::check() && Auth::user()->isCurator() && Auth::user()->id == $userId;
    }
}