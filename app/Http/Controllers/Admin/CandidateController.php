<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidate;
use App\Variety;
use App\Candidatephoto;

class CandidateController extends Controller
{
    public function created_at_asc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('created_at','asc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function created_at_desc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('created_at','desc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function price_asc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('price','asc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function price_desc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('price','desc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function age_asc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('age','asc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function age_desc($id)
    {
        $variety = Variety::find($id);
        
        $variety->loadRelationshipCounts();
        
        $candidates = $variety->candidates()->orderBy('age','desc')->get();
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    
    public function show($id)
    {
        $candidate = Candidate::find($id);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidateshow',[
            'candidate' => $candidate,
            'candidatephotos' => $candidatephotos,
        ]);
    }

    public function create()
    {
        $candidate = new Candidate;
        
        return view('admin.candidate',[
            'candidate' => $candidate,
        ]);
    }
    
    public function store(Request $request)
    {
        $candidate = new Candidate;
        $candidate->variety_id = $request->variety_id;
        $candidate->price = $request->price;
        $candidate->age = $request->age;
        $candidate->gender = $request->gender;
        $candidate->personality = $request->personality;
        $candidate->personality_details = $request->personality_details;
        $candidate->inspection = $request->inspection;
        $candidate->place_name = $request->place_name;
        $candidate->place_address = $request->place_address;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->place_id = $request->place_id;
        $candidate->place_details_id = $request->place_details_id;
        $candidate->admin_id = $request->user()->id;
        $candidate->coupon = $request->coupon;
        $candidate->save();        
        
        return back();
    }
    
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        
        return view('admin.candidateedit',[
            'candidate' => $candidate,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $candidate = Candidate::find($id);
        
        $candidate->price = $request->price;
        $candidate->age = $request->age;
        $candidate->gender = $request->gender;
        $candidate->personality = $request->personality;
        $candidate->personality_details = $request->personality_details;
        $candidate->inspection = $request->inspection;
        $candidate->place_name = $request->place_name;
        $candidate->place_address = $request->place_address;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->place_id = $request->place_id;
        $candidate->save();

        return back();
    }
    
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return back();
    }
    
    public function coupon($id)
    {
        $candidate = Candidate::find($id);
    
        return view('candidatecoupon',[
            'candidate' => $candidate,
        ]);
    }

}
