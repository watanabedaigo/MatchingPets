<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    public function store($id)
    {
        \Auth::user()->favorite($id);
        
        return back();
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        
        return back();
    }
}
