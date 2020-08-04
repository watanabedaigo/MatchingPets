<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Varietyphoto;
use Storage;

class VarietyphotoController extends Controller
{
    public function create()
    {
        $varietyphoto = new Varietyphoto;
        
        return view('admin.varietyphoto',[
            'varietyphoto' => $varietyphoto,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'variety_id' => 'required|integer|exists:varieties,id',
        ]);
        
        $varietyphoto = new Varietyphoto;
        $varietyphoto->variety_id = $request->variety_id;
        $varietyphoto->admin_id = $request->user()->id;
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('matchingpets', $image, 'public');
        $varietyphoto->image_path = Storage::disk('s3')->url($path);
        
        $varietyphoto->save();

        return back();
    }
}
