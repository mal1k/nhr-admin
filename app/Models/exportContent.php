<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class exportContent extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'export_content';
    protected $fillable = [
    'filename',
    'filesize'
    ];

    public $sortable = [
        'id',
        'filename',
        'filesize',
        'created_at'
    ];
}
