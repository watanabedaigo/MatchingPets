<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Variety;

class VarietyController extends Controller
{
    public function create()
    {
        $variety = new Variety;
        
        return view('admin.variety',[
            'variety' => $variety,
        ]);
    }
    
    public function store(Request $request)
    {
        $variety = new Variety;
        $variety->name = $request->name;
        $variety->category_id = $request->category_id;
        $variety->admin_id = $request->user()->id;
        $variety->feature = $request->feature;
        $variety->lifespan = $request->lifespan;
        $variety->breedingtool = $request->breedingtool;
        $variety->cost = $request->cost;
        $variety->save();
        
        return back();
    }
}
