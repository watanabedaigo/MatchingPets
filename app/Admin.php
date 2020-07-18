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
}
