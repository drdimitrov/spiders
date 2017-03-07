<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\Author;

class LiteratureController extends Controller
{
    public function index(Request $request){

    	$literature = Paper::with(['authors' => function($query){
    		$query->orderBy('author_paper.id');
    	}])->orderBy('published_at')->paginate(20);

    	if($request->has('author')){
    		$singleAuth = Author::with('papers')->where('id', $request->author)->paginate(20);
    		dd($singleAuth);
    	}


    	
    	return view('front.literature', compact('literature'));
    	
    }
}
