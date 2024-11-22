<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'category_id',  // Allow mass assignment for name
        'name',  // Allow mass assignment for description
        'description',  // Allow mass assignment for description
        'image',  // Allow mass assignment for description
    ];
    public function category() { return $this->belongsTo(Category::class);
    }
}
