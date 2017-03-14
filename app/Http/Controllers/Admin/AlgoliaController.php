<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Author;

class AlgoliaController extends Controller
{
    public function selectPaper(Request $request){

    	return Author::with(['papers' => function($query) use($request){
    		$query->where('published_at', $request->year.'-01-01 00:00:01');
    	}])->find($request->author);
    }
}
