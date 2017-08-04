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
	        'name' => 'required|unique_with:species,genus_id|alpha_dash',
	        'author' => 'required',
	        'genus_id' => 'required|integer',
            'es_id' => 'integer|nullable',
	    ]);

	    $species = Species::create([
	    	'name' => trim($request->name),
	    	'slug' => strtolower($request->name),
	    	'author' => trim($request->author),
	    	'genus_id' => (int) $request->genus_id,
            'es_id' => (int) $request->es_id,
            'wsc_lsid' => trim($request->wsc_lsid),

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
            'name' => 'required|alpha_dash',
            'author' => 'required',
            'genus_id' => 'required|integer',
            'es_id' => 'integer|nullable',
        ]);
        
        $species = Species::find($request->id);
        $species->name = trim($request->name);       
        $species->author = trim($request->author);       
        $species->slug = trim($request->slug);       
        $species->genus_id = (int) $request->genus_id;
        $species->es_id = (int) $request->es_id;
        $species->wsc_lsid = trim($request->wsc_lsid);

        if($species->save()){
            return redirect(route('admin.species'));
        }       
    }
}
