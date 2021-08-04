<?php

namespace App\Imports;

use App\Models\Listings;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class listingsImport implements
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
        return new Listings([
            'title'                             =>$row['title'],
            'level'                             =>$row['level'],
            'basic_categories'                  =>$row['basic_categories'],
            'basic_account'                     =>$row['basic_account'],
            'basic_status'                      =>$row['basic_status'],
            'basic_renewal_date'                =>$row['basic_renewal_date'],
            'basic_disable_claim'               =>$row['basic_disable_claim'],
            'basic_summary_desc'                =>$row['basic_summary_desc'],
            'basic_description'                 =>$row['basic_description'],
            'basic_keywords'                    =>$row['basic_keywords'],
            'contact_email'                     =>$row['contact_email'],
            'contact_url'                       =>$row['contact_url'],
            'contact_phone'                     =>$row['contact_phone'],
            'contact_additional_label'          =>$row['contact_additional_label'],
            'contact_additional_phone'          =>$row['contact_additional_phone'],
            'contact_address'                   =>$row['contact_address'],
            'contact_address2'                  =>$row['contact_address2'],
            'contact_zip_code'                  =>$row['contact_zip_code'],
            'contact_reference'                 =>$row['contact_reference'],
            'contact_map_info'                  =>$row['contact_map_info'],
            'social_facebook'                   =>$row['social_facebook'],
            'social_instagram'                  =>$row['social_instagram'],
            'social_twitter'                    =>$row['social_twitter'],
            'features'                          =>$row['features'],
            'hours_work'                        =>$row['hours_work'],
            'seo_title'                         =>$row['seo_title'],
            'seo_page_name'                     =>$row['seo_page_name'],
            'seo_keywords'                      =>$row['seo_keywords'],
            'seo_description'                   =>$row['seo_description'],
            'promotional_code'                  =>$row['promotional_code'],
            'video_url'                         =>$row['video_url'],
            'video_desc'                        =>$row['video_desc'],
            'attach_file'                       =>$row['attach_file'],
            'attach_desc'                       =>$row['attach_desc'],
            'badges_checkbox'                   =>$row['badges_checkbox'],
            'image_logo'                        =>$row['image_logo'],
            'image_cover'                       =>$row['image_cover'],
            'image_gallery'                     =>$row['image_gallery'],
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
