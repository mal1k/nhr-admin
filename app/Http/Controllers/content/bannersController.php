<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;

class bannersController extends Controller
{
    public function index()
        {
            $banners = Banners::orderByDesc('id')->paginate(15);
            return view('content.banners.dashboard', compact('banners'));
        }
}
