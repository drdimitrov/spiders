<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Species;

class SpeciesController extends Controller
{
    
    public function showGenusSpecies(Request $request){
    	
    	$genus = Genus::with(['species' => function($species){
            $species->orderBy('name');
        }, 'species.paper.authors'])->where('slug', $request->genus)->first();

    	return view('front.species', compact('genus'));
    }

    public function show(Request $request){

        $species = Species::with('genus')->find($request->species);

        if(! $species){
            return redirect('/');
        }
    	
        return view('front.single-species', compact('species'));
    }
}
