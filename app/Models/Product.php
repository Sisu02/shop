<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'price',
        'stock',
        'description',
        'fimage',
        'gimage',
    ];
    public function category() { return $this->belongsTo(Category::class);
    }
}
