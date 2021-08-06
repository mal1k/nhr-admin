<?php

namespace App\Imports;

use App\Models\listingTypes;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class listingTypesImport implements
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
        return new listingTypes([
            'title'                                     => $row['title'],
            'categories'                                => $row['categories'],
            'additional_price'                          => $row['additional_price'],
            'common_fields_listing_title_label'         => $row['common_fields_listing_title_label'],
            'common_fields_listing_title_tooltip'       => $row['common_fields_listing_title_tooltip'],
            'common_fields_address_line_label'          => $row['common_fields_address_line_label'],
            'common_fields_address_line_tooltip'        => $row['common_fields_address_line_tooltip'],
            'common_fields_address_line2_label'         => $row['common_fields_address_line2_label'],
            'common_fields_address_line2_tooltip'       => $row['common_fields_address_line2_tooltip'],
            'extra_checkbox_fields_label'               => $row['extra_checkbox_fields_label'],
            'extra_checkbox_fields_tooltip'             => $row['extra_checkbox_fields_tooltip'],
            'extra_dropdown_fields_label'               => $row['extra_dropdown_fields_label'],
            'extra_dropdown_fields_dropdown_items'      => $row['extra_dropdown_fields_dropdown_items'],
            'extra_dropdown_fields_tooltip'             => $row['extra_dropdown_fields_tooltip'],
            'extra_dropdown_fields_checkbox'            => $row['extra_dropdown_fields_checkbox'],
            'extra_text_fields_label'                   => $row['extra_text_fields_label'],
            'extra_text_fields_tooltip'                 => $row['extra_text_fields_tooltip'],
            'extra_text_fields_checkbox'                => $row['extra_text_fields_checkbox'],
            'extra_short_description_fields_label'      => $row['extra_short_description_fields_label'],
            'extra_short_description_fields_tooltip'    => $row['extra_short_description_fields_tooltip'],
            'extra_short_description_fields_checkbox'   => $row['extra_short_description_fields_checkbox'],
            'extra_long_description_fields_label'       => $row['extra_long_description_fields_label'],
            'extra_long_description_fields_tooltip'     => $row['extra_long_description_fields_tooltip'],
            'extra_long_description_fields_checkbox'    => $row['extra_long_description_fields_checkbox'],
            'created_at'                                => $row['created_at'],
            'updated_at'                                => $row['updated_at']
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
