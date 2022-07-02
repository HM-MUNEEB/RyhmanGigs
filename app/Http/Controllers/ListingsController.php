<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingsController extends Controller
{
    public function index()
    {
        return view('Listings', [
            'heading' => "Latest Listings",
            "Listings" => Listing::all(),
        ]);
    }
    public function show($id)
    {
        $Listing = Listing::find($id);

        if ($Listing) {
            return view('Listing', [
                'Listing' => $Listing,
            ]);
        } else {
            return abort("404");
        }
    }
}
