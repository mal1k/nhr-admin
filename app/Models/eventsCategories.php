<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventsCategories extends Model
{
    use HasFactory;
    protected $table = 'event_categories';
    protected $fillable = [
        'title',
        'categories',

        'features_checkbox',
        'disable_checkbox',

        'main_category',

        'content',

        'seo_page_title',
        'seo_friendly_title',
        'seo_keywords',
        'seo_description',

        'image_logo',
        'image_icon',
    ];
    protected $casts = [
        'categories' => 'array',
        'seo_keywords' => 'array'
    ];
}
