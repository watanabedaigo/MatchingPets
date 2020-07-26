<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Placedetail;

class PlacedetailController extends Controller
{
    public function create()
    {
        $placedetail = new Placedetail;
        
        return view('admin.placedetail',[
            'placedetail' => $placedetail,
        ]);
    }
    
    public function store(Request $request)
    {
        $placedetail = new Placedetail;
        $placedetail->place_id = $request->place_id;
        $placedetail->place_details = $request->place_details;
        $placedetail->admin_id = $request->user()->id;
        $placedetail->save();
        
        return back();
    }
}
