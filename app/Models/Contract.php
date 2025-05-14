<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Contract extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'image',
    ];

    public static function booted()
    {
        self::creating(function (Contract $record) {
            $record->id = Str::ulid();
        });

        self::deleted(function (Contract $record) {
            Storage::disk('public')->delete("contracts/$record->image");
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }
}
