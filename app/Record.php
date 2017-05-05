<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
	    'species_id', 
	    'locality_id', 
	    'comments',
	    'males',
	    'females',
	    'juvenile_males',
	    'juvenile_females',
	    'collected_by',
	    'collected_at',
	    'paper_id',
	    'recorded_as',
    ];

    public function localities(){
    	return $this->belongsTo(Locality::class);
    }

    public function species(){
    	return $this->belongsTo(Species::class);
    }
}
