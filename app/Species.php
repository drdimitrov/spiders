<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'author', 'genus_id', 'slug', 'es_id', 'wsc_id', 'wsc_lsid'];

    public function genus(){
    	return $this->belongsTo(Genus::class);
    }

    public function records(){
    	return $this->hasMany(Record::class);
    }

    public function images(){
    	return $this->hasMany(Image::class);
    }
}
