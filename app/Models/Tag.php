<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function collections() {
        return $this->belongsToMany(Collection::class)->withTimestamps();
    }
}
