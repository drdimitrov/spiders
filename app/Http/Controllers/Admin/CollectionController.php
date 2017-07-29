<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Collection;

class CollectionController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }

    public function index(){
    	$collections = Collection::orderBy('place')->paginate(50);
    	return view('admin.collections.index', compact('collections'));

    }

    public function create(){
    	
    }
}
