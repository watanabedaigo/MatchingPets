<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryphoto extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    protected $fillable = [
        'photo', 
    ];
    
    protected $table = 'category_photos';
}
