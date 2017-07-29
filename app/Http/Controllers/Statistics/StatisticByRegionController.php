<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\Locality;
use App\Record;

class StatisticByRegionController extends Controller
{
    public function index(){
    	$regions = Region::with('countries')->orderBy('name')->get();
    	return view('front.statistics.region.index', compact('regions'));
    }

    public function region(Request $request){

        $region = Region::with('countries')->find($request->region); 

         $loc = Locality::with('species.genus')
            ->where('region_id', $request->region);

            if($request->country && $request->country != 0){
                $loc->where('country_id', $request->country);
            }

        $locality = $loc->get();

        $locSpecies = [];
        $species = [];

        foreach($locality as $l){

            if(!count($l->species)){
                continue;
            }

            $locSpecies[] = $l->species;
        }

        foreach($locSpecies as $ls){
            foreach($ls as $v){
                $species[$v->id] = $v->genus->name . ' ' . $v->name;
            }
        }

        asort($species);

        $species = collect($species);
        
        return view('front.statistics.region.show', compact('region', 'species'));
    }

    public function localitiesByRegion(){
        $regions = Region::with('countries')->orderBy('name')->get();
        return view('front.statistics.region.localities', compact('regions'));
    }

    public function localitiesByRegionShow(Request $request){
        $region = Region::with(['localities' => function($query){
            $query->orderBy('name');
        }])->find($request->region);

        return view('front.statistics.region.localities-show', compact('region'));

    }
}
