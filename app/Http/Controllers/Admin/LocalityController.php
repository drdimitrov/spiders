<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locality;
use App\Region;
use App\Country;

class LocalityController extends Controller
{
    public function index(){
    	$localities = Locality::orderBy('name')->paginate(100);
    	return view('admin.localities.index', compact('localities'));
    }

    public function create(){
    	$regions = Region::orderBy('name')->get();
    	$countries = Country::orderBy('name')->get();
    	return view('admin.localities.create', compact('regions', 'countries'));
    }

    public function save(Request $request){
    	
    	$this->validate($request, [
	        'name' => 'required|unique:regions',
	        'slug' => 'required',
	        'region_id' => 'required',
	        'country_id' => 'required',
            'latitude' => 'numeric|between:0,99.999999',
            'longitude' => 'numeric|between:0,99.999999'
	    ]);

	    $locality = Locality::create([
	    	'name' => $request->name,
	    	'slug' => str_slug($request->slug, '-'),
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
            'latitude' => 'numeric|between:0,99.999999',
            'longitude' => 'numeric|between:0,99.999999'
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
