<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genus;
use App\Species;

class SpeciesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
    public function create(){
    	return view('admin.species.create', ['genera' => Genus::orderBy('name')->get()]);
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|alpha',
	        'sel1' => 'required|integer',
	        'genus_id' => 'required|integer',
	    ]);

	    $species = Species::create([
	    	'name' => $request->name,
	    	'slug' => strtolower($request->name),
	    	'paper_id' => $request->sel1,
	    	'genus_id' => $request->genus_id,
            'brackets' => $request->has('brackets') ? $request->brackets : null,
    	]);

    	if($species->save()){
    		return redirect(route('admin.species.create'))->withMsg('Species has been created successfully.');
    	}
    }
}
