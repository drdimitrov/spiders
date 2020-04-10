<?php

namespace App\Traits;
use App\User;
use Auth;

use Illuminate\Database\Eloquent\Model;

trait Auditable
{
	public static function boot(){
        parent::boot();

        static::updating(function($element){
            (new self)->logAudit($element);            
        });

        static::created(function($element){
            $element->audits()->attach(Auth::id(), [
	            'before' => null,
	            'after' => json_encode($element->getDirty()),
	        ]);
        });
    }

	public function audits(){
        return $this->morphToMany(User::class, 'audit')
            ->withTimestamps()
            ->withPivot(['before', 'after'])
            ->latest('pivot_updated_at');        
    }    

    public function logAudit($element){

        $changed = $element->getDirty();

        $element->audits()->attach(Auth::id(), [
            'before' => json_encode(
                array_intersect_key($element->fresh()->toArray(), $changed)
            ),
            'after' => json_encode($changed),
        ]);
    }
}