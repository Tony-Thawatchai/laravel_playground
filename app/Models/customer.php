<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
    ];

    public function User ()
    {
        return $this->belongsTo(User::class);
    }

    // one customer can become membership to multiple restaurants
    public function Membership()
    {
        return $this->hasMany(Membership::class);
    }

    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
}
