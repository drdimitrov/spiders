<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;

class SpeciesController extends Controller
{
    public function index(){
    	//
    }

    public function showGenusSpecies(Request $request){
    	
    	$genus = Genus::with(['species' => function($species){
            $species->orderBy('name');
        }, 'species.paper.authors'])->where('slug', $request->genus)->first();

    	return view('front.species', compact('genus'));
    }

    public function show(Request $request){
    	//
    }
}
