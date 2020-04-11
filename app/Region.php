<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Region extends Model
{
    use Auditable;
	
    protected $fillable = ['name', 'slug',];

    public function countries(){
    	return $this->belongsToMany(Country::class);
    }

    public function localities(){
    	return $this->hasMany(Locality::class);
    }

    
}
