<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Family;

class GenusController extends Controller
{
    public function index(){
    	//
    }

    public function show(Request $request){
    	//
    }

    public function showFamilyGenera(Request $request){
    	$family = Family::with('genera')->where('slug', $request->family)->first();
    	return view('front.genera', compact('family'));
    }
}
