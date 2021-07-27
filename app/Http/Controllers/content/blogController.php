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
                'title' => 'required|max:255',
            ]);

            $blog = Blog::create($request->all()); // create blog

            // attach file
            if ( isset($request->image_logo) ) { // update image
                $path = $request->file('image_logo')->store('uploads/blog/logo', 'public'); // upload logo
                $blog->update([ 'image_logo' => $path ]);
            }

            // attach file
            if ( isset($request->image_cover) ) { // update image
                $path = $request->file('image_cover')->store('uploads/blog/cover', 'public'); // upload cover
                $blog->update([ 'image_cover' => $path ]);
            }

            return redirect()->route('blog.index')->withSuccess('Created post "' . $request->caption . '"');
        }
}
