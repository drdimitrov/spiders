<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{

    public function complex(){
        return $this->belongsTo(Complex::class);
    }

    public function subelements(){
        return $this->hasMany(Subelement::class);
    }
}
