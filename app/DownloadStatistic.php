<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadStatistic extends Model
{
    protected $fillable = [
		'type', 
		'locality_id',
		'region_id',
		'country_id',
		'user_id', 
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function locality(){
    	return $this->belongsTo(Locality::class);
    }

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function region(){
    	return $this->belongsTo(Region::class);
    }

    public function getPlace(){
    	if($this->country) return $this->country;
    	if($this->region) return $this->region;
    	return $this->locality;
    }
}
