<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'username',
        'headline',
        'website',
        'profile_picture',
        'cover_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function collections() {
        return $this->hasMany(Collection::class);
    }
    
    public function items() {
        return $this->hasManyThrough(Item::class, Collection::class);
    }
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    public function followers() {
        return $this->hasMany(Follower::class);
    }

    public function isCurator() {
        return $this->role->name == "curator";
    }

    public function isModerator() {
        return $this->role->name == "moderator";
    }

    public function isAdmin() {
        return $this->role->name == "admin";
    }
}
