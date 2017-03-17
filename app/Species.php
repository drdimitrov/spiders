<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name', 'paper_id', 'genus_id', 'slug'];
}
