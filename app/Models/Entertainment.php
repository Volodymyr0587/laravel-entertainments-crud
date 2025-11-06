<?php

namespace App\Models;

use App\Traits\HasSearchableTitle;
use App\Enums\EntertainmentStatus;
use Illuminate\Database\Eloquent\Model;

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
}
