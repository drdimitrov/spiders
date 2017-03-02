<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class LiteratureController extends Controller
{
    public function index(Request $request){

    	// $literature = Paper::with(['authors' => function($query){
    	// 	$query->orderBy('author_paper.id');
    	// }])->orderBy('published_at')->paginate(20);

    	// if($request->has('author')){
    	// 	$literature = 
    	// }

    	$literature = Paper::with(['authors' => function($query){
    		$query->whereIn($request->author, );
    		$query->orderBy('author_paper.id');
    	}])->orderBy('published_at')->paginate(20);

    	
    	return view('front.literature', compact('literature'));
    	
    }
}
