<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deals;
use App\Models\Listings;

class dealsController extends Controller
{
    public function index()
        {
            $deals = Deals::orderByDesc('id')->paginate(15);
            return view('content.deals.dashboard', compact('deals'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            $listings = Listings::query()->paginate(0);

            return view('content.deals.form', compact('users', 'listings'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'deal_start_date' => 'required',
                'deal_end_date' => 'required',
                'real_price_int' => 'required',
                'deal_price_int' => 'required'
            ]);

            // return dd($request->all());
            $deal = Deals::create($request->all()); // create deal

            if ( isset($request->image_logo) ) {
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo image to server
                $deal->update([ 'image_logo' => $path ]);
            }

            if ( isset($request->image_cover) ) {
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover image to server
                $deal->update([ 'image_cover' => $path ]);
            }

            return redirect()->route('deals.index')->withSuccess('Created deal "' . $request->title . '"');
        }

    public function edit(Deals $deal)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            $listings = Listings::query()->paginate(0);

            return view('content.deals.form', compact('deal', 'users', 'listings'));
        }

    public function update(Request $request, Deals $deal)
        {
            $deal->update($request->all()); // update deal

            if ( isset($request->image_logo) ) { // update logo
                $path = $request->file('image_logo')->store('uploads/logo', 'public'); // upload logo to server
                $deal->update([ 'image_logo' => $path ]);
            }
            if ( empty($request->image_logo_prev) && empty($request->image_logo) ) { // delete logo
                $deal->update([ 'image_logo' => null ]);
            }
            if ( isset($request->image_cover) ) { // update cover
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover to server
                $deal->update([ 'image_cover' => $path ]);
            }
            if ( empty($request->image_cover_prev) && empty($request->image_cover) ) { // delete cover
                $deal->update([ 'image_cover' => null ]);
            }

            return redirect()->route('deals.index')->withSuccess('Updated deal "' . $request->title . '"');
        }

    public function destroy(Deals $deal)
        {
            $deal->delete();

            return redirect()->route('deals.index')->withDanger('Deleted deal "' . $deal->title . '"');

        }


}
