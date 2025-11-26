<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'genre',
        'release_year',
        'language',
        'poster_url',
        'download_link',
        'file_size',
        'quality',
        'is_active',
        'downloads',
    ];

    protected $casts = [
        'release_year' => 'integer',
        'is_active' => 'boolean',
        'downloads' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Generate slug from title
     */
    public function generateSlug()
    {
        $baseSlug = \Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;

        while (self::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($movie) {
            if (empty($movie->slug)) {
                $movie->slug = $movie->generateSlug();
            }
        });
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        return $this->file_size ? $this->file_size : 'Unknown';
    }

    /**
     * Get poster URL with fallback
     */
    public function getPosterAttribute()
    {
        return $this->poster_url ?: asset('images/default-poster.jpg');
    }
}
