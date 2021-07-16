<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listings;

class listingsController extends Controller
{
    public function index()
        {
            $listings = Listings::orderByDesc('id')->paginate(15);
            return view('content.listings.dashboard', compact('listings'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            return view('content.listings.form', compact('users'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            // return dd($request->file());
            $listing = Listings::create($request->all()); // create listing

            // upload gallery
            $images = [];
            if ($request->hasFile('image_gallery')) {
                foreach($request->file('image_gallery') as $key => $image){
                    $images[] = $image->store('uploads/gallery', 'public');
                }
                $gallery_path = $images;
                $listing->update([ 'image_gallery' => $gallery_path ]);
            }

            if ( isset($request->image_logo) ) {
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo image to server
                $listing->update([ 'image_logo' => $path ]);
            }

            if ( isset($request->image_cover) ) {
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover image to server
                $listing->update([ 'image_cover' => $path ]);
            }

            return redirect()->route('listings.index')->withSuccess('Created listing "' . $request->title . '"');
        }

    public function edit(Listings $listing)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.listings.form', compact('listing', 'users'));
        }

    public function update(Request $request, Listings $listing)
        {
            $listing->update($request->all()); // update listing

            if ( isset($request->image_logo) ) { // update logo
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo to server
                $listing->update([ 'image_logo' => $path ]);
            }
            if ( empty($request->image_logo_prev) && empty($request->image_logo) ) { // delete logo
                $listing->update([ 'image_logo' => null ]);
            }

            if ( isset($request->image_cover) ) { // update cover
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover to server
                $listing->update([ 'image_cover' => $path ]);
            }
            if ( empty($request->image_cover_prev) && empty($request->image_cover) ) { // delete cover
                $listing->update([ 'image_cover' => null ]);
            }
            // upload gallery
            $images = [];
            if ($request->hasFile('image_gallery')) {
                foreach($request->file('image_gallery') as $key => $image){
                    $images[] = $image->store('uploads/gallery', 'public');
                }
                $gallery_path = $images;
            }
            if ( isset($request->image_gallery_prev) )
                $gallery_path = array_merge($images, $request->image_gallery_prev);

            if ( isset($gallery_path) )
                $listing->update([ 'image_gallery' => $gallery_path ]);
            else
                $listing->update([ 'image_gallery' => null ]);

            if ( empty($request->basic_disable_claim) ) // set checkbox to null if its clear
                $listing->update([ 'basic_disable_claim' => null ]);

            if ( empty($request->features) ) // set features no null if its clear
                $listing->update([ 'features' => null ]);

            if ( empty($request->hours_work) ) // set hours work no null if its clear
                $listing->update([ 'hours_work' => null ]);

            return redirect()->route('listings.index')->withSuccess('Updated listing "' . $request->title . '"');
        }

    public function destroy(Listings $listing)
        {
            $listing->delete();

            return redirect()->route('listings.index')->withDanger('Deleted listing "' . $listing->title . '"');

        }
}
