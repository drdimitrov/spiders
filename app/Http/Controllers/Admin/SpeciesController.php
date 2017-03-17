<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genus;

class SpeciesController extends Controller
{
    public function create(){
    	return view('admin.species.create', ['genera' => Genus::orderBy('name')->get()]);
    }

    public function save(Request $request){
    	dd($request->all());
    }
}
