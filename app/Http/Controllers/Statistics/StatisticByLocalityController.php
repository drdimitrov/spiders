<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locality;

class StatisticByLocalityController extends Controller
{
    public function index(){
    	$localities = Locality::with('country', 'region')->orderBy('name')->get();
    	return view('front.statistics.locality.index', compact('localities'));
    }

    public function locality(Request $request){
    	$locality = Locality::with('records.species.genus', 'records.paper.authors')->find($request->locality);

    	$lName = $locality->name;
    	$spLocs = [];

    	foreach($locality->records as $r){
    		
    		$pAuthors = count($r->paper->authors)  > 1? $r->paper->authors->first()->last_name.' et al. ' : $r->paper->authors->first()->last_name;
    		$spLocs[$r->species_id][$r->species->genus->name . ' ' . $r->species->name][] = [
    				'date' => $r->collected_at ? $r->collected_at->format('d-m-Y') : null,
    				'males' => $r->males ?: null,
    				'females' => $r->females ?: null,
    				'juvenile_males' => $r->juvenile_males ?: null,
    				'juvenile_females' => $r->juvenile_females ?: null,
    				'collected_by' => $r->collected_by ?: null,
    				'paper' => $pAuthors . ' ' . $r->paper->published_at->format('Y'),
    				'paper_slug' => $r->paper->slug,
    			];
    	}

    	return view('front.statistics.locality.show', compact('spLocs', 'lName'));
    }
}
