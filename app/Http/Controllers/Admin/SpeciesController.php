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

    public function index(){
        $species = Species::with('genus')->orderBy('name')->paginate(100);

        return view('admin.species.index', compact('species'));
    }
    
    public function create(){
    	return view('admin.species.create', ['genera' => Genus::orderBy('name')->get()]);
    }

    public function save(Request $request){

    	$this->validate($request, [
	        'name' => 'required|unique:species|alpha',
	        'author' => 'required',
	        'genus_id' => 'required|integer',
            'es_id' => 'integer|nullable',
            'wsc_id' => 'integer|nullable',
	    ]);

	    $species = Species::create([
	    	'name' => $request->name,
	    	'slug' => strtolower($request->name),
	    	'author' => $request->author,
	    	'genus_id' => $request->genus_id,
            'es_id' => $request->es_id,
            'wsc_id' => $request->wsc_id,
            'wsc_lsid' => $request->wsc_lsid,

    	]);

    	if($species->save()){
    		return redirect(route('admin.species.create'))->withMsg('Species has been created successfully.');
    	}
    }

    public function edit(Species $species){
        $genera = Genus::all();
        return view('admin.species.edit', compact('species', 'genera'));
    }

    public function saveSpecies(Request $request){

        $this->validate($request, [
            'name' => 'required|alpha',
            'author' => 'required',
            'genus_id' => 'required|integer',
            'es_id' => 'integer|nullable',
            'wsc_id' => 'integer|nullable',
        ]);
        
        $species = Species::find($request->id);
        $species->name = $request->name;       
        $species->author = $request->author;       
        $species->slug = $request->slug;       
        $species->genus_id = $request->genus_id;
        $species->es_id = $request->es_id;
        $species->wsc_id = $request->wsc_id;
        $species->wsc_lsid = $request->wsc_lsid;

        if($species->save()){
            return redirect(route('admin.species'));
        }       
    }
}
