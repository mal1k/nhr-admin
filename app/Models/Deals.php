<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory;
    protected $table = 'deals';
    protected $fillable = [
        'title',

        'basic_account',
        'basic_listing',
        'basic_summary_description',
        'basic_description',
        'basic_conditions',
        'basic_keywords',
        'basic_mapinfo',

        'deal_start_date',
        'deal_end_date',

        'deal_type',
        'real_price_int',
        'real_price_cent',
        'deal_price_int',
        'deal_price_cent',

        'seo_title',
        'seo_page_name',
        'seo_keywords',
        'seo_description',

        'image_logo',
        'image_cover'
    ];
    protected $casts = [
        'basic_keywords' => 'array',
        'seo_keywords' => 'array'
    ];
}
