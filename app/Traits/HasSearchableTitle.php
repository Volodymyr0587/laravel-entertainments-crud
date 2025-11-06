<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait HasSearchableTitle
{
    protected static function bootHasSearchableTitle(): void
    {
        static::creating(function ($model) {
            $model->title_for_search = Str::lower($model->title);
        });

        static::updating(function ($model) {
            $model->title_for_search = Str::lower($model->title);
        });
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if ($term) {
            $term = mb_strtolower($term);
            $query->where('title_for_search', 'LIKE', '%' . $term . '%');
        }

        return $query;
    }
}
