<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;
    protected $table = 'listings';
    protected $fillable = [
        'title',
        'level',

        'basic_categories',
        'basic_account',
        'basic_status',
        'basic_renewal_date',
        'basic_disable_claim',
        'basic_summary_desc',
        'basic_description',
        'basic_keywords',

        'contact_email',
        'contact_url',
        'contact_phone',
        'contact_additional_label',
        'contact_additional_phone',
        'contact_address',
        'contact_address2',
        'contact_zip_code',
        'contact_reference',
        'contact_map_info',

        'social_facebook',
        'social_instagram',
        'social_twitter',

        'seo_title',
        'seo_page_name',
        'seo_keywords',
        'seo_description',
        'promotional_code',

        'image_logo',
        'image_cover',
        'image_gallery',
    ];
    protected $casts = [
        'basic_categories' => 'array',
        'basic_keywords' => 'array',
        'seo_keywords' => 'array',
    ];
}
