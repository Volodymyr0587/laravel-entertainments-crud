<?php

namespace App\Models;

use App\Enums\EntertainmentStatus;
use App\Traits\HasSearchableTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entertainment extends Model
{
    use HasSearchableTitle, SoftDeletes;

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
     * The tags that belong to the Entertainment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
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

    public function scopeFilterByStatus(Builder $query, ?EntertainmentStatus $status): Builder
    {
        if ($status) {
            $query->where('status', $status->value);
        }

        return $query;
    }

     public function scopeSortByTitle(Builder $query, ?string $direction = 'asc'): Builder
    {
        $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';
        return $query->orderBy('title', $direction);
    }

    public function scopeFilterByTag(Builder $query, $tagName)
    {
        if (!$tagName) return $query;

        return $query->whereHas('tags', fn($q) => $q->where('name', $tagName));
    }

    public static function countInTrash(): int
    {
        return self::onlyTrashed()->count();
    }

    protected static function booted()
    {
        static::deleting(function ($entertainment) {
            if (! $entertainment->isForceDeleting()) {
                // Soft delete the pivot records instead of fully detaching
                $entertainment->tags()->updateExistingPivot(
                    $entertainment->tags()->pluck('tags.id')->toArray(),
                    ['deleted_at' => now()]
                );
            }
        });

        static::restored(function ($entertainment) {
            // Restore soft-deleted pivot records
            \DB::table('entertainment_tag')
                ->where('entertainment_id', $entertainment->id)
                ->update(['deleted_at' => null]);
        });

        static::forceDeleted(function ($entertainment) {
            // Hard delete all related pivot records
            \DB::table('entertainment_tag')->where('entertainment_id', $entertainment->id)->delete();

            // Remove orphan tags
            Tag::whereDoesntHave('entertainments')->delete();
        });
    }
}
