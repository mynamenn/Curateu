<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function user() {
        return $this->hasOneThrough(Collection::class, User::class);
    }
    
    public function likes() {
        return $this->morphMany('App\Like', 'likeable');
    }
    
    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
    
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }
    
    public function commentedBy(User $user) {
        return $this->comments->contains('user_id', $user->id);
    }
}
