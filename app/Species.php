<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'author', 'genus_id', 'slug', 'es_id', 'wsc_id', 'wsc_lsid', 'gdist', 'gdist_wsc'];

    public function genus(){
    	return $this->belongsTo(Genus::class);
    }

    public function records(){
    	return $this->hasMany(Record::class);
    }

    public function images(){
    	return $this->hasMany(Image::class)->orderBy('id');
    }

    public function localities(){
        return $this->belongsToMany(Locality::class,
            'records', 'species_id', 'locality_id'
        )->withPivot([
            'recorded_as', 'comments', 'males', 'females', 'juvenile_males', 'juvenile_females',
            'juveniles', 'specimens', 'page', 'altitude', 'collected_at', 'paper_id'
        ]);
    }
}
