<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
      
        'name',
        'address',
        'zip_code',
        'food_type',
        'average_bill_amount',
        'owner_id',

    ];
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;
}
