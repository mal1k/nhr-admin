<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Events extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'level',

        'basic_categories',
        'basic_account',
        'basic_status',
        'basic_renewal_date',
        'basic_summary_desc',
        'basic_description',
        'basic_keywords',
        'social_facebook',

        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_url',
        'contact_venue',
        'contact_address',
        'contact_zip_code',
        'contact_region',

        'event_start_date',
        'event_end_date',
        'event_start_time',
        'event_end_time',
        'event_recurring_event',
        'event_recurring_repeat',
        'event_recurring_every',
        'event_recurring_repeat',
        'event_recurring_ends_on',
        'event_recurring_dayofweek',
        'event_recurring_ends_on_until',

        'seo_title',
        'seo_page_name',
        'seo_keywords',
        'seo_description',

        'image_cover',
        'image_gallery',
        'video_url',

        'promotional_code',
    ];

    public $sortable = [
        'id',
        'title',
        'level',
        'basic_status'
    ];

    protected $casts = [
        'basic_categories' => 'array',
        'basic_keywords' => 'array',
        'event_start_time' => 'array',
        'event_end_time' => 'array',
        'event_recurring_every' => 'array',
        'event_recurring_dayofweek' => 'array',
        'seo_keywords' => 'array',
        'image_gallery' => 'array',
    ];
}
