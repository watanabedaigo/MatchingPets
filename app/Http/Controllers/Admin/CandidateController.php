<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidate;
use App\Variety;
use App\Category;
use App\Candidatephoto;

class CandidateController extends Controller
{
    // 以下の並び替えだと、現在のページの候補のIDしか取得できていない。２ページ以降の候補のIDを取得できていない。
    // 現在のページに表示されている候補のみを並び替えてしまう。
    // public function created_at_asc($id, Request $request)
    // {
    //     // $variety = Variety::find($id);
    //     $variety_id = $request->input('variety_id');
    //     $variety = Variety::find($variety_id);
    //     // dd($variety);
        
    //     // ビューに表示されている候補のIDを全て取得
    //     $candidate_ids = $request->input('candidate_ids');
    //     // dd($candidate_ids);
        
    //     // ①
    //     // 取得したIDの候補をCollectionとしてを取得
    //     $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('created_at', 'asc')->paginate(10);
    //     // dd($candidates);
        
    //     $candidatephotos = Candidatephoto::all();
        
    //     return view('candidates',[
    //         'variety' => $variety,
    //         'candidates' => $candidates,
    //         'candidatephotos' => $candidatephotos,
    //     ]);
    // }
    
    public function show($id)
    {
        $candidate = Candidate::find($id);
     
        $candidate->view_count += 1;
        $candidate->save();
        
        $candidatephotos = $candidate->candidatephotos()->get();
        
        $categories = Category::all();
        
        $varieties = Variety::all();
        
        return view('candidateshow',[
            'candidate' => $candidate,
            'candidatephotos' => $candidatephotos,
            'categories' => $categories,
            'varieties' => $varieties,
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
        $request->validate([
            'variety_id' => 'required|integer|exists:varieties,id',
        ]);
        
        $candidate = new Candidate;
        $candidate->variety_id = $request->variety_id;
        $candidate->price = $request->price;
        $candidate->birthday = $request->birthday;
        $candidate->gender = $request->gender;
        $candidate->coat_color = $request->coat_color;
        $candidate->personality = $request->personality;
        $candidate->personality_details = $request->personality_details;
        $candidate->inspection = $request->inspection;
        $candidate->place_name = $request->place_name;
        $candidate->place_address = $request->place_address;
        $candidate->map = $request->map;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->URL = $request->URL;
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
        $candidate->birthday = $request->birthday;
        $candidate->gender = $request->gender;
        $candidate->coat_color = $request->coat_color;
        $candidate->personality = $request->personality;
        $candidate->personality_details = $request->personality_details;
        $candidate->inspection = $request->inspection;
        $candidate->place_name = $request->place_name;
        $candidate->place_address = $request->place_address;
        $candidate->map = $request->map;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->URL = $request->URL;
        $candidate->coupon = $request->coupon;
        $candidate->save();

        return redirect('/');
    }
    
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return back();
    }
    
    // public function coupon($id)
    // {
    //     $candidate = Candidate::find($id);
    
    //     return view('candidatecoupon',[
    //         'candidate' => $candidate,
    //     ]);
    // }
}
