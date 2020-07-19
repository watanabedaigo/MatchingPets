<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
