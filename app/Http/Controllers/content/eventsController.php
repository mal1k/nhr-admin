<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;

class eventsController extends Controller
{
    //
    public function index()
        {
            $events = Events::orderByDesc('id')->paginate(15);
            return view('content.events.dashboard', compact('events'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            return view('content.events.form', compact('users'));
        }
}
