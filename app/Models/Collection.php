<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function items() {
        return $this->hasMany(Item::class);
    }
    
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function tags() {
          return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function likedBy() {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}
