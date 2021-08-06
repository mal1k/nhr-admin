<?php

namespace App\Exports;

use App\Models\Blog;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class blogExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Blog::all();
    }

    public function headings(): array
    {
        return [
            'id',
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
            'created_at',
            'updated_at'
        ];
    }

}
