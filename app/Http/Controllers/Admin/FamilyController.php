<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Family;
use App\Services\WscService;

class FamilyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }

    public function index(){
        $families = Family::orderBy('name')->get();
        return view('admin.family.index', compact('families'));
    }
    
    public function create(Request $request){
    	return view('admin.family.create');
    }

    public function save(Request $request, WscService $wsc){

//    	$this->validate($request, [
//	        'name' => 'required|unique:families|alpha',
//	        'author' => 'required',
//	    ]);

        $this->validate($request, ['wsc_lsid' => 'required']);

        $family = $wsc->fetchFamily($request->wsc_lsid);
dd($family);
        if($family->taxon->status != 'VALID'){

            // Fetch the valid one
            return back()->with('msg-err', 'The family is not valid.');
        }

        $existingFamily = Family::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spiderfam:', '', $family->taxon->lsid))->first();

        if($existingFamily){
            return back()->with('msg-err', 'The family already exists.');
        }


        $family = Family::create([
	    	'name' => $family->taxon->family,
	    	'order_id' => 2,
	    	'slug' => strtolower($family->taxon->family),
	    	'author' => $family->taxon->author,
	    	'wsc_id' => $request->wsc_lsid,
    	]);

    	if($family->save()){
    		return redirect(route('admin.family.create'))->withMsg('The new family was created successfully');
    	}

    	return redirect(route('admin.family.create'))->withMsg('Whoops, something went wrong.');
    }

    public function edit(Family $family){
        return view('admin.family.edit', compact('family'));
    }

    public function update(Request $request){

        $family = Family::find($request->id);
        $family->name = $request->name;
        $family->slug = $request->slug;
        $family->author = $request->author;
        $family->wsc_lsid = $request->wsc_lsid;

        if($family->save()){
            return redirect(route('admin.family'));
        }

    }
}
