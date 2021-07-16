<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deals;

class dealsController extends Controller
{
    public function index()
        {
            $deals = Deals::orderByDesc('id')->paginate(15);
            return view('content.deals.dashboard', compact('deals'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            return view('content.deals.form', compact('users'));
        }


}
