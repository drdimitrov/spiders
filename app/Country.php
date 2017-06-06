<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'slug',];

    public function localities(){
    	return $this->hasMany(Locality::class);
    }
}
