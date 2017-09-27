<?php

namespace App\Http\Controllers\Admin;

use App\Genus;
use App\Http\Controllers\Controller;
use App\Services\WscService;
use App\Species;
use App\Image;
use Illuminate\Http\Request;

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
	    ]);

	    $species = Species::create([
	    	'name' => trim($request->name),
	    	'slug' => strtolower($request->name),
	    	'author' => trim($request->author),
	    	'genus_id' => (int) $request->genus_id,
            'wsc_lsid' => trim($request->wsc_lsid),
    	]);

    	if($species->save()){
    		return redirect(route('admin.species.create'))->withMsg('Species has been created successfully.');
    	}
    }

    public function saveByLsid(WscService $wsc){

        $species = $wsc->fetchSpecies(request()->wsc_lsid);

        if($species->taxon->status != 'VALID'){

            // if($species->taxon->status == 'SYNONYM'){
            //     $valid = $wsc->fetchValidTaxon($species->validTaxon->_href);
            //     dd($valid->taxon);
            // }

            return back()->with('msg-err', 'The species is not valid.');
        }
        
        $existingSpecies = Species::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spidersp:', '', $species->taxon->lsid))->first();

        if($existingSpecies){
            return back()->with('msg-err', 'The species already exists.');
        }

        $genus = Genus::where('name', $species->taxon->genus)->first();
       
        $newSpecies = Species::create([
            'name' => $species->taxon->species,
            'slug' => strtolower($species->taxon->species),
            'author' => $species->taxon->author,
            'genus_id' => $genus->id,
            'wsc_lsid' => trim(request()->wsc_lsid),
        ]);
        
        if($newSpecies->save()){
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
        ]);
        
        $species = Species::find($request->id);
        $species->name = trim($request->name);       
        $species->author = trim($request->author);       
        $species->slug = trim($request->slug);       
        $species->genus_id = (int) $request->genus_id;
        $species->wsc_lsid = trim($request->wsc_lsid);

        if($species->save()){
            return redirect(route('admin.species'));
        }       
    }

    public function images(){       
        return view ('admin.species.images');
    }

    public function saveImage(Request $request){

        $this->validate($request, [
            'img' => 'required',
            'species_id' => 'required|integer',
        ]);

        $file = $request->file('img');
        $name = time() . '_' . $request->species_id . '.' . $file->guessClientExtension();

        $file->storeAs('species', $name);

        $image = Image::create([
            'name' => $name,
            'species_id' => (int) $request->species_id,
            'description' => $request->description
        ]);

        return back();
    }
}
