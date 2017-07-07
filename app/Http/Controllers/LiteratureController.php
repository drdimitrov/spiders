<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\Author;

class LiteratureController extends Controller
{
    public function index(Request $request){
    	
    	if($request->has('author')){
    		$singleAuth = Author::with(['papers' => function($query){
    			$query->orderBy('published_at');
    		}])->where('id', $request->author)->get();

    		return view('front.literature', compact('singleAuth'));
    	}

    	$literature = Paper::with(['authors' => function($query){
    		$query->orderBy('author_paper.id');
    	}])->orderBy('published_at')->paginate(50);

        
        $litarr = [];

        foreach($literature as $lit){ 
            $litarr[$lit->id] = [
                'name' => $lit->name, 
                'journal' => $lit->journal,
                'slug' => $lit->slug,
                'published_at' => $lit->published_at,
                'created_at' => $lit->created_at,
                'updated_at' => $lit->updated_at,
            ];

            foreach($lit->authors as $a){
                $litarr[$lit->id]['authors'][] = $a->last_name . ' ' . str_limit($a->first_name, 1, '');
            }

            $litarr[$lit->id]['authors'] = implode(', ', $litarr[$lit->id]['authors']);
        }

        usort($litarr, function($a, $b) {
            return $a['authors'] <=> $b['authors'];
        });

        dd(collect($litarr));
    	    	
    	return view('front.literature', compact('literature'));
    	
    }

    public function show(Paper $paper){
    	return view('front.single-paper', compact('paper'));
    }
}
