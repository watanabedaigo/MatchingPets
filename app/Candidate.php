<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function variety()
    {
        return $this->belongsTo(Variety::class);
    }
}
