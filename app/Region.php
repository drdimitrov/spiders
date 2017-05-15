<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'slug',];

    public function countries(){
    	return $this->belongsToMany(Country::class);
    }

    public function localities(){
    	return $this->hasMany(Locality::class);
    }

    
}
