<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'location',
        'price',
        'area',
        'parking',
        'vacant',
        'nearby',
        'description',
        'sale',
        'badge',
        'status',
        'unit_number',
        'unit_type',
        'unit_furnish',
        'unit_floor',
        'images',
    ];

    public static function booted()
    {
        static::creating(function (Property $record) {
            $record->id = Str::ulid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }
}
