<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'subtitle',
        'date',
        'content',
        'type',
        'image',
        'url',
    ];

    public static function booted()
    {
        self::creating(function (Article $record) {
            $record->id = Str::ulid();
        });

        self::updated(function (Article $record) {
            Storage::disk('s3')->delete("articles/$record->image");
        });

        self::deleted(function (Article $record) {
            Storage::disk('s3')->delete("articles/$record->image");
        });
    }
}
