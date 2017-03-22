<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Family;

class FamilyController extends Controller
{
    public function create(Request $request){
    	return view('admin.family.create');
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:families|alpha',
	        'author' => 'required',
	    ]);

	    $family = Family::create([
	    	'name' => $request->name,
	    	'order_id' => 2,
	    	'slug' => strtolower($request->name),
	    	'author' => $request->author,
    	]);

    	if($family->save()){
    		return redirect(route('admin.family.create'))->withMsg('The new family was created successfully');
    	}

    	return redirect(route('admin.family.create'))->withMsg('Whoops, something went wrong.');
    }
}
