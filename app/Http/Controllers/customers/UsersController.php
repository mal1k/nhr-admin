<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::paginate(10);

        $users_query = User::orderByDesc('id');
        $users_query->where('role', '!=', 'businessUser');
        $users = $users_query->paginate(10);

        return view('customers.users.dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.users.userForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = Hash::make('password', ['rounds' => 12]);
        $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $password;
            $user->role = $request->role;
        $user->save();
        $user->assignRole($request->role);

        return redirect()->route('users.index')->withSuccess('Created user ' . $user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return dd('show user info');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ( $user->role == 'businessUser' )
            return view('customers.business.businessForm', compact('user'));

        return view('customers.users.userForm', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ( $user->role == 'businessUser' ) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->business = $request->business;
            $user->role = 'businessUser';
          $user->save();
          return redirect()->route('business.index')->withSuccess('Updated business user ' . $user->name);
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
          $user->save();
          return redirect()->route('users.index')->withSuccess('Updated user ' . $user->name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        if ( $user->role == 'businessUser')
            return redirect()->route('business.index')->withSuccess('Deleted business user ' . $user->name);

        return redirect()->route('users.index')->withSuccess('Deleted user ' . $user->name);

    }
}
