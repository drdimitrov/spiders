<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadStatistic extends Model
{
    protected $fillable = [
		'type', 
		'locality_id',
		'region_id',
		'country_id',
		'user_id', 
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
