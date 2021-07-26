<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\User;
use Illuminate\Http\Request;

class bannersController extends Controller
{
    public function index()
        {
            $banners = Banners::orderByDesc('id')->paginate(15);
            return view('content.banners.dashboard', compact('banners'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.banners.form', compact('users'));
        }
}
