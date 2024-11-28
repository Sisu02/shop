<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
 	'name',
    'description',
    'type',
    'amount',
    'start_date',
    'end_date',
    ];
}
