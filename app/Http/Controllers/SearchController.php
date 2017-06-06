<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Family;

class SearchController extends Controller
{
    public function index(){
    	return view('front.search');
    }

    public function show(Request $request){
    	if($request->has('family')){
    		$family = Family::find($request->family);
    		return redirect(route('genera.family', $family->slug));
    	}

    	if($request->has('genus_id')){
    		$genus = Genus::find($request->genus_id);
    		return redirect(route('species.genus', $genus->slug));
    	}
    	
    }
}
