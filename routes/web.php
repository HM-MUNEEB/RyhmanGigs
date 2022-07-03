<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use GuzzleHttp\Middleware;

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

//show create view & Middleware for protected route
Route::get("/listings/create", [ListingsController::class, 'create'])->Middleware('auth');

//store listing
Route::post("/listings", [ListingsController::class, 'store']);

//edit listing
Route::get("/listings/{id}/edit", [ListingsController::class, 'edit']);

//Update Listing
Route::put("/listings/{id}", [ListingsController::class, 'update']);

//Delete Listing
Route::delete("/listings/{id}", [ListingsController::class, 'distroy']);

//show each listing
Route::get("/listings/{id}", [ListingsController::class, 'show']);

//Show Register/Create Form 
Route::get("/register", [UserController::class, 'create']);

//Create New User
Route::post("/users", [UserController::class, 'store']);

//Show Login
Route::get("/login", [UserController::class, 'login'])->name("login");

//Login existed User
Route::get("/users/authenticate", [UserController::class, 'authenticate']);

//Logout
Route::post("/logout", [UserController::class, 'logout']);
