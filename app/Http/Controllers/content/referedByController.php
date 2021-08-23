<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class referedByController extends Controller
{
    public function index()
        {
            if ( isset($_GET['s']) ) {
                $users = User::whereNotNull('refered_by')
                    ->where(function ($query) {
                        $query->where('email', 'LIKE', '%' . $_GET['s'] . '%')
                        ->orWhere('refered_by', 'LIKE', '%' . $_GET['s'] . '%');
                    })
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);
                $search = $_GET['s'];
                return view('content.referedBy.dashboard', compact('users', 'search'));
            }
            else
                $users = User::whereNotNull('refered_by')
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);
            return view('content.referedBy.dashboard', compact('users'));
        }

    public function create()
        {
            $users = User::orderByDesc('id')->whereNotNull('refered_by')->paginate(15);
            return dd('In developing');
        }
}
