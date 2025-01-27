<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        self::creating(function (Property $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Property $record) {
            $record->owner()->delete();

            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
            }
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
