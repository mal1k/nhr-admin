<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;
    protected $table = 'listings';
    protected $fillable = [
        'title',
        'level',
        'categories',
        'account',
        'status',
        'renewal_date',
        'cover_image',
    ]
}
