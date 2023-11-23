<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Support\Facades\Storage;

class BlogPost extends Model
{
    use HasFactory, HasUuids, Sluggable;

    protected $fillable = [];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected $appends = [
        'cover_image_preview',
        'reading_time'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
            ->where('is_published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    public function getCoverImagePreviewAttribute()
    {
        if ($this->cover_image) {
            return Storage::url($this->cover_image);
        }
    }

    public function getReadingTimeAttribute()
    {
        $totalWords = str_word_count($this->body);
        $minutesToRead = round($totalWords / 200);

        return (int)max(1, $minutesToRead);
    }
}
