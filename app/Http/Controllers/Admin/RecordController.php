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
    	$records = Record::with('locality', 'species.genus')->get();
    	return view('admin.records.index', compact('records'));
    }

    public function create(){
    	$species = Species::with('genus')->orderBy('name')->get();
    	$localities = Locality::orderBy('name')->get();
    	return view('admin.records.create', compact('species', 'localities'));
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

    public function edit(Request $request){
        //dd(Record::find($request->record));
    }
}
