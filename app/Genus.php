<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Genus extends Model
{
	use Searchable;
	
    protected $fillable = ['name', 'author', 'family_id', 'slug'];
    
    public function family(){
    	return $this->belongsTo(Family::class);
    }

    public function species(){
    	return $this->hasMany(Species::class);
    }
}
