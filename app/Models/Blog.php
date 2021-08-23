<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Blog extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'blog';
    protected $fillable = [
    'title',
    'categories',
    'status',
    'content',
    'keywords',
    'seo_title',
    'seo_page_name',
    'seo_keywords',
    'seo_description',
    'image_logo',
    'image_cover',
    ];

    public $sortable = [
        'id',
        'title',
        'status'
    ];

    protected $casts = [
    'categories' => 'array',
    'keywords' => 'array',
    'seo_keywords' => 'array',
    ];
}
