<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Family;

class GenusController extends Controller
{
    public function index(){
    	$genera = Genus::with('paper.authors')->orderBy('name')->get();

        return view('front.genera-list', compact('genera'));
    }

    public function show(Request $request){
    	//
    }

    public function showFamilyGenera(Request $request){
    	$family = Family::with(['genera' => function($genus){
            $genus->orderBy('name');
        }, 'genera.paper.authors'])->where('slug', $request->family)->first();

    	return view('front.genera', compact('family'));
    }
}
