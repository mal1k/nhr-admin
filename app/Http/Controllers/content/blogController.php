<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class blogController extends Controller
{
    public function index()
        {
            $blog = Blog::orderByDesc('id')->paginate(15);
            return view('content.blog.dashboard', compact('blog'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.blog.form', compact('users'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'caption' => 'required|max:255',
            ]);


            $banner = Blog::create($request->all()); // create banner

            // attach file
            if ( isset($request->file_image) ) { // update image
                $path = $request->file('file_image')->store('uploads/banners', 'public'); // upload image
                $banner->update([ 'file_image' => $path ]);
            }

            return redirect()->route('banners.index')->withSuccess('Created banner "' . $request->caption . '"');
        }
}
