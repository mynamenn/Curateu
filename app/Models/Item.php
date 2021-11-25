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

    public function itemOwner() {
        return $this->collection->user();
    }
    
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likedBy() {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}
