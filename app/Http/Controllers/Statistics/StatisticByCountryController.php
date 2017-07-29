<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;

class StatisticByCountryController extends Controller
{
    public function index(){

    	$countries = Country::all();
    	return view('front.statistics.country.index', compact('countries'));
    }

    public function country(Request $request){

    	$country = Country::with('localities')->find($request->country);
    	return view('front.statistics.country.country', compact('country'));
    }
}
