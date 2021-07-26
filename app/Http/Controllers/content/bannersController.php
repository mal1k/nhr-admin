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

    public function store(Request $request)
        {
            $validated = $request->validate([
                'caption' => 'required|max:255',
            ]);

            // return dd($request->file());
            $banner = Banners::create($request->all()); // create banner

            // attach file
            if ( isset($request->file_image) ) { // update image
                $path = $request->file('file_image')->store('uploads/banners', 'public'); // upload image
                $banner->update([ 'file_image' => $path ]);
            }

            return redirect()->route('banners.index')->withSuccess('Created banner "' . $request->caption . '"');
        }

    public function edit(Banners $banner)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.banners.form', compact('banner', 'users'));
        }

    public function update(Request $request, Banners $banner)
        {
            $banner->update($request->all()); // update banner

            // attach file
            if ( isset($request->file_image) ) { // update image
                $path = $request->file('file_image')->store('uploads/banners', 'public'); // upload image
                $banner->update([ 'file_image' => $path ]);
            }

            if ( empty($request->file_image_prev) && empty($request->file_image) ) { // delete logo
                $banner->update([ 'file_image' => null ]);
            }

            if ( empty($request->banner_script_checkbox) ) // set checkbox to null if its clear
                $banner->update([ 'banner_script_checkbox' => null ]);

            return redirect()->route('banners.index')->withSuccess('Updated banner "' . $request->caption . '"');
        }

    public function destroy(Banners $banner)
        {
            $banner->delete();

            return redirect()->route('banners.index')->withDanger('Deleted banner "' . $banner->caption . '"');

        }
}
