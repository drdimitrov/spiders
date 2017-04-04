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
	    'recorded_by',
	    'recorded_as',
    ];
}
