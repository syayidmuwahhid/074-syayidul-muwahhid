<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityLog extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addLog(string $type, string $description)
    {
        return DB::table('activity_logs')->insert([
            'type' => $type,
            'description' => $description,
            'user_id' => Auth::user()->id,
            'created_at' => now()
        ]);
    }
}
