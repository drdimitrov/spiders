<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenusController extends Controller
{
    public function index(){
    	//
    }

    public function show(Request $request){
    	dd($request->all());
    }
}
