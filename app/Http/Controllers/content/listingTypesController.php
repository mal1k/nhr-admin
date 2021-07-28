<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
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
            return view('content.listingTypes.form');
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            listingTypes::create($request->all()); // create listingTypes

            return redirect()->route('listingTypes.index')->withSuccess('Created listing type "' . $request->title . '"');
        }

    public function edit(listingTypes $listingTypes)
        {
            return view('content.listingTypes.form', compact('listingTypes'));
        }

    public function update(Request $request, listingTypes $listingTypes)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            $listingTypes->update($request->all()); // update listingTypes

            if ( empty($request->front) )
                $listingTypes->update([ 'front' => null ]);

            if ( empty($request->sponsors) )
                $listingTypes->update([ 'sponsors' => null ]);


            return redirect()->route('listingTypes.index')->withSuccess('Updated listing type "' . $request->title . '"');
        }

    public function destroy(listingTypes $listingTypes)
        {
            $listingTypes->delete();
            return redirect()->route('listingTypes.index')->withDanger('Deleted listingTypes "' . $listingTypes->question . '"');
        }
}

