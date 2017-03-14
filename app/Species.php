<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    $fillable = ['name', 'paper_id', 'genus_id'];
}
