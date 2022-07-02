<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingsController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'heading' => "Latest Listings",
            "Listings" => Listing::latest()->filter(request(['search']))->get()
        ]);
    }
    public function show($id)
    {
        $Listing = Listing::find($id);

        if ($Listing) {
            return view('listings.show', [
                'Listing' => $Listing,
            ]);
        } else {
            return abort("404");
        }
    }
}
