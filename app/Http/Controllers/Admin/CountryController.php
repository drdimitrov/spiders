<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;

class CountryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }

    public function index(){
    	$countries = Country::orderBy('name')->get();

    	return view('admin.countries.index', compact('countries'));
    }

    public function create(){
    	return view('admin.countries.create');
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:countries|alpha',
	        'slug' => 'required',
	    ]);

	    $country = Country::create([
	    	'name' => $request->name,
	        'slug' => $request->slug,
    	]);

    	if($country->save()){
    		return redirect(route('admin.country'));
    	}
    }

    public function edit(Country $country){
    	return view('admin.countries.edit', compact('country'));
    }

    public function saveCountry(Request $request){
        $country = Country::find($request->id);
        $country->name = $request->name;
        $country->slug = $request->slug;

        if($country->save()){
            return redirect(route('admin.country'));
        }
    }
}
