<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class listingTypes extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'listing_types';
    protected $fillable = [
    'title',
    'categories',
    'additional_price',
    'common_fields_listing_title_label',
    'common_fields_listing_title_tooltip',
    'common_fields_address_line_label',
    'common_fields_address_line_tooltip',
    'common_fields_address_line2_label',
    'common_fields_address_line2_tooltip',
    'extra_checkbox_fields_label',
    'extra_checkbox_fields_tooltip',
    'extra_dropdown_fields_label',
    'extra_dropdown_fields_dropdown_items',
    'extra_dropdown_fields_tooltip',
    'extra_dropdown_fields_checkbox',
    'extra_text_fields_label',
    'extra_text_fields_tooltip',
    'extra_text_fields_checkbox',
    'extra_short_description_fields_label',
    'extra_short_description_fields_tooltip',
    'extra_short_description_fields_checkbox',
    'extra_long_description_fields_label',
    'extra_long_description_fields_tooltip',
    'extra_long_description_fields_checkbox'
    ];

    public $sortable = [
        'id',
        'title',
    ];

    protected $casts = [
        'categories' => 'array',
    ];
}
