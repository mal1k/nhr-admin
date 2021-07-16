<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dealsController extends Controller
{
    public function index()
        {
            $listings = Listings::orderByDesc('id')->paginate(15);
            return view('content.listings.dashboard', compact('listings'));
        }
}
