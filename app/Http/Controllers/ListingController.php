<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        return view('listings.index',[ 
            'listings'=>Listing::latest()->filter
            (request(['tag', 'search']))->paginate(6)
        ]);

    }


    //show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=>$listing
        ]);

    }

    // show create form
    public function create(){
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request){
        $formFieleds = $request->validate([
            'title'=> 'required',
            'company'=>['required', Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo'))
        {
            $formFieleds['logo']=$request->file('logo')->store('logos','public');
        }

        $formFieleds['user_id'] = auth()->id(); 
        Listing::create($formFieleds);

        return redirect('/')->with('message', 'Listing created successfully!');

    }

    
      // show edit form
      public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }


     //Update listing data
     public function update(Request $request, Listing $listing){
        $formFieleds = $request->validate([
            'title'=> 'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo'))
        {
            $formFieleds['logo']=$request->file('logo')->store('logos','public');
        }

        $listing->update($formFieleds);

        return back()->with('message', 'Listing updated successfully!');

    }

    //Delete Listing
    public function destory(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', 'Listing delete successfully!');
    
    }

    //Manage Listings
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()]);
    }

  
   
}
