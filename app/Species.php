<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'author', 'genus_id', 'slug', 'brackets'];

    public function genus(){
    	return $this->belongsTo(Genus::class);
    }
}
