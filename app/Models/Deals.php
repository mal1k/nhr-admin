<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    public function index()
        {
            $deals = Deals::orderByDesc('id')->paginate(15);
            return view('content.deals.dashboard', compact('deals'));
        }
}
