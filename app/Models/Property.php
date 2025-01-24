<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'owner_id',
        'name',
        'location',
        'price',
        'area',
        'parking',
        'description',

        'unit_number',
        'unit_type',
        'unit_status',

        'sale_type',
        'title',
        'payment',
        'turnover',
        'terms',

        'status',
        'badge',
        'published',

        'amenities',
        'images',
    ];

    public static function booted()
    {
        static::creating(function (Property $record) {
            $record->id = Str::ulid();
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
