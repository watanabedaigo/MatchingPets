<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidatephoto;
use Storage;

class CandidatephotoController extends Controller
{
    public function create()
    {
        $candidatephoto = new Candidatephoto;
        
        return view('admin.candidatephoto',[
            'candidatephoto' => $candidatephoto,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|integer|exists:candidates,id',
        ]);
        
        $candidatephoto = new Candidatephoto;
        $candidatephoto->candidate_id = $request->candidate_id;
        $candidatephoto->admin_id = $request->user()->id;
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('matchingpets', $image, 'public');
        $candidatephoto->image_path = Storage::disk('s3')->url($path);
        
        $candidatephoto->save();

        return back();
    }

}

