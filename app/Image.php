<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Image extends Model
{
    protected $fillable = ['name', 'species_id', 'description'];
}
