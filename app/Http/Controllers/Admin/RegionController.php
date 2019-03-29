<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\Country;

class RegionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }

    public function index(){
    	$regions = Region::all();

    	return view('admin.regions.index', compact('regions'));
    }

    public function create(){
    	$countries = Country::all();
    	return view('admin.regions.create', compact('countries'));
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:regions|regex:/^[\pL\s\-]+$/u',
	    ]);

	    $region = Region::create([
	    	'name' => $request->name,
	        'slug' => str_slug($request->name),
    	]);

    	if($region->save()){
    		$region->countries()->sync($request->countries);
    		return redirect(route('admin.region'));
    	}
    }

    public function edit(Request $request){
    	$region = Region::with('countries')->find($request->region);
        $countries = Country::orderBy('name')->get();
        $regionPlucked = $region->countries->pluck('id')->toArray();

        return view('admin.regions.edit', compact('region', 'countries', 'regionPlucked'));
    }

    public function saveRegion(Request $request){
        $region = Region::find($request->id);
        $region->name = $request->name;
        $region->slug = $request->slug;

        if($region->save()){
            $region->countries()->sync($request->countries);
            return redirect(route('admin.region'));
        }
    }

}
