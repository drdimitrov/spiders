<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;

class SearchController extends Controller
{
    public function index(){
    	return view('front.search');
    }

    public function show(Request $request){
    	$genus = Genus::find($request->genus_id);
    	return redirect(route('species.genus', $genus->slug));
    }
}
