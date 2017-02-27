<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
	protected $fillable = [
	
	];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];
}
