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
            $listing = Listings::create($request->all()); // create listing

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

            if ( !empty($listing->basic_keywords) )
                $basic_keywords = $listing->basic_keywords;

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


            if ( empty($request->basic_disable_claim) ) { // set checkbox to null if clear
                $listing->basic_disable_claim = null;
              $listing->save();
            }

            return redirect()->route('listings.index')->withSuccess('Updated listing "' . $request->title . '"');
        }

    public function destroy(Listings $listing)
        {
            $listing->delete();

            return redirect()->route('listings.index')->withDanger('Deleted listing "' . $listing->title . '"');

        }
}
