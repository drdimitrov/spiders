<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyUpdate extends Model
{
    
	protected $table = 'daily_wsc_updates';
	
    protected $guarded = [];

    protected $dates = [
        'created_at', 
        'updated_at', 
        'date',
    ];
}
