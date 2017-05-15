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

        $region = Region::find($request->region); 

        $locality = Locality::with('species.genus')->where('region_id', $request->region)->get();

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

        ksort($species);

        $species = collect($species);
        
        return view('front.statistics.region.show', compact('region', 'species'));
    }
}
