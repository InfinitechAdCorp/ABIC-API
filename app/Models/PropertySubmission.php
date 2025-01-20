<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertySubmission extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'user_last',
        'user_first',
        'user_email',
        'user_phone',
        'sender_type',
        'property_name',
        'property_type',
        'property_unit_status',
        'property_price',
        'property_area',
        'property_number',
        'property_parking',
        'property_status',
        'property_rent_terms',
        'property_sale_type',
        'property_sale_payment',
        'property_sale_title',
        'property_sale_turnover',
        'property_description',
        'property_amenities',
        'images',
    ];

    public static function booted()
    {
        static::creating(function (Submission $record) {
            $record->id = Str::ulid();
        });
    }
}
