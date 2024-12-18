<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'email',
        'name',
        'unit_type',
        'location',
        'min_price',
        'max_price',
        'status',
        'images',  
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
