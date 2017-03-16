<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['name', 'paper_id'];

    public function paper(){
    	return $this->belongsTo(Paper::class);
    }
}
