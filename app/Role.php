<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions(){
    	return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($name){

    	foreach($this->permissions as $permission){
    		if($permission->name == $name) return true;
    	}

    	return false;
    }

    public function user(){
    	return $this->belongsToMany(User::class);
    }

}
