<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class Admin extends Model
class Admin extends Authenticatable
{
    protected $fillable = ['name','email','password'];
    
    protected $hidden = ['password', ];
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function varieties()
    {
        return $this->hasMany(Variety::class);
    }
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
    
    public function candidatephotos()
    {
        return $this->hasMany(CandidatePhoto::class);
    }
    
    public function places()
    {
        return $this->hasMany(Place::class);
    }
    
    public function categoryphotos()
    {
        return $this->hasMany(Categoryphoto::class);
    }
    
    public function varietyphoto()
    {
        return $this->hasMany(Varietyphoto::class);
    }
}
