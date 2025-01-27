<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'video',
    ];

    public static function booted()
    {
        self::creating(function (Video $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Video $record) {
            Storage::disk('s3')->delete("videos/$record->video");
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
