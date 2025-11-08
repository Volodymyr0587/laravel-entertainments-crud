<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function entertainments(): BelongsToMany
    {
        return $this->belongsToMany(Entertainment::class)
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
    }

}
