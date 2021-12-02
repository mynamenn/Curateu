<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Checks if authorized user is authorized to make edits.
     */
    public static function canMakeEdits($userId)
    {
        return Auth::check() && Auth::user()->id == $userId;
    }

    public static function showRoleTag(User $user)
    {
        return in_array($user->role->name, ['admin', 'moderator']);
    }
}