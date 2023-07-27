<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'icon',
        'status',
        'type',
        'user_id',
    ];

    /**
     * Get the user that owns the detail.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
