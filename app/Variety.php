<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
