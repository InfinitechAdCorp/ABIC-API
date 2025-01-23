<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Owner extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'location',
        'budget',
        'start',
        'end',
        'description',
        'image',
    ];

    public static function booted()
    {
        static::creating(function (Owner $record) {
            $record->id = Str::ulid();
        });
    }

    public function properties(): HasMany 
    {
        return $this->hasMany(Property::class); 
    }
}
