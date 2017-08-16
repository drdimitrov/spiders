<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'title', 'email', 'password', 'activation_token', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($name){

        foreach($this->roles as $role){
            if($role->name == $name) return true;
        }

        return false;
    }

    public function isAllowedTo($do){

        foreach($this->roles as $role){

            foreach($role->permission as $permission){
                if($permission->name == $do) return true;
            }

            return false;
        }

        return false;
    }

    public function scopeByEmail(Builder $builder, $email){
        return $builder->where('email', $email);
    }
}
