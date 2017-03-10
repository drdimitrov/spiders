<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\Author;

class LiteratureController extends Controller
{
    public function index(Request $request){
    	
    	// if($request->has('author')){
    	// 	$singleAuth = Author::with(['papers' => function($query){
    	// 		$query->orderBy('published_at');
    	// 	}])->where('id', $request->author)->paginate(20);

    	// 	return view('front.literature', compact('singleAuth'));
    	// }

    	// $literature = Paper::with(['authors' => function($query){
    	// 	$query->orderBy('author_paper.id');
    	// }])->orderBy('published_at')->paginate(20);

    	$literature = \DB::table('papers')->select(
    		'papers.name AS name',
    		'papers.published_at AS published',
    		'authors.last_name AS author_last_name',
    		'authors.first_name AS author_first_name'
		)->leftJoin('author_paper', 'author_paper.paper_id', '=', 'papers.id')
		 ->leftJoin('authors', 'authors.id', '=', 'author_paper.author_id');
		
		
		dd($literature->get());

    	
    	return view('front.literature', compact('literature'));
    	
    }

    public function show(Paper $paper){
    	return view('front.single-paper', compact('paper'));
    }
}
