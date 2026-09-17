<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'genre',
        'status',
        'description',
        'thumbnail',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    /**
     * Human-readable status labels, matching the badge styles already
     * used across the admin dashboard (In Development / Published / Concept).
     */
    public const STATUSES = [
        'concept' => 'Concept',
        'in_development' => 'In Development',
        'published' => 'Published',
    ];

    protected static function booted(): void
    {
        static::saving(function (Game $game) {
            if (empty($game->slug) || $game->isDirty('title')) {
                $game->slug = static::uniqueSlug($game->title, $game->id);
            }
        });
    }

    protected static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'game';
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }
}
