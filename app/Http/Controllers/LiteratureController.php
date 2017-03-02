<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class LiteratureController extends Controller
{
    public function index(Request $request){

    	$literature = Paper::with('authors')->paginate(20);
    	return view('front.literature', compact('literature'));
    	
    }
}
