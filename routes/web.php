<?php

use App\Http\Controllers\ListingsController;
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
//show all listings
Route::get('/', [ListingsController::class, 'index']);

//show create view
Route::get("/listings/create", [ListingsController::class, 'create']);

//store listing
Route::post("/listings", [ListingsController::class, 'store']);

//show each listing
Route::get("/listings/{id}", [ListingsController::class, 'show']);
