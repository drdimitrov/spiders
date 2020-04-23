<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\PapersController;
use Illuminate\Http\Request;
use App\Genus;
use App\Species;
use App\Paper;

class SpeciesController extends Controller
{

    public function showGenusSpecies(Request $request){

    	$genus = Genus::with(['species' => function($species){
            $species->orderBy('name');
        }])->where('slug', $request->genus)->first();

    	return view('front.species', compact('genus'));
    }

    public function show(Request $request){

        if($request->region){
            $species = Species::with(['localities' => function($query) use($request){
                $query->where('localities.region_id', $request->region);
            },'localities.country'])->find($request->species);
        }else{
            $species = Species::with('localities.country')->find($request->species);
        }

        if(! $species){ abort(404); }

        $localities = [];
        $papers_ids = [];

        foreach($species->localities as $sl){
            $papers_ids[] = $sl->pivot->paper_id;
        }

        $papers = Paper::with('authors')->orderBy('published_at')->find($papers_ids);

        foreach($species->localities as $locality){
            $localities[$locality->country->name][$locality->id]['locality_name'] = $locality->name;
            $localities[$locality->country->name][$locality->id]['records'][] = [
                'notes' => $locality->pivot->comments,
                'date' => $locality->pivot->collected_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $locality->pivot->collected_at)->format('d.m.Y') : null,
                'leg' => $locality->pivot->collected_by,
                'specimens' => $locality->pivot->specimens,
                'rejected' => $locality->pivot->rejected,
                'males' => $locality->pivot->males,
                'females' => $locality->pivot->females,
                'juveniles' => $locality->pivot->juveniles,
                'juvenile_males' => $locality->pivot->juvenile_males,
                'juvenile_females' => $locality->pivot->juvenile_females,
                'paper' => $papers->filter(function($v, $k) use($locality){
                    return $v->id == $locality->pivot->paper_id;
                }),
                'recorded' => $locality->pivot->recorded_as,
                'page' => $locality->pivot->page,
                'coordinates' => ($locality->latitude && $locality->longitude) ? [
                    $locality->latitude,
                    $locality->longitude,
                    $locality->name,
                ] : null,
            ];

        }

        ksort($localities);

//        foreach($localities as $lsort){
//            foreach($lsort as $lsr){
//                usort($lsr['records'], function($a, $b) {
//                    return $a['paper']->first()->published_at->timestamp <=> $b['paper']->first()->published_at->timestamp;
//                });
//            }
//        }

        $references = [];
        foreach($localities as $countries){
            foreach($countries as $locality1){
                foreach($locality1['records'] as $record){

                    if(count($record['paper']->first()->authors) > 2){
                        $authors = $record['paper']->first()->authors->first()->last_name . ' et al.';
                    }elseif(count($record['paper']->first()->authors) == 2){
                        $authors = $record['paper']->first()->authors->first()->last_name . ' & ' . $record['paper']->first()->authors->last()->last_name;
                    }else{
                        $authors = $record['paper']->first()->authors->first()->last_name;
                    }

                    // $references[$record['paper']->first()->published_at->format('Y')][$authors]['page']= $record['page'];
                    // $references[$record['paper']->first()->published_at->format('Y')][$authors]['as']= $record['recorded'];
                    // $references[$record['paper']->first()->published_at->format('Y')][$authors]['slug']= $record['paper']->first()->slug;

                    $references[$record['paper']->first()->published_at->format('Y')][$authors][$record['paper']->first()->id][$record['recorded']] = [
                        'page' => $record['page'],
                        'as' => $record['recorded'],
                        'slug' => $record['paper']->first()->slug,
                    ];
                }

            }

        }

        ksort($references);

        return view('front.single-species', compact('species', 'localities', 'references'));
    }
}
