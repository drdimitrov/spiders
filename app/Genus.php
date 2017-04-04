<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Genus extends Model
{
	use Searchable;
	
    protected $fillable = ['name', 'paper_id', 'family_id', 'slug'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }

    public function family(){
    	return $this->belongsTo(Family::class);
    }

    public function species(){
    	return $this->hasMany(Species::class);
    }
}
