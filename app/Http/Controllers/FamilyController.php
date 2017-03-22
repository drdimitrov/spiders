<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;

class FamilyController extends Controller
{
    public function index(){    	
    	return view('front.families', ['families' => Family::orderBy('name')->get()]);
    }
}
