<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class referedByController extends Controller
{
    public function index()
        {
            $users = User::orderByDesc('id')->whereNotNull('refered_by')->paginate(15);
            return view('content.referedBy.dashboard', compact('users'));
        }

    public function create()
        {
            $users = User::orderByDesc('id')->whereNotNull('refered_by')->paginate(15);
            return dd('In developing');
        }
}
