<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    protected $fillable = [

        'phone',
        'user_id',
        'credit',
        'stripe_customer_id',
        'pin',
    ];
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with the Restaurant model
    public function restaurant()
    {
        return $this->hasMany(Restaurant::class);
    }

    /** @use HasFactory<\Database\Factories\OwnerFactory> */
    use HasFactory;
}
