<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    // Add all necessary fields to the $fillable array
    protected $fillable = ['user_id', 'address', 'phone', 'city', 'pincode', 'country'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
