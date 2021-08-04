<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exportContent extends Model
{
    use HasFactory;
    protected $table = 'export_content';
    protected $fillable = [
    'filename',
    'filesize'
    ];
}
