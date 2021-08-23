<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listings;
use App\Models\listingsCategories;
use Elasticsearch\ClientBuilder;
use Exception;

class listingsController extends Controller
{
    public function index()
        {
            if ( isset($_GET['s']) )
                $listings = Listings::where('title', 'LIKE', '%' . $_GET['s'] . '%')
                    ->orWhere('basic_status', 'LIKE', '%' . $_GET['s'] . '%')
                    ->orWhere('level', 'LIKE', '%' . $_GET['s'] . '%')
                    ->sortable(['id' => 'desc'])
                    ->paginate(15);
            else
                $listings = Listings::sortable(['id' => 'desc'])->paginate(15);
            return view('content.listings.dashboard', compact('listings'));
        }

    public function create()
        {
            $users_query = User::query();
            $users_query->whereNotNull('business');
            $users = $users_query->paginate(0);
            $listingCategories = listingsCategories::orderByDesc('id')->paginate(0);
            return view('content.listings.form', compact('users', 'listingCategories'));
        }

    public function store(Request $request)
        {

            $client = ClientBuilder::create()
                ->setHosts([
                    "http://localhost:9200"
                ])
                ->build();

            $validated = $request->validate([
                'title' => 'required|max:255',
            ]);


            $listing = Listings::create($request->all()); // create listing
            $params = [
                'index' => 'listings',
                'id'    => $listing->id,
                'body'  => [
                    'listing_title' => $request->title
                ]
            ];

            // Document will be indexed to listings/_doc/id
            $client->index($params);

            // upload gallery
            $images = [];
            if ($request->hasFile('image_gallery')) {
                foreach($request->file('image_gallery') as $key => $image){
                    $images[] = $image->store('uploads/gallery', 'public');
                }
                $gallery_path = $images;
                $listing->update([ 'image_gallery' => $gallery_path ]);
            }

            // attach file
            if ( isset($request->attach_file) ) { // update cover
                $path = $request->file('attach_file')->store('uploads/attach', 'public'); // upload cover to server
                $listing->update([ 'attach_file' => $path ]);
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
            $listingCategories = listingsCategories::orderByDesc('id')->paginate(0);

            return view('content.listings.form', compact('listing', 'users', 'listingCategories'));
        }

    public function update(Request $request, Listings $listing)
        {
            $listing->update($request->all()); // update listing
            $client = ClientBuilder::create()
                ->setHosts([
                    "http://localhost:9200"
                ])
                ->build();

            $params = [
                'index' => 'listings',
                'id'    => $listing->id,
                'body'  => [
                    'doc' => [
                        'listing_title' => $request->title
                    ]
                ]
            ];

            // Update doc at /my_index/_doc/my_id
            $client->update($params);

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

            if ( empty($request->attach_file_prev) && empty($request->attach_file) ) { // delete cover
                $listing->update([ 'attach_file' => null ]);
            }

            // upload gallery
            $images = [];
            if ($request->hasFile('image_gallery')) {
                foreach($request->file('image_gallery') as $key => $image){
                    $images[] = $image->store('uploads/gallery', 'public');
                }
                $gallery_path = $images;
            }

            if ( isset($request->attach_file) ) { // update cover
                $path = $request->file('attach_file')->store('uploads/attach', 'public'); // upload cover to server
                $listing->update([ 'attach_file' => $path ]);
            }

            if ( isset($request->image_gallery_prev) )
                $gallery_path = array_merge($images, $request->image_gallery_prev);

            if ( isset($gallery_path) )
                $listing->update([ 'image_gallery' => $gallery_path ]);
            else
                $listing->update([ 'image_gallery' => null ]);

            if ( empty($request->basic_disable_claim) ) // set checkbox to null if its clear
                $listing->update([ 'basic_disable_claim' => null ]);

            if ( empty($request->badges_checkbox) ) // set checkbox to null if its clear
                $listing->update([ 'badges_checkbox' => null ]);

            if ( empty($request->features) ) // set features no null if its clear
                $listing->update([ 'features' => null ]);

            if ( empty($request->hours_work) ) // set hours work no null if its clear
                $listing->update([ 'hours_work' => null ]);

            if ( empty($request->basic_keywords) )
                $listing->update([ 'basic_keywords' => null ]);

            if ( empty($request->seo_keywords) )
                $listing->update([ 'seo_keywords' => null ]);

            return redirect()->route('listings.index')->withSuccess('Updated listing "' . $request->title . '"');
        }

    public function destroy(Listings $listing)
        {
            $client = ClientBuilder::create()
                ->setHosts([
                    "http://localhost:9200"
                ])
                ->build();

            $listing->delete();
            $params = [
                'index' => 'listings',
                'id'    => $listing->id
            ];

            try {
                $client->delete($params);
            } catch (Exception $e) {}

            return redirect()->route('listings.index')->withSuccess('Deleted listing "' . $listing->title . '"');

        }
}
