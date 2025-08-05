<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLog extends Model
{
    /** @use HasFactory<\Database\Factories\WaterLogFactory> */
    use HasFactory;
        use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'logged_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}