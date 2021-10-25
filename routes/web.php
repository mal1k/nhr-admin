<?php
use App\Http\Controllers\content\bannersController;
use App\Http\Controllers\content\blogCategoriesController;
use App\Http\Controllers\content\blogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customers\UsersController;
use App\Http\Controllers\customers\businessController;
use App\Http\Controllers\content\listingsController;
use App\Http\Controllers\content\dealsController;
use App\Http\Controllers\content\eventsCategoriesController;
use App\Http\Controllers\content\eventsController;
use App\Http\Controllers\content\exportController;
use App\Http\Controllers\content\faqController;
use App\Http\Controllers\content\importController;
use App\Http\Controllers\content\listingsCategoriesController;
use App\Http\Controllers\content\listingTypesController;
use App\Http\Controllers\content\referedByController;
use Elasticsearch\ClientBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('elastic', 'elastic');
Route::get('/elastic/listings', function () {

    if ( !isset($_GET['text']) ) {
        echo json_encode(["error" => "Search text was not set"]);
        die();
    }


    $params = [
        'index' => 'listings',
        'body'  => [
            'query' => [
                'function_score' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $_GET['text'],
                            'type' => 'best_fields',
                            'fields' => [
                                'listing_title',
                                'listing_description'
                            ],
                            'fuzziness' => 5,
                            'prefix_length' => 2
                        ]
                    ]
                ]
            ]
        ]
    ];

    $client = ClientBuilder::create()
        ->setHosts([
            "http://localhost:9200"
        ])
        ->build();

    $temporary_array = array();
    $response = $client->search($params);

    foreach ($response['hits']['hits'] as &$value) {
        $temporary_array[] = $value['_source'];
    }

    echo json_encode($temporary_array);

});



Route::redirect('/', 'manager', 301);
Route::redirect('dashboard', '/manager', 301);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::resource('/manager/users', UsersController::class);
        Route::resource('/manager/business', businessController::class);
        Route::resource('/manager/listings', listingsController::class);
        Route::resource('/manager/listing-categories', listingsCategoriesController::class);
        Route::resource('/manager/events', eventsController::class);
        Route::resource('/manager/event-categories', eventsCategoriesController::class);
        Route::resource('/manager/deals', dealsController::class);
        Route::resource('/manager/banners', bannersController::class);
        Route::resource('/manager/blog', blogController::class);
        Route::resource('/manager/blog-categories', blogCategoriesController::class);
        Route::resource('/manager/faq', faqController::class);
        Route::resource('/manager/listing-types', listingTypesController::class);
        Route::resource('/manager/export', exportController::class);
        Route::post('/manager/export/cloud/export', [exportController::class, 'cloudexport'])->name('export.cloudexport');
        Route::post('/manager/export/local/export', [exportController::class, 'localexport'])->name('export.localexport');
        Route::get('/manager/export/download/{filename}', [exportController::class, 'download_file'])->name('export.downloadfile');
        Route::get('/manager/export/delete/{filename}', [exportController::class, 'delete_file'])->name('export.deletefile');
        Route::resource('/manager/import', importController::class);
        Route::resource('/manager/refered_by', referedByController::class);
    });
});


Route::middleware(['auth:sanctum', 'verified'])->get('/manager', function () {
    return view('new-dashboard');
})->name('dashboard');

