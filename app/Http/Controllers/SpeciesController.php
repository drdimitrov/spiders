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

        $species = Species::with(
            'records.locality.country',
            'records.paper.authors', 
            'genus'
        )->find($request->species);
        
        $localities = [];

        foreach($species->records as $record){
            $auth = '';
            foreach($record->paper->authors as $author){
                $auth .= ' '.$author->last_name;                
            }

            $localities[$record->locality->country->name][] = [
                'name' => $record->locality->name,
                'notes' => $record->comments,
                'date' => $record->collected_at ? $record->collected_at->format('d-m-Y') : null,
                'leg' => $record->collected_by,
                'males' => $record->males,
                'females' => $record->females,
                'juvenile_males' => $record->juvenile_males,
                'juvenile_females' => $record->juvenile_females,
                'published' => $auth . ' ' . $record->paper->published_at->format('Y'),
                'slug' => $record->paper->slug,
                'recorded' => $species->genus->name . ' ' . $species->name,
                'coordinates' => [
                    $record->locality->latitude, 
                    $record->locality->longitude,
                    $record->locality->name,
                ],
            ];
        }

        ksort($localities);

        if(! $species){
            return redirect('/');
        }
    	
        return view('front.single-species', compact('species', 'localities'));
    }
}
