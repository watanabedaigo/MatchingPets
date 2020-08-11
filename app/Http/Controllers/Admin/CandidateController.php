<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidate;
use App\Variety;
use App\Candidatephoto;

class CandidateController extends Controller
{
    public function created_at_asc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        // dd($variety);
        
        // ビューに表示されている候補のIDを全て取得
        // 現ページの候補しか取得できていない。２ページ以降の候補のIDも取得したい・・・。
        // ＝並び替えの際、ページネーションがうまく機能していない。
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('created_at', 'asc')->paginate(10);
        // dd($candidates);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function created_at_desc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        
        // ビューに表示されている候補のIDを全て取得
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('created_at', 'desc')->paginate(10);
        // dd($candidates);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function price_asc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        
        // ビューに表示されている候補のIDを全て取得
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('price', 'asc')->paginate(10);
        // dd($candidates);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function price_desc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        
        // ビューに表示されている候補のIDを全て取得
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('price', 'desc')->paginate(10);
        // dd($candidates);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function age_asc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        
        // ビューに表示されている候補のIDを全て取得
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('age', 'asc')->paginate(10);
        // dd($candidates);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function age_desc($id, Request $request)
    {
        // $variety = Variety::find($id);
        $variety_id = $request->input('variety_id');
        $variety = Variety::find($variety_id);
        
        // ビューに表示されている候補のIDを全て取得
        $candidate_ids = $request->input('candidate_ids');
        // dd($candidate_ids);
        
        // ①
        // 取得したIDの候補をCollectionとしてを取得
        $candidates = Candidate::whereIn('id', $candidate_ids)->orderBy('age', 'desc')->paginate(10);
        // dd($candidates);
        
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
        
        $candidatephotos = $candidate->candidatephotos()->get();
        
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
        $request->validate([
            'variety_id' => 'required|integer|exists:varieties,id',
            'place_id' => 'required|integer|exists:places,id',
            'place_details_id' => 'required|integer|exists:place_details,id',
        ]);
        
        $candidate = new Candidate;
        $candidate->variety_id = $request->variety_id;
        $candidate->price = $request->price;
        $candidate->age = $request->age;
        $candidate->birthday = $request->birthday;
        $candidate->gender = $request->gender;
        $candidate->personality = $request->personality;
        $candidate->personality_details = $request->personality_details;
        $candidate->inspection = $request->inspection;
        $candidate->place_name = $request->place_name;
        $candidate->place_address = $request->place_address;
        $candidate->map = $request->map;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->URL = $request->URL;
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
        $candidate->map = $request->map;
        $candidate->place_phonenumber = $request->place_phonenumber;
        $candidate->bussinesshours = $request->bussinesshours;
        $candidate->URL = $request->URL;
        $candidate->place_id = $request->place_id;
        $candidate->place_details_id = $request->place_details_id;
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
    
    public function coupon($id)
    {
        $candidate = Candidate::find($id);
    
        return view('candidatecoupon',[
            'candidate' => $candidate,
        ]);
    }

// 条件つき絞り込み
    public function narrowing(Request $request)
    {
        // 候補一覧ページから品種IDを取得し、その品種IDを持ち、かつ入力されたplace_idを持つ候補を表示したい。→一覧表示画面で、品種IDを入力させ、それを受け取ることで取得する。しかし、ユーザーに品種IDを入力させるわけにはいかない・・・
        // →品種IDの入力フォームの値をこちらで決定し、このフォームをを隠せないか。→Form::hiddenがあるので用いる。value属性に候補一覧ページに飛ばされた品種IDを当てはめておくことで、品種IDを自動的に取得することができる。
        $variety_id = $request->input('variety_id');
        // dd($variety_id); // 中身を確認する関数。これ以降の処理を止めて中身を表示。
        
        $place_address = $request->input('place_address');
        $gender = $request->input('gender');
        $price = $request->input('price');
        $age = $request->input('age');
        $coupon = $request->input('coupon');
        $birthday = $request->input('birthday');
        $id = $request->input('id');
        
        $variety = Variety::find($variety_id);
        // dd($variety);
  
        $query = Candidate::query();
        $query->where('variety_id',$variety_id);
        
        if(!empty($place_address)){
            $query->where('place_address','LIKE',"%{$place_address}%");
        }
        
        if(!empty($gender)){
            $query->where('gender',$gender);
        }
        
        if(!empty($price)){
            $query->where('price','<=',$price)->orderBy('price','asc');
        }
        
        if(!empty($age)){
            $query->where('age','<=',$age)->orderBy('age','asc');
        }
        
        if(!empty($coupon)){
            $query->where('coupon','!=',NULL);
        }
        
        if(!empty($birthday)){
            $query->where('birthday',$birthday);
        }
        
        if(!empty($id)){
            $query->where('id',$id);
        }
        
        $candidates = $query->paginate(10);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'candidates' => $candidates,
            'variety' => $variety,
            'candidatephotos' => $candidatephotos,
        ]);
    }
}
