<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'career_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'resume'
    ];

    public static function booted()
    {
        self::creating(function (Application $record) {
            $record->id = Str::ulid();
        });
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}