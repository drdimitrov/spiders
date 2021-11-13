<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Family;
use App\Species;

class SearchController extends Controller
{
    public function index(){
    	return view('front.search');
    }

    public function show(Request $request){
        
        if(!$request->family && !$request->genus_id && !$request->species_id){
            return back();
        }

    	if($request->has('family')){
    		$family = Family::find($request->family);
    		return redirect(route('genera.family', $family->slug));
    	}

    	if($request->has('genus_id')){
    		$genus = Genus::find($request->genus_id);
    		return redirect(route('species.genus', $genus->slug));
    	}

    	if($request->has('species_id')){
    		$species = Species::find($request->species_id);
    		
    		if(!$species){ abort(404); }
    		
    		return redirect(route('species', $species->id));
    	}

        return back();
    	
    }
}
