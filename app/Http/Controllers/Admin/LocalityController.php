<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locality;
use App\Region;
use App\Country;

class LocalityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
    public function index(Request $request){

        if($request->ajax()){
            $localities = Locality::with('country', 'region');
            return datatables($localities)->toJson();
        }

    	return view('admin.localities.index');
    }

    public function create(){
    	$regions = Region::orderBy('name')->get();
    	$countries = Country::orderBy('name')->get();
    	return view('admin.localities.create', compact('regions', 'countries'));
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:localities',
	        'region_id' => 'required',
	        'country_id' => 'required',
            'latitude' => 'numeric|between:0,99.999999|nullable',
            'longitude' => 'numeric|between:0,99.999999|nullable'
	    ]);

	    $locality = Locality::create([
	    	'name' => $request->name,
	    	'slug' => str_slug($request->name),
	    	'latitude' => $request->has('latitude') ? $request->latitude : null,
	    	'longitude' => $request->has('longitude') ? $request->longitude : null,
	    	'region_id' => $request->region_id,
	    	'country_id' => $request->country_id,
    	]);

    	return redirect(route('admin.locality'));

    }

    public function edit(Locality $locality){
    	$regions = Region::orderBy('name')->get();
    	$countries = Country::orderBy('name')->get();
    	return view('admin.localities.edit', compact('locality', 'regions', 'countries'));
    }

    public function saveLocality(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:regions',
            'slug' => 'required',
            'region_id' => 'required',
            'country_id' => 'required',
            'latitude' => 'numeric|between:0,99.999999|nullable',
            'longitude' => 'numeric|between:0,99.999999|nullable'
        ]);

    	$locality = Locality::find($request->id);
    	$locality->name = $request->name;
    	$locality->slug = str_slug($request->slug, '-');
    	$locality->latitude = $request->has('latitude') ? $request->latitude : null;
    	$locality->longitude = $request->has('longitude') ? $request->longitude : null;
    	$locality->region_id = $request->region_id;
    	$locality->country_id = $request->country_id;

    	if($locality->save()){
    		return redirect(route('admin.locality'));
    	}

    }
}
