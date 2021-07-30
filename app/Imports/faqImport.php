<?php

namespace App\Imports;

use App\Models\Faq;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class faqImport implements
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
        return new Faq([
            'question'      => $row['question'],
            'answer'        => $row['answer'],
            'front'         => $row['front'],
            'sponsors'      => $row['sponsors'],
            'created_at'    => $row['created_at'],
            'updated_at'     => $row['updated_at']
        ]);
    }

    public function onError(Throwable $error)
    {
    }

    public function rules(): array
    {
        return [
            '*.question' => ['required'],
            '*.answer' => ['required'],
        ];
    }
}
