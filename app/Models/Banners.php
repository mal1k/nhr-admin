<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_type',
        'caption',
        'description_line',
        'description_line2',

        'basic_account',
        'basic_status',
        'basic_renewal_date',

        'banner_section',
        'banner_category',
        'banner_new_window',
        'banner_url',
        'banner_script_checkbox',
        'banner_script_textarea',
        'banner_display_url',

        'promotional_code',

        'file_image'
    ];
}
