<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class LiteratureController extends Controller
{
    public function index(Request $request){

    	$literature = Paper::with(['authors' => function($query){
    		$query->orderBy('author_paper.id');
    	}])->orderBy('published_at')->paginate(20);

    	// if($request->has('author')){
    	// 	$literature = 
    	// }

    	
    	return view('front.literature', compact('literature'));
    	
    }
}
