<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
        'type',
        'icon',
        'banner',
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

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Storage::url($value) : asset('img/logo.png'),
        );
    }

    protected function banner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Storage::url($value) : asset('img/logo.png'),
        );
    }

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }



}
