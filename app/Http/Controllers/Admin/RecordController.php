<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Record;
use App\Species;
use App\Locality;

class RecordController extends Controller
{
    public function index(){
    	$records = Record::with('locality', 'species.genus', 'paper')->paginate(100);
    	return view('admin.records.index', compact('records'));
    }

    public function create(){

    	return view('admin.records.create');
    }

    public function save(Request $request){

        $this->validate($request, [
            'species_id' => 'required|integer',
            'locality_id' => 'required|integer',
            'sel1' => 'required|integer',
        ]);

    	$record = Record::create([
            'species_id' => $request->species_id,
            'locality_id' => $request->locality_id,
            'comments' => $request->notes,
            'males' => $request->males,
            'females' => $request->females,
            'juvenile_males' => $request->males_juv,
            'juvenile_females' => $request->females_juv,
            'collected_by' => $request->collected_by,
            'collected_at' => $request->has('datepicker') ?\Carbon\Carbon::createFromFormat('d-m-Y', $request->datepicker) : null,
            'paper_id' => $request->sel1,
            'recorded_as' => $request->recorded_as,
        ]);

        if($record->save()){
            return redirect(route('admin.record.create'));
        }
    }

    public function edit(Record $record){
        return view('admin.records.edit', compact('record'));
    }

    public function searchSpecies(Request $request){
        $species = Species::with('genus')->where('name', 'ilike', $request->species.'%')->orderBy('name')->get();

        return $species;
    }

    public function searchLocalities(Request $request){
        $localities = Locality::where('name', 'ilike', $request->locality.'%')->orderBy('name')->get();

        return $localities;
    }
}
