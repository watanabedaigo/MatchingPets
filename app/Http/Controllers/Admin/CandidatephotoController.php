<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidatephoto;

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
        $candidatephoto = new Candidatephoto;
        $candidatephoto->candidate_id = $request->candidate_id;
        $candidatephoto->photo = $request->photo;
        $candidatephoto->admin_id = $request->user()->id;
        $candidatephoto->save();

        
        return back();
    }
}

