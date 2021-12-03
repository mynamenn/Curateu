<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Checks if authorized user is authorized to edit its own stuffs.
     */
    public static function canEditItself($userId)
    {
        return Auth::check() && Auth::user()->id == $userId;
    }

    /**
     * Show role tag if user on page is either admin or moderator.
     */
    public static function showRoleTag(User $user)
    {
        return in_array($user->role->name, ['admin', 'moderator']);
    }

    /**
     * Checks if authorized user is either admin or moderator.
     */
    public static function canHandleCategory()
    {
        return Auth::check() && in_array(Auth::user()->role->name, ['admin', 'moderator']);
    }

    /**
     * Checks if authorized user is admin and user on page is not admin.
     * Note: Admin cannot change role of another admin and their own role.
     */
    public static function canEditRole(User $currUser)
    {
        return Auth::check() && Auth::user()->role->name == 'admin' && $currUser->role->name != 'admin';
    }
}