<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genus;
use App\Species;

class SpeciesController extends Controller
{
    
    public function showGenusSpecies(Request $request){
    	
    	$genus = Genus::with(['species' => function($species){
            $species->orderBy('name');
        }])->where('slug', $request->genus)->first();

    	return view('front.species', compact('genus'));
    }

    public function show(Request $request){

        if($request->has('region')){
            $species = Species::with([
                    'records.locality' => function($q){
                        $q->where('locality.region_id', $request->region);
                    }
                ],
                'records.locality.country',
                'records.paper.authors', 
                'genus'
            )->find($request->species);
        }else{
            $species = Species::with(
                'records.locality.country',
                'records.paper.authors', 
                'genus',
                'images'
            )->find($request->species);
        }
                
        $localities = [];

        foreach($species->records as $record){
            $auth = '';

            if(count($record->paper->authors) > 1){
                $authCnt = 1;
                foreach($record->paper->authors as $author){
                    if($authCnt < count($record->paper->authors)){
                        $auth .= ' '.$author->last_name . ' &';
                    }else{
                        $auth .= ' '.$author->last_name;
                    }
                    
                    $authCnt+=1;               
                }
            }else{
                foreach($record->paper->authors as $author){
                    $auth .= ' '.$author->last_name;                
                }
            }
            
            $localities[$record->locality->country->name]['locality_id'] = $record->locality->id;
            $localities[$record->locality->country->name]['locality_details'][$record->locality->name][] = [
                'notes' => $record->comments,
                'date' => $record->collected_at ? $record->collected_at->format('d-m-Y') : null,
                'leg' => $record->collected_by,
                'males' => $record->males,
                'females' => $record->females,
                'juveniles' => $record->juveniles,
                'juvenile_males' => $record->juvenile_males,
                'juvenile_females' => $record->juvenile_females,
                'published' => $auth . ' ' . $record->paper->published_at->format('Y'),
                'year_of_publishing' => $record->paper->published_at->format('Y'),
                'slug' => $record->paper->slug,
                'recorded' => $record->recorded_as,
                'page' => $record->page,
                'coordinates' => ($record->locality->latitude && $record->locality->longitude) ? [
                    $record->locality->latitude, 
                    $record->locality->longitude,
                    $record->locality->name,
                ] : null,
            ];
            
        }

        ksort($localities);

        if(! $species){
            return redirect('/');
        }

        $references = [];
        foreach($localities as $loc){
            foreach($loc['locality_details'] as $lk){
                foreach($lk as $l){
                    $page = isset($l['page']) ? ', p.' . $l['page'] : '';
                    $references[$l['year_of_publishing']][$l['slug']][$l['published'] . $page] = $l['recorded'] ;
                    
                }
                
            }
        }

        ksort($references);
    	
        return view('front.single-species', compact('species', 'localities', 'references'));
    }
}
