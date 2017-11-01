<?php

namespace App\Http\Controllers\Statistics;

use function foo\func;
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

    	$country = Country::with(['localities' => function($query){
    		$query->with(['species' => function($s){
    		    $s->distinct();
            }]);
    		$query->orderBy('localities.name');
    	}])->find($request->country);
    	
    	return view('front.statistics.country.country', compact('country'));
    }
}
