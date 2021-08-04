<?php

namespace App\Imports;

use App\Models\Events;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class eventsImport implements
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
        return new Events([
            'title'                             => $row['title'],
            'level'                             => $row['level'],
            'basic_categories'                  => $row['basic_categories'],
            'basic_account'                     => $row['basic_account'],
            'basic_status'                      => $row['basic_status'],
            'basic_renewal_date'                => $row['basic_renewal_date'],
            'basic_summary_desc'                => $row['basic_summary_desc'],
            'basic_description'                 => $row['basic_description'],
            'basic_keywords'                    => $row['basic_keywords'],
            'social_facebook'                   => $row['social_facebook'],
            'contact_name'                      => $row['contact_name'],
            'contact_email'                     => $row['contact_email'],
            'contact_phone'                     => $row['contact_phone'],
            'contact_url'                       => $row['contact_url'],
            'contact_venue'                     => $row['contact_venue'],
            'contact_address'                   => $row['contact_address'],
            'contact_zip_code'                  => $row['contact_zip_code'],
            'contact_region'                    => $row['contact_region'],
            'event_start_date'                  => $row['event_start_date'],
            'event_end_date'                    => $row['event_end_date'],
            'event_start_time'                  => $row['event_start_time'],
            'event_end_time'                    => $row['event_end_time'],
            'event_recurring_event'             => $row['event_recurring_event'],
            'event_recurring_repeat'            => $row['event_recurring_repeat'],
            'event_recurring_every'             => $row['event_recurring_every'],
            'event_recurring_repeat'            => $row['event_recurring_repeat'],
            'event_recurring_ends_on'           => $row['event_recurring_ends_on'],
            'event_recurring_dayofweek'         => $row['event_recurring_dayofweek'],
            'event_recurring_ends_on_until'     => $row['event_recurring_ends_on_until'],
            'seo_title'                         => $row['seo_title'],
            'seo_page_name'                     => $row['seo_page_name'],
            'seo_keywords'                      => $row['seo_keywords'],
            'seo_description'                   => $row['seo_description'],
            'image_cover'                       => $row['image_cover'],
            'image_gallery'                     => $row['image_gallery'],
            'video_url'                         => $row['video_url'],
            'promotional_code'                  => $row['promotional_code'],
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
            '*.title' => ['required'],
            '*.level' => ['required'],
        ];
    }
}
