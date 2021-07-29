<?php

namespace App\Exports;

use App\Models\Banners;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class bannersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Banners::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'banner_type',
            'caption',
            'description_line',
            'description_line2',
            'basic_account',
            'basic_status',
            'basic_renewal_date',
            'banner_section',
            'banner_category',
            'generalCategory',
            'listingDealsCategory',
            'eventCategory',
            'blogCategory',
            'globalCategory',
            'banner_new_window',
            'banner_url',
            'banner_script_checkbox',
            'banner_script_textarea',
            'banner_destinational_url',
            'banner_display_url',
            'promotional_code',
            'file_image',
            'created_at',
            'updated_at'
        ];
    }
}
