<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        self::creating(function (Infrastructure $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Infrastructure $record) {
            Storage::disk('s3')->delete("infrastructures/$record->image");
        });
    }
}
