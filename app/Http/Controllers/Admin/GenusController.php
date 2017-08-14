<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Family;
use App\Genus;

class GenusController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
    public function index(){
        $genera = Genus::with('family')->orderBy('genera.name')->get();

        return view('admin.genus.index', compact('genera'));
    }

    public function create(){
    	return view('admin.genus.create', ['families' => Family::all()]);
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:genera|alpha',
	        'author' => 'required',
	        'family' => 'required|integer',
	    ]);

	    $genus = Genus::create([
	    	'name' => $request->name,
	    	'slug' => strtolower($request->name),
	    	'author' => $request->author,
	    	'family_id' => $request->family,
    	]);

    	if($genus->save()){
    		return redirect(route('admin.genus.create'))->withMsg('Genus has been created successfully.');
    	}
    }

    public function edit(Genus $genus){
        $families = Family::all();
        return view('admin.genus.edit', compact('genus', 'families'));
    }

    public function saveGenus(Request $request){
        $genus = Genus::find($request->id);
        $genus->name = $request->name;
        $genus->author = $request->author;
        $genus->slug = $request->slug;
        $genus->wsc_lsid = $request->wsc_lsid;
        $genus->family_id = $request->family_id;

        if($genus->save()){
            return redirect(route('admin.genus'));
        }
    }
}
