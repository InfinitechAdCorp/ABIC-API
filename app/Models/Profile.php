<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'position',
        'phone',
        'facebook',
        'instagram',
        'telegram',
        'viber',
        'whatsapp',
        'about',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Profile $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Profile $record) {
            Storage::disk('s3')->delete("profiles/$record->image");
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
