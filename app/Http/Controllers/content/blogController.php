<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\blogCategories;
use App\Models\User;
use Illuminate\Http\Request;

class blogController extends Controller
{
    public function index()
        {
            if ( isset($_GET['s']) ) {
                $blog = Blog::where('title', 'LIKE', '%' . $_GET['s'] . '%')
                    ->orWhere('status', 'LIKE', '%' . $_GET['s'] . '%')
                    ->sortable(['id' => 'desc'])
                    ->paginate(15);
                $search = $_GET['s'];
                return view('content.blog.dashboard', compact('blog', 'search'));
            }
            else
                $blog = Blog::sortable(['id' => 'desc'])->paginate(15);
            return view('content.blog.dashboard', compact('blog'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            $blogCategories = blogCategories::orderByDesc('id')->paginate(0);

            return view('content.blog.form', compact('users', 'blogCategories'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $blog = Blog::create($request->all()); // create blog

            // attach logo
            if ( isset($request->image_logo) ) { // update image
                $path = $request->file('image_logo')->store('uploads/blog/logo', 'public'); // upload logo
                $blog->update([ 'image_logo' => $path ]);
            }

            // attach cover
            if ( isset($request->image_cover) ) { // update image
                $path = $request->file('image_cover')->store('uploads/blog/cover', 'public'); // upload cover
                $blog->update([ 'image_cover' => $path ]);
            }

            return redirect()->route('blog.index')->withSuccess('Created post "' . $request->title . '"');
        }

    public function edit(Blog $blog)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            $blogCategories = blogCategories::orderByDesc('id')->paginate(0);

            return view('content.blog.form', compact('blog', 'users', 'blogCategories'));
        }

    public function update(Request $request, Blog $blog)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $blog->update($request->all()); // update blog

            // attach logo
            if ( isset($request->image_logo) ) { // update image
                $path = $request->file('image_logo')->store('uploads/blog/logo', 'public'); // upload logo
                $blog->update([ 'image_logo' => $path ]);
            }

            // attach cover
            if ( isset($request->image_cover) ) { // update image
                $path = $request->file('image_cover')->store('uploads/blog/cover', 'public'); // upload cover
                $blog->update([ 'image_cover' => $path ]);
            }

            // remove logo
            if ( empty($request->image_logo_prev) && empty($request->image_logo) ) // delete logo
                $blog->update([ 'image_logo' => null ]);

            // remove cover
            if ( empty($request->image_cover_prev) && empty($request->image_cover) ) // delete logo
                $blog->update([ 'image_cover' => null ]);

            // remove categories
            if ( empty($request->categories) ) // set checkbox to null if its clear
                $blog->update([ 'categories' => null ]);

            // remove keywords
            if ( empty($request->keywords) ) // set checkbox to null if its clear
                $blog->update([ 'keywords' => null ]);

            // remove seo keywords
            if ( empty($request->seo_keywords) ) // set checkbox to null if its clear
                $blog->update([ 'seo_keywords' => null ]);


            return redirect()->route('blog.index')->withSuccess('Updated post "' . $request->title . '"');
        }

    public function destroy(Blog $blog)
        {
            $blog->delete();

            return redirect()->route('blog.index')->withSuccess('Deleted post "' . $blog->title . '"');

        }
}
