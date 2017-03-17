<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['name', 'paper_id', 'slug'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }

    public function genera(){
    	return $this->hasMany(Genus::class);
    }
}
