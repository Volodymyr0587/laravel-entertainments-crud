<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['entertainment_id', 'path'];

    public function entertainment(): BelongsTo
    {
        return $this->belongsTo(Entertainment::class);
    }
}
