<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class exportController extends Controller
{
    public function index() {
        return view('content.export.dashboard');
    }
}
