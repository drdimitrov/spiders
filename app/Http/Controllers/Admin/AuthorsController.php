<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Author;

class AuthorsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
    public function index(Request $request){
    	$authors = $request->has('author') ? Author::where('id', $request->author)->get() : Author::orderBy('last_name')->get();
    	  	
    	return view('admin.authors.index', compact('authors'));
    }

    public function create(){
    	return view('admin.authors.create');
    }

    public function save(Request $request){


    	$this->validate($request, [
	        'first_name' => 'required|unique_with:authors,last_name',
	        'last_name' => 'required',
	    ]);

	    $author = Author::create([
	    	'first_name' => $request->first_name,
	    	'last_name' => $request->last_name,
    	]);

    	if($author->save()){
    		return redirect(route('admin.authors'))->with('msg-success', 'Author has been saved.');
    	}
	}

    public function edit(Author $author){
        return view('admin.authors.edit', compact('author'));
    }

    public function saveAuthor(Request $request){

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'id' => 'required',
        ]);

        $author = Author::find($request->id);
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->save();

        return redirect(route('admin.authors'));
    }
}