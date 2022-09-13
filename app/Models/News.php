<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'user_id', 'slug', 'headline', 'cover_photo', 'excerpt', 'content', 'status', 'featured', 'posted_at'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('headline')
            ->saveSlugsTo('slug');
    }
}
