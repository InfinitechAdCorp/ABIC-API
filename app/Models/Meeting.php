<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'agenda',
        'image',
    ];

    public static function booted()
    {
        static::creating(function (Meeting $record) {
            $record->id = Str::ulid();
        });
    }
}
