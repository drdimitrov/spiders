<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Family extends Model
{
	use Searchable;

    protected $fillable = ['name', 'slug', 'order_id', 'author'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }

    public function genera(){
    	return $this->hasMany(Genus::class);
    }

    public function species(){
    	return $this->hasManyThrough(Species::class, Genus::class);
    }
}
