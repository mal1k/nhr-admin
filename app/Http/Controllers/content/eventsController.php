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
            $event = Events::create($request->all()); // create event

            // upload gallery
            $images = [];
            if ($request->hasFile('image_gallery')) {
                foreach($request->file('image_gallery') as $key => $image){
                    $images[] = $image->store('uploads/gallery', 'public');
                }
                $gallery_path = $images;
                $event->update([ 'image_gallery' => $gallery_path ]);
            }

            if ( isset($request->image_cover) ) {
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover image to server
                $event->update([ 'image_cover' => $path ]);
            }

            return redirect()->route('events.index')->withSuccess('Created event "' . $request->title . '"');
        }

    public function edit(Events $event)
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);

            return view('content.events.form', compact('event', 'users'));
        }

    public function update(Request $request, Events $event)
        {
            $event->update($request->all()); // update event

            if ( isset($request->image_cover) ) { // update cover
                $path = $request->file('image_cover')->store('uploads/cover', 'public'); // upload cover to server
                $event->update([ 'image_cover' => $path ]);
            }
            if ( empty($request->image_cover_prev) && empty($request->image_cover) ) { // delete cover
                $event->update([ 'image_cover' => null ]);
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
                $event->update([ 'image_gallery' => $gallery_path ]);
            else
                $event->update([ 'image_gallery' => null ]);

            if ( empty($request->basic_keywords) )
                $event->update([ 'basic_keywords' => null ]);

            if ( empty($request->seo_keywords) )
                $event->update([ 'seo_keywords' => null ]);

            if ( empty($request->event_recurring_event) )
                $event->update([ 'event_recurring_event' => null ]);

            if ( empty($request->event_recurring_dayofweek) )
            $event->update([ 'event_recurring_dayofweek' => null ]);

            return redirect()->route('events.index')->withSuccess('Updated event "' . $request->title . '"');
        }

    public function destroy(Events $event)
        {
            $event->delete();

            return redirect()->route('events.index')->withDanger('Deleted event "' . $event->title . '"');

        }
}
