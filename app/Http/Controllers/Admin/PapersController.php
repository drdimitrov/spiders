<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Author;
use App\Paper;

class PapersController extends Controller
{
    public function index(){
    	return view('admin.papers.index');
    }

    public function create(){
    	return view('admin.papers.create');
    }

    public function save(Request $request){
    	
    	$this->validate($request, [
	        'authors' => 'required',
	        'name' => 'required',
	        'journal' => 'required',
	    ]);

	    $authors = Author::find($request->authors);

	    $author = count($authors) > 1 ? $authors->first()->last_name.'-et-al' : $authors->first()->last_name;
	    
	    $slug = $author. '-' . $request->published_at . '-' . str_limit($request->name, 50);
	    
    	$paper = Paper::create([
			'name' => $request->name,
			'journal' => $request->journal,
			'published_at' => $request->published_at ? $request->published_at.'-01-01 00:00:01' : null,
			'slug' => str_replace(['.', '\\', '/'], '', str_replace(' ', '-', $slug)),
		]);

		if($paper->save()){
			$paper->authors()->sync($request->authors);
			return redirect(route('literature'));
		}
    }
}
