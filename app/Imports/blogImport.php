<?php

namespace App\Imports;

use App\Models\Blog;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class blogImport implements
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
        return new Blog([
            'title'             => $row['title'],
            'categories'        => $row['categories'],
            'status'            => $row['status'],
            'content'           => $row['content'],
            'keywords'          => $row['keywords'],
            'seo_title'         => $row['seo_title'],
            'seo_page_name'     => $row['seo_page_name'],
            'seo_keywords'      => $row['seo_keywords'],
            'seo_description'   => $row['seo_description'],
            'image_logo'        => $row['image_logo'],
            'image_cover'       => $row['image_cover'],
            'created_at'        => $row['created_at'],
            'updated_at'        => $row['updated_at']
        ]);
    }

    public function onError(Throwable $error)
    {
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required'],
        ];
    }
}
