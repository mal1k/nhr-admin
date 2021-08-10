<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\listingsCategories;
use App\Models\listingTypes;
use Illuminate\Http\Request;

class listingTypesController extends Controller
{
    public function index()
        {
            $listingTypes = listingTypes::orderByDesc('id')->paginate(15);
            return view('content.listingTypes.dashboard', compact('listingTypes'));
        }

    public function create()
        {
            $listingCategories = listingsCategories::orderByDesc('id')->paginate(0);
            return view('content.listingTypes.form', compact('listingCategories'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            listingTypes::create($request->all()); // create listingTypes

            return redirect()->route('listing-types.index')->withSuccess('Created listing type "' . $request->title . '"');
        }

    public function edit(listingTypes $listingType)
        {
            $listingCategories = listingsCategories::orderByDesc('id')->paginate(0);
            return view('content.listingTypes.form', compact('listingType', 'listingCategories'));
        }

    public function update(Request $request, listingTypes $listingType)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $listingType->update($request->all()); // update listingType

            if ( empty($request->extra_dropdown_fields_checkbox) )
                $listingType->update([ 'extra_dropdown_fields_checkbox' => null ]);
            if ( empty($request->extra_text_fields_checkbox) )
                $listingType->update([ 'extra_text_fields_checkbox' => null ]);
            if ( empty($request->extra_short_description_fields_checkbox) )
                $listingType->update([ 'extra_short_description_fields_checkbox' => null ]);
            if ( empty($request->extra_long_description_fields_checkbox) )
                $listingType->update([ 'extra_long_description_fields_checkbox' => null ]);


            return redirect()->route('listing-types.index')->withSuccess('Updated listing type "' . $request->title . '"');
        }

    public function destroy(listingTypes $listingType)
        {
            $listingType->delete();
            return redirect()->route('listing-types.index')->withSuccess('Deleted listing type "' . $listingType->title . '"');
        }
}

