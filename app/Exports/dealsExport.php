<?php

namespace App\Exports;

use App\Models\Deals;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class dealsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Deals::all();
    }

    public function headings(): array
    {
        return [
            'id',
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
            'image_cover',
            'created_at',
            'updated_at'
        ];
    }
}
