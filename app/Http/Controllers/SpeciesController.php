<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index(){
    	//
    }

    public function showGenusSpecies(Request $request){
    	dd($request->all());
    }

    public function show(Request $request){
    	//
    }
}
