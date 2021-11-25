<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'body',
        'commentable_type',
        'commentable_id',
    ];

    public function commentable() {
        return $this->morphTo();
    }

    public function user($userId) {
        return User::find($userId);
    }
}
