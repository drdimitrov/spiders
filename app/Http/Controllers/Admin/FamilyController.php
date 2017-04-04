<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Family;

class FamilyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }

    public function index(){
        $families = Family::all();

        return view('admin.family.index', compact('families'));
    }
    
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

    public function edit(Family $family){
        return view('admin.family.edit', compact('family'));
    }

    public function saveFamily(Request $request){
        $family = Family::find($request->id);
        $family->name = $request->name;
        $family->slug = $request->slug;
        $family->author = $request->author;

        if($family->save()){
            return redirect(route('admin.family'));
        }

    }
}
