<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Enums\Tool\Status as ToolStatus;
use App\Enums\Tool\Pricing as ToolPricing;

class Tool extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'pricing',
        'slug',
        'photo',
        'website',
        'headline',
        'description',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'github',
        'support_email',
        'apple_store_link',
        'google_store_link',
        'submitted_at',
        'published_at',
        'queue_priority'
    ];

    protected $casts = [
        'status' => ToolStatus::class,
        'pricing' => ToolPricing::class,
        'published_at' => 'datetime',
        'submitted_at' => 'datetime',

    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'photo_url',
        'medias',
        'days_to_review'
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo) : 'https://ui-avatars.com/api/?length=1&name=' . urlencode($this->name) . '&color=FFFFFF&background=27272a';
    }

    // calculate the number of days to be reviewed
    public function getDaysToReviewAttribute()
    {
        if($this->queue_priority) {
            return 'Will be reviewed within 24 hours';
        }

        // get all tools that are pending and not have queue priority
        $tools = Tool::where('status', ToolStatus::STATUS_PENDING)->where('queue_priority', false)->orderBy('submitted_at', 'asc')->get();
        $position = array_search($this->id, $tools->map->id->toArray()) + 50;

        return "$position waiting in line";
    }

    public function getMediasAttribute()
    {
        return $this->getMedia();
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', ToolStatus::STATUS_PUBLISHED);
        $query->where('published_at', '<=', now());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
