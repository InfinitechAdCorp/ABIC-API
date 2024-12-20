<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Submission extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'property',
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
        'submit_status',
        'unit_number',
        'unit_type',
        'unit_furnish',
        'unit_floor',
        'submitted_by',
        'commission',
        'terms',
        'title',
        'turnover',
        'lease',
        'acknowledgment',
        'amenities',
        'images',
    ];

    public static function booted()
    {
        static::creating(function (Submission $record) {
            $record->id = Str::ulid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }
}
