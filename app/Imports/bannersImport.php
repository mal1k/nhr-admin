<?php

namespace App\Imports;

use App\Models\Banners;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class bannersImport implements
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
        return new Banners([
            'banner_type'               => $row['banner_type'],
            'caption'                   => $row['caption'],
            'description_line'          => $row['description_line'],
            'description_line2'         => $row['description_line2'],
            'basic_account'             => $row['basic_account'],
            'basic_status'              => $row['basic_status'],
            'basic_renewal_date'        => $row['basic_renewal_date'],
            'banner_section'            => $row['banner_section'],
            'banner_category'           => $row['banner_category'],
            'general_category'           => $row['general_category'],
            'listing_deals_category'      => $row['listing_deals_category'],
            'event_category'             => $row['event_category'],
            'blog_category'              => $row['blog_category'],
            'global_category'            => $row['global_category'],
            'banner_new_window'         => $row['banner_new_window'],
            'banner_url'                => $row['banner_url'],
            'banner_script_checkbox'    => $row['banner_script_checkbox'],
            'banner_script_textarea'    => $row['banner_script_textarea'],
            'banner_destinational_url'  => $row['banner_destinational_url'],
            'banner_display_url'        => $row['banner_display_url'],
            'promotional_code'          => $row['promotional_code'],
            'file_image'                => $row['file_image'],
            'created_at'                => $row['created_at'],
            'updated_at'                => $row['updated_at']
        ]);
    }

    public function onError(Throwable $error)
    {
    }

    public function rules(): array
    {
        return [
            '*.banner_type' => ['required', 'numeric']
        ];
    }


}
