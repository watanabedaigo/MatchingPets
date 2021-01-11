<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Candidatephoto;

class UsersController extends Controller
{
    public function favorites($id)
    {
        $user = User::findOrFail($id);
        
        $favorites = $user->favorites()->orderBy('created_at', 'desc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('auth.favorites',[
            'user' => $user,
            'favorites' => $favorites,
            'candidatephotos' => $candidatephotos,
        ]);
    }
}
