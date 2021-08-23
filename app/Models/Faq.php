<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Faq extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'faq';
    protected $fillable = [
    'question',
    'answer',
    'front',
    'sponsors'
    ];
    public $sortable = [
        'id',
        'question',
        'answer',
    ];
}
