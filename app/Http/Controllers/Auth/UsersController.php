<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Candidatephoto;

class UsersController extends Controller
{
    // ユーザーのお気に入り一覧を表示するアクション
    public function favorites($id)
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
    
        $favorites = $user->favorites()->orderBy('created_at', 'desc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('auth.favorites',[
            'user' => $user,
            'favorites' => $favorites,
            'candidatephotos' => $candidatephotos,
        ]);
    }
}
