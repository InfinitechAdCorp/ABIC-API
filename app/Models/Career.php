<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}