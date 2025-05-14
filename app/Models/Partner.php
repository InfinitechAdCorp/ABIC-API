<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Partner $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Partner $record) {
            Storage::disk('public')->delete("partners/$record->image");
        });
    }
}
