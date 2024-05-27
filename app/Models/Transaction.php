<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    public function file(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_add');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
