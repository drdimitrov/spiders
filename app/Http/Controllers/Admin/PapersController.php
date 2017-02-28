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
	        'author' => 'required',
	        'name' => 'required',
	    ]);

	    $author = Author::find($request->author);
	    $published = $request->published_at ?: 'unpublished';
	    $slug = $author->last_name . '-' . $published . '-' .str_limit($request->name, 50);
	    
    	$paper = Paper::create([
			'author_id' => $request->author,
			'name' => $request->name,
			'journal' => $request->journal,
			'published_at' => $request->published_at,
			'slug' => str_replace('.', '', str_replace(' ', '-', $slug)),
		]);

		if($paper->save()){
			return redirect(route('literature'));
		}
    }
}
