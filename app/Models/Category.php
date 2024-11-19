<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',  // Allow mass assignment for name
        'description',  // Allow mass assignment for description
        'image',  // Allow mass assignment for description
    ];

  
}
