<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function scopeGetByCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }
}
