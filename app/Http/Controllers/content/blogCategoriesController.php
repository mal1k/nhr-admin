<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\blogCategories;
use Illuminate\Http\Request;

class blogCategoriesController extends Controller
{
    public function index() {
        $categories = blogCategories::orderByDesc('id')->paginate(15);
        return view('content.blog.categories.dashboard', compact('categories'));
    }

    public function create()
        {
            $categories = blogCategories::orderByDesc('id')->paginate(15);
            return view('content.blog.categories.form', compact('categories'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $blog = blogCategories::create($request->all()); // create category

            if ( isset($request->image_logo) ) {
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo image to server
                $blog->update([ 'image_logo' => $path ]);
            }

            if ( isset($request->image_icon) ) {
                $path = $request->file('image_icon')->store('uploads/cover', 'public'); // upload cover image to server
                $blog->update([ 'image_icon' => $path ]);
            }

            return redirect()->route('blog-categories.index')->withSuccess('Created blog category "' . $request->title . '"');
        }

    public function edit($id)
        {
            $category = blogCategories::where('id',  '=', $id)->first();
            $categories = blogCategories::orderByDesc('id')->paginate(15);
            return view('content.blog.categories.form', compact('category', 'categories'));
        }

    public function update(Request $request, $id)
        {
            $category = blogCategories::where('id',  '=', $id)->first();
            $category->update($request->all()); // update blogCategory

            if ( isset($request->image_logo) ) { // update logo
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo to server
                $category->update([ 'image_logo' => $path ]);
            }
            if ( empty($request->image_logo_prev) && empty($request->image_logo) ) // delete logo
                $category->update([ 'image_logo' => null ]);

            if ( isset($request->image_icon) ) { // update cover
                $path = $request->file('image_icon')->store('uploads/cover', 'public'); // upload cover to server
                $category->update([ 'image_icon' => $path ]);
            }
            if ( empty($request->image_icon_prev) && empty($request->image_icon) ) // delete cover
                $category->update([ 'image_icon' => null ]);

            if ( empty($request->features_checkbox) )
                $category->update([ 'features_checkbox' => null ]);

            if ( empty($request->disable_checkbox) )
                $category->update([ 'disable_checkbox' => null ]);

            if ( empty($request->categories) )
                $category->update([ 'categories' => null ]);

            if ( empty($request->seo_keywords) )
                $category->update([ 'seo_keywords' => null ]);

            return redirect()->route('blog-categories.index')->withSuccess('Updated blog category "' . $request->title . '"');
        }

    public function destroy($id)
        {
            $category = blogCategories::where('id',  '=', $id)->first();
            $category->delete();

            return redirect()->route('blog-categories.index')->withSuccess('Deleted blog category "' . $category->title . '"');

        }
}
