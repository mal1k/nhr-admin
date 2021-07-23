<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;

class eventsController extends Controller
{
    //
    public function index()
        {
            $events = Events::orderByDesc('id')->paginate(15);
            return view('content.events.dashboard', compact('events'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            return view('content.events.form', compact('users'));
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);

            // return dd($request->file());
            $listing = Events::create($request->all()); // create listing

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

            return redirect()->route('events.index')->withSuccess('Created listing "' . $request->title . '"');
        }

    public function edit(Events $event)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.events.form', compact('event', 'users'));
        }
}
