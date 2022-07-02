<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

Route::get('/', function () {
    return view('Listings', [
        'heading' => "Latest Listings",
        "Listings" => Listing::all(),
    ]);
});

Route::get("/Listing/{id}", function ($id) {

    $Listing = Listing::find($id);

    if ($Listing) {
        return view('Listing', [
            'Listing' => $Listing,
        ]);
    } else {
        return abort("404");
    }
});
