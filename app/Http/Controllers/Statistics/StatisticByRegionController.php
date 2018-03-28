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
        }, 'localities.species' => function($q){
            $q->distinct();
        }])->find($request->region);

        //To calculate species richness
        $allspecies = [];
        $splocs = [];
        $oneloc = 0;
        $twolocs = 0;

        foreach($region->localities as $lc){
            foreach($lc->species as $ls){
                $splocs[$ls->id][] = $lc->id;

                if(!in_array($ls->id, $allspecies)){
                    $allspecies[] = $ls->id;
                }
            }
        }

        foreach ($splocs as $sl){
            if(count($sl) == 1){
                $oneloc += 1;
            }elseif(count($sl) == 2){
                $twolocs += 1;
            }
        }

        $chao1 = count($allspecies) + (pow($oneloc, 2) / 2 * $twolocs);

        return view('front.statistics.region.localities-show', [
            'region' => $region,
            'allspecies' => count($allspecies),
            'chao1' => $chao1,
        ]);

    }

    public function export(Request $request){
        $region = Region::with('localities.records.species.genus')->find($request->region);

        $spLocs = [];

        foreach($region->localities as $locality){

            //$lName = $locality->name;

            foreach($locality->records as $r){

                $spLocs[$r->species_id][$r->species->genus->name . ' ' . $r->species->name][] = [
                    'locality' => $locality->name,
                    'date' => $r->collected_at ? $r->collected_at->format('d.m.Y') : null,
                    'males' => $r->males ?: null,
                    'females' => $r->females ?: null,
                    'juvenile_males' => $r->juvenile_males ?: null,
                    'juvenile_females' => $r->juvenile_females ?: null,
                    'collected_by' => $r->collected_by ?: null,
                    'paper_slug' => $r->paper->slug,
                ];

            }
        }

        //Export the data
        \Excel::create(str_replace(' ', '_', $region->name).'_'.date('d_m_Y'), function($excel) use($lName, $spLocs){
            $excel->sheet($lName, function($sheet) use($lName, $spLocs){
                $cnt = 1;
                $sheet->row($cnt, [
                    'Species',
                    'Locality',
                    'Collected by',
                    'Collected date',
                    'Males',
                    'Females',
                    'Juvenile males',
                    'Juvenile females',
                ]);

                foreach($spLocs as $spL){
                    foreach($spL as $sk => $sl){
                        foreach($sl as $l){
                            $cnt++;
                            $sheet->row($cnt, [
                                $sk,
                                $l['locality'],
                                $l['collected_by'],
                                $l['date'],
                                $l['males'],
                                $l['females'],
                                $l['juvenile_males'],
                                $l['juvenile_females'],
                            ]);
                        }
                    }
                }

            });
        })->export('csv');

    }
}
