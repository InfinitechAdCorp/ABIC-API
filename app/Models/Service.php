<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Service $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Service $record) {
            Storage::disk('public')->delete("services/$record->image");
        });
    }
}
