<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Locality;
use App\Record;
use App\Species;
use App\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function __construct(){
        //$this->middleware('auth', ['except' => ['searchSpecies']]);
        $this->middleware('auth')->except('searchSpecies');
        $this->middleware('isAllowed')->except('searchSpecies');
        //$this->middleware('isAllowed', ['except' => ['searchSpecies']]);
    }
    
    public function index(Request $r){
    	$records = Record::with('locality', 'species.genus', 'paper.authors')->orderBy('id', 'desc');

        if($r->species_id){
            $records = $records->where('species_id', $r->species_id);
        }

        $records = $records->paginate(100);
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
            'juveniles' => $request->juveniles,
            'juvenile_males' => $request->males_juv,
            'juvenile_females' => $request->females_juv,
            'collected_by' => $request->collected_by,
            'collected_at' => $request->datepicker ? Carbon::createFromFormat('d-m-Y', $request->datepicker) : null,
            'paper_id' => $request->sel1,
            'recorded_as' => $request->recorded_as,
            'page' => (int) $request->page,
            'altitude' => (int) $request->altitude,
            'specimens' => $request->specimens,
            'rejected' => $request->rejected,
        ]);

        if($record->save()){
            return redirect(route('admin.record.create'));
        }
    }

    public function edit(Record $record){
        return view('admin.records.edit', compact('record'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'species_id' => 'required|integer',
            'locality_id' => 'required|integer',
            'sel1' => 'required|integer',
        ]);

        $record = Record::find($request->record_id);

        $record->recorded_as = $request->recorded_as;
        $record->species_id = $request->species_id;
        $record->locality_id = $request->locality_id;
        $record->comments = $request->notes;
        $record->males = $request->males;
        $record->females = $request->females;
        $record->juveniles = $request->juveniles;
        $record->juvenile_males = $request->males_juv;
        $record->juvenile_females = $request->females_juv;
        $record->collected_by = $request->collected_by;
        $record->collected_at = $request->datepicker ? Carbon::createFromFormat('d-m-Y', $request->datepicker) : null;
        $record->paper_id = $request->sel1;
        $record->page = (int) $request->page;
        $record->altitude = (int) $request->altitude;
        $record->specimens = $request->specimens;
        $record->rejected = $request->rejected;

        if($record->save()){
            return back();
        }
    }

    public function searchSpecies(Request $request){
        $species = Species::with('genus')->where('name', 'ilike', '%' . $request->species.'%')->orderBy('name')->get();

        return $species;
    }

    public function searchLocalities(Request $request){
        $localities = Locality::where('name', 'ilike', $request->locality.'%')->orderBy('name')->get();

        return $localities;
    }

    public function fetchCountriesForRegion(Request $request){
        $region = Region::find((int) $request->region);

        return $region->countries;
    }
}
