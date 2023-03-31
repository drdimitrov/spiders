<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Paper extends Model
{
    use Auditable;
    
	protected $fillable = [
		'name', 'journal', 'slug', 'published_at',
	];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function authors(){
    	return $this->belongsToMany(Author::class)->orderBy('author_paper.id');
    }

    public function hasAuthor($id){

        foreach($this-> authors as $author){
            if($author->id == $id) return true;
        }

        return false;
    }

    public function taxa(){
        return $this->belongsToMany(Species::class, 'records')->distinct();
    }
}
