<?php

namespace App\Exports;

use App\Models\listingTypes;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class listingTypesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return listingTypes::all();
    }

    public function headings(): array
    {
        return [
            'id',
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
            'extra_long_description_fields_checkbox',
            'created_at',
            'updated_at'
        ];
    }
}
