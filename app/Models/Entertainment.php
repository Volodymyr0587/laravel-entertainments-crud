<?php

namespace App\Models;

use App\Enums\EntertainmentStatus;
use App\Traits\HasSearchableTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Entertainment extends Model
{
    use HasSearchableTitle;

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

    public function scopeFilterByStatus(Builder $query, ?EntertainmentStatus $status): Builder
    {
        if ($status) {
            $query->where('status', $status->value);
        }

        return $query;
    }
}
