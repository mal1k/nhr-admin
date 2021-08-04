<?php

namespace App\Exports;

use App\Models\Faq;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class faqExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Faq::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'question',
            'answer',
            'front',
            'sponsors',
            'created_at',
            'updated_at'
        ];
    }
}
