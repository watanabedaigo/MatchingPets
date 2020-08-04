<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoryphoto;
use Storage;

class CategoryphotoController extends Controller
{
    public function create()
    {
        $categoryphoto = new Categoryphoto;
        
        return view('admin.categoryphoto',[
            'categoryphoto' => $categoryphoto,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        
        $categoryphoto = new Categoryphoto;
        $categoryphoto->category_id = $request->category_id;
        $categoryphoto->admin_id = $request->user()->id;
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('matchingpets', $image, 'public');
        $categoryphoto->image_path = Storage::disk('s3')->url($path);
        
        $categoryphoto->save();

        return back();
    }
}
