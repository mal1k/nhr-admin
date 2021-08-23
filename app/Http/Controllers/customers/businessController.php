<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class businessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( isset($_GET['s']) ) {
            $users = User::where('role', '=', 'businessUser')
                ->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . $_GET['s'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $_GET['s'] . '%')
                    ->orWhere('role', 'LIKE', '%' . $_GET['s'] . '%');
                })
                ->sortable(['id' => 'desc'])
                ->paginate(10);
            $search = $_GET['s'];
            return view('customers.business.dashboard', compact('users', 'search'));
        }

        else
            $users = User::where('role', '=', 'businessUser')
                ->sortable(['id' => 'desc'])
                ->paginate(10);

        return view('customers.business.dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.business.businessForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validate([
            'business' => 'required|max:255',
        ]);
        $password = Hash::make('password', ['rounds' => 12]);
        $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $password;
            $user->business = $request->business;
            $user->role = 'businessUser';
        $user->save();
        $user->assignRole('businessUser');

        return redirect()->route('business.index')->withSuccess('Created business user ' . $user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return dd('show business user info');
    }

    // public function update(Request $request, User $user)
    // {
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->business = $request->business;
    //         $user->role = 'User';
    //     $user->save();
    //     return redirect()->route('business.index')->withSuccess('Updated business user ' . $user->name);
    // }

}
