<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    protected $fillable = ['name', 'paper_id', 'family_id', 'slug'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }
}
