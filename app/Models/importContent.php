<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class importContent extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'import_content';
    protected $fillable = [
    'category',
    'filesize',
    'rows'
    ];

    public $sortable = [
        'id',
        'category',
        'filesize',
        'rows',
        'updated_at'
    ];
}
