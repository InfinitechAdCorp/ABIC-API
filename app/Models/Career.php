<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Career extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'position',
        'slots',
        'image',
    ];

    public static function booted() {
        self::creating(function (Career $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Career $record) {
            Storage::disk('public')->delete("careers/images/$record->image");
        });
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}