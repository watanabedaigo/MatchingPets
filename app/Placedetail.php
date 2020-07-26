<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placedetail extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
    
    protected $table = 'place_details';
}

