<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function create(Request $request){
    	return view('admin.family.create');
    }

    public function save(Request $request){

    }
}
