<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;

class FamilyController extends Controller
{

    public function index(){

    	$families = Family::withCount(['genera', 'species'])->orderBy('name')->get();

    	$generaCount = 0;
    	$speciesCount = 0;

    	foreach($families as $family){
    		$generaCount += $family->genera_count;
    		$speciesCount += $family->species_count;
    	}
    
    	return view('front.families', compact('families', 'generaCount', 'speciesCount'));
    }
}
