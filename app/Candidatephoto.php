<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidatephoto extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
