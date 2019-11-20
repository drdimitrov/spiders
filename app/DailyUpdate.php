<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyUpdate extends Model
{
    
	protected $table = 'daily_wsc_updates';
	
    protected $guarded = [];

    public function species(){
    	return $this->belongsTo(Species::class);
    }
    
}
