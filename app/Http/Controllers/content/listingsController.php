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
            $path = $request->file('image_logo')->store('uploads', 'public'); // upload image to server
            $listing->update([ 'image_logo' => $path ]);
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

            if ( isset($request->image_logo) ) { // update image
                $path = $request->file('image_logo')->store('uploads', 'public'); // upload image to server
                $listing->update([ 'image_logo' => $path ]);
            }
            if ( empty($request->image_logo_prev) && empty($request->image_logo) ) {
                $listing->update([ 'image_logo' => null ]);
            }

            if ( empty($request->basic_disable_claim) ) {
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
