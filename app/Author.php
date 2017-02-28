<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
	use Searchable;
	
    protected $fillable = ['last_name', 'first_name'];

    public function papers(){
    	return $this->belongsToMany(Paper::class);
    }
}
