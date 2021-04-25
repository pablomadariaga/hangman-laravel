<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the words for the category.
     * obtener las palabras de la categoría
     */
    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
