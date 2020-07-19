<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
