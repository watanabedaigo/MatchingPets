<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function placedetails()
    {
        return $this->hasMany(Placedetails::class);
    }
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
