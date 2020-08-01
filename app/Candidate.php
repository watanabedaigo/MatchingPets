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
    
    // 候補をお気に入りに追加したユーザーを取得
    public function favorite_users()
    {
        return $this->belongsToMany(User::class,'favorites','candidate_id','user_id')->withTimestamps();
    }
    
    public function candidatephotos()
    {
        return $this->hasMany(Candidatephoto::class);
    }
    
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    
    public function placedetail()
    {
        return $this->belongsTo(Placedetail::class);
    }
}
