<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'heading' => "Latest Listings",
            "Listings" => Listing::latest()->filter(request(['search']))->paginate(6)
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
    public function create()
    {
        return view('listings.create');
    }
    public function store(Request $request)
    {
        $listingField = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'email' => ['required', 'email'],
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $listingField['user_id'] = auth()->id();

        Listing::create($listingField);
        return redirect('/');
    }
    //show edit form
    public function edit(Listing $id)
    {
        return view("listings.edit", ['Listing' => $id]);
    }
    //Update Listing
    public function update(Request $request, Listing $id)
    {
        //Make sure logged in user is the owner
        if ($id->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action!!!');
        }
        $listingField = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'email' => ['required', 'email'],
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $id->update($listingField);
        return redirect("/listings/manage");
    }

    //Delete listing
    public function distroy(Listing $id)
    {
        //Make sure logged in user is the owner
        if ($id->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action!!!');
        }
        $id->delete();
        return redirect("/listings/manage");
    }
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
