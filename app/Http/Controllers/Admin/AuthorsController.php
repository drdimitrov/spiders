<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Author;

class AuthorsController extends Controller
{
    public function index(){
    	$authors = Author::all();    	
    	return view('admin.authors.index', compact('authors'));
    }

    public function create(){
    	return view('admin.authors.create');
    }

    public function save(Request $request){


    	$this->validate($request, [
	        'last_name' => 'required|alpha',
	        'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
	    ]);

	    $author = Author::create([
	    	'first_name' => $request->first_name,
	    	'last_name' => $request->last_name,
    	]);

    	if($author->save()){
    		return redirect(route('admin.authors'))->with('msg-success', 'Author has been saved.');
    	}
	}
}