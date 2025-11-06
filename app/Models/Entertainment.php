<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\EntertainmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Entertainment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'title_for_search',
        'url',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function ($entertainment) {
            $entertainment->title_for_search = Str::lower($entertainment->title);
        });

        static::updating(function ($entertainment) {
            $entertainment->title_for_search = Str::lower($entertainment->title);
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => EntertainmentStatus::class,
        ];
    }
}
