<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\ImageService;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'editProfile'])->except('index', 'show');
        $this->middleware(['editRole'])->only('updateRole');
    }

    public function index()
    {
        $curators = User::with(['role'])->paginate(6);

        return view('results.curator-results', [
            'curators' => $curators,
        ]);
    }

    public function show($username)
    {
        $user = User::with(['collections', 'role'])->where('username', $username)->firstOrFail();

        $collections = $user->collections()->orderBy('created_at', 'desc')->paginate(5);

        $roles = Role::get();

        return view('profile', [
            'user' => $user,
            'collections' => $collections,
            'roles' => $roles,
        ]);
    }

    private function validateRequest(Request $request, User $user) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'headline' => ['string', 'max:255', 'nullable'],
            'website' => ['string', 'max:255', 'nullable'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'profile_picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'cover_picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
    }

    public function update($username, Request $request, ImageService $imageService) {
        $user = User::with(['collections', 'role'])->where('username', $username)->firstOrFail();

        $this->validateRequest($request, $user);

        $profilePicture = $imageService->edit($user->profile_picture, $request->profile_picture);
        $coverPicture = $imageService->edit($user->cover_picture, $request->cover_picture);

        $user->update([
            'name' => $request->name, 
            'username' => $request->username, 
            'headline' => $request->headline, 
            'website' => $request->website,
            'profile_picture' => $profilePicture,
            'cover_picture' => $coverPicture,
        ]);

        return redirect('/@'.$request->username)->withSuccess('Profile edited');
    }

    public function updateRole(User $user, Request $request) {
        $user->update([
            'role_id' => $request->role,
        ]);
        
        return back()->withSuccess('Role edited');
    }
}
