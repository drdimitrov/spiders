<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Record;

class RecordController extends Controller
{
    public function index(){
    	$localities = Record::with('localities', 'species')->get();
    	return view('admin.records.index', compact('localities'));
    }

    public function create(){
    	$species = Species::with('genus')->orderBy('name')->get();
    	$localities = Locality::orderBy('name')->get();
    	return view('admin.records.create', compact('species', 'localities'));
    }

    public function save(Request $request){
    	dd($request->all());
    }
}
