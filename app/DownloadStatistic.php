<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadStatistic extends Model
{
    protected $fillable = [
		'type', 
		'place',
		'user_id', 
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
