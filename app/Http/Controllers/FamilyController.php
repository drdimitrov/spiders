<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;

class FamilyController extends Controller
{
    public function index(){
    	$families = Family::with('paper.authors')->get();
    	return view('front.families', compact('families'));
    }
}
