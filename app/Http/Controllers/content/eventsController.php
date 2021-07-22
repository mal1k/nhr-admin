<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;

class eventsController extends Controller
{
    //
    public function index()
        {
            $deals = Events::orderByDesc('id')->paginate(15);
            return view('content.deals.dashboard', compact('deals'));
        }
}
