<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClosedDeal extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public static function booted()
    {
        static::creating(function (ClosedDeal $record) {
            $record->id = Str::ulid();
        });
    }
}
