<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Family;
use App\Genus;

class GenusController extends Controller
{
    public function create(){
    	return view('admin.genus.create', ['families' => Family::all()]);
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:genera|alpha',
	        'sel1' => 'required|integer',
	        'family' => 'required|integer',
	    ]);

	    $genus = Genus::create([
	    	'name' => $request->name,
	    	'slug' => strtolower($request->name),
	    	'paper_id' => $request->sel1,
	    	'family_id' => $request->family,
    	]);

    	if($genus->save()){
    		return redirect(route('admin.genus.create'))->withMsg('Genus has been created successfully.');
    	}
    }
}
