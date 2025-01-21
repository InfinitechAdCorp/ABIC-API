<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Infrastructure extends Model
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
        static::creating(function (Infrastructure $record) {
            $record->id = Str::ulid();
        });
    }
}
