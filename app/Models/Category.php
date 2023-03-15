<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @method static create(array $data)
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'summery',
        'icon',
        'featured',
        'top',
        'digital',
        'order_level',
        'status',
    ];
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }



//    public function





}
