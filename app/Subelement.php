<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subelement extends Model
{

    public function element(){
        return $this->belongsTo(Element::class);
    }
}
