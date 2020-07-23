<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','age','gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // ユーザーがお気に入りに追加した候補を取得
    public function favorites()
    {
        return $this->belongsToMany(Candidate::class,'favorites','user_id','candidate_id')->withTimestamps();
    }
    
    // 特定の候補を既にお気に入りに追加しているかを確認
    public function is_favorite($candidateId)
    {
        return $this->favorites()->where('candidate_id',$candidateId)->exists();
    }
    
    // 特定の候補をお気に入りに追加
    public function favorite($candidateId)
    {
        $exit = $this->is_favorite($candidateId);
        if($exit){
            return false;
        }else{
            $this->favorites()->attach($candidateId);
            return true;
        }
    }
    
    // 特定の候補をお気に入りから外す
    public function unfavorite($candidateId)
    {
        $exit = $this->is_favorite($candidateId);
        if($exit){
            $this->favorites()->detach($candidateId);
            return true;
        }else{
            return false;
        }
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('favorites');
    }
}
