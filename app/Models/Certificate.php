<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'date',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Certificate $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Certificate $record) {
            Storage::disk('public')->delete("certificates/$record->image");
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
