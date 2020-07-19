<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;

class PlaceController extends Controller
{
    public function create()
    {
        $place = new Place;
        
        return view('admin.place',[
            'place' => $place,
        ]);
    }
    
    public function store(Request $request)
    {
        $place = new Place;
        $place->place = $request->place;
        $place->admin_id = $request->user()->id;
        $place->save();
    
        return back();
    }
}
