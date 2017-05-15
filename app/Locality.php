<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $fillable = [
		'name', 
		'slug', 
		'latitude',
		'longitude',
		'region_id', 
		'country_id'
    ];

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function region(){
    	return $this->belongsTo(Region::class);
    	
    }

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function species(){
        return $this->belongsToMany(Species::class, 'records', 'locality_id', 'species_id');
    }

}
