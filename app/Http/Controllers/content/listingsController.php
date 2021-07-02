<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class listingsController extends Controller
{
    public function index()
    {
        // $users_query = User::query();
        // $users_query->whereNotNull('business');
        // $users = $users_query->paginate(10);
        return view('content.listings.dashboard');
    }

    public function create()
    {
        // $users_query = User::query();
        // $users_query->whereNotNull('business');
        // $users = $users_query->paginate(10);
        return view('content.listings.form');
    }

    public function store(Request $request)
    {
        return dd($request->all());
    }
}
