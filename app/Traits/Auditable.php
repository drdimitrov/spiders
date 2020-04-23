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
            (new self)->logAudit($element, 'updated');            
        });

        static::created(function($element){
            $element->audits()->attach(Auth::id(), [
                'event' => 'created',
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

    public function logAudit($element, $event){

        $changed = $element->getDirty();

        $element->audits()->attach(Auth::id(), [
            'event' => $event,
            'before' => json_encode(
                array_intersect_key($element->fresh()->toArray(), $changed)
            ),
            'after' => json_encode($changed),
        ]);
    }
}