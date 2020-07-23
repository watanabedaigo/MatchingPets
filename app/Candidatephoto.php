<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidatephoto extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    
    protected $fillable = [
        'photo', 
    ];
    
    protected $table = 'candidate_photos';
}
