<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\listingsCategories;
use App\Models\User;
use Illuminate\Http\Request;

class listingsCategoriesController extends Controller
{
    public function index() {
        $categories = listingsCategories::orderByDesc('id')->paginate(15);
        return view('content.listings.categories.dashboard', compact('categories'));
    }

    public function create()
        {
            $categories = listingsCategories::orderByDesc('id')->paginate(15);
            return view('content.listings.categories.form', compact('categories'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $listing = listingsCategories::create($request->all()); // create listing

            if ( isset($request->image_logo) ) {
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo image to server
                $listing->update([ 'image_logo' => $path ]);
            }

            if ( isset($request->image_icon) ) {
                $path = $request->file('image_icon')->store('uploads/cover', 'public'); // upload cover image to server
                $listing->update([ 'image_icon' => $path ]);
            }

            return redirect()->route('listing-categories.index')->withSuccess('Created listing category "' . $request->title . '"');
        }

    public function edit($id)
        {
            $category = listingsCategories::where('id',  '=', $id)->first();
            $categories = listingsCategories::orderByDesc('id')->paginate(15);
            return view('content.listings.categories.form', compact('category', 'categories'));
        }

    public function update(Request $request, $id)
        {
            $category = listingsCategories::where('id',  '=', $id)->first();
            $category->update($request->all()); // update listingsCategory

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

            return redirect()->route('listing-categories.index')->withSuccess('Updated listing category "' . $request->title . '"');
        }

    public function destroy($id)
        {
            $category = listingsCategories::where('id',  '=', $id)->first();
            $category->delete();

            return redirect()->route('listing-categories.index')->withDanger('Deleted listing category "' . $category->title . '"');

        }
}
