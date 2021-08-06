<?php

namespace App\Imports;

use App\Models\Deals;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class dealsImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Deals([
            'title'                             => $row['title'],
            'basic_account'                     => $row['basic_account'],
            'basic_listing'                     => $row['basic_listing'],
            'basic_summary_description'         => $row['basic_summary_description'],
            'basic_description'                 => $row['basic_description'],
            'basic_conditions'                  => $row['basic_conditions'],
            'basic_keywords'                    => $row['basic_keywords'],
            'basic_mapinfo'                     => $row['basic_mapinfo'],
            'deal_start_date'                   => $row['deal_start_date'],
            'deal_end_date'                     => $row['deal_end_date'],
            'deal_type'                         => $row['deal_type'],
            'real_price_int'                    => $row['real_price_int'],
            'real_price_cent'                   => $row['real_price_cent'],
            'deal_price_int'                    => $row['deal_price_int'],
            'deal_price_cent'                   => $row['deal_price_cent'],
            'seo_title'                         => $row['seo_title'],
            'seo_page_name'                     => $row['seo_page_name'],
            'seo_keywords'                      => $row['seo_keywords'],
            'seo_description'                   => $row['seo_description'],
            'image_logo'                        => $row['image_logo'],
            'image_cover'                       => $row['image_cover'],
            'created_at'                        => $row['created_at'],
            'updated_at'                        => $row['updated_at']
        ]);
    }

    public function onError(Throwable $error)
    {
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required']
        ];
    }
}
