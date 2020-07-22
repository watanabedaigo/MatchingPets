<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    // 候補をお気に入りに追加するアクション
    public function store($id)
    {
        \Auth::user()->favorite($id);
        
        return back();
    }
    
    // 候補をお気に入りから外すアクション
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        
        return back();
    }
}
