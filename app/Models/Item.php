<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'width',
        'height',
        'type',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Item $record) {
            $record->id = Str::ulid();
        });
    }
}
