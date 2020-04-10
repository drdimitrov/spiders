<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Record extends Model
{
    use Auditable;
    
    protected $dates = [
    	'created_at', 'updated_at', 'collected_at'
    ];

    protected $fillable = [
	    'species_id',
	    'locality_id',
	    'comments',
	    'males',
	    'females',
	    'juveniles',
	    'juvenile_males',
	    'juvenile_females',
	    'collected_by',
	    'collected_at',
	    'paper_id',
	    'recorded_as',
        'page',
        'altitude',
        'specimens',
        'rejected',
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

    public function rejected(){
        return $this->belongsTo(Paper::class);
    }
}
