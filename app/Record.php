<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $dates = [
    	'created_at', 'updated_at', 'collected_at'
    ];

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

    public function locality(){
    	return $this->belongsTo(Locality::class);
    }

    public function species(){
    	return $this->belongsTo(Species::class);
    }

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }
}
