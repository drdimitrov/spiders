<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'paper_id', 'genus_id', 'slug', 'brackets'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }

    public function genus(){
    	return $this->belongsTo(Genus::class);
    }
}
