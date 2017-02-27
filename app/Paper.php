<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
	protected $fillable = [
		'name', 'journal', 'slug', 'published_at',
	];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];
}
