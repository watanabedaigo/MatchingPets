<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Candidate;
use App\Variety;
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

// 条件つき絞り込み、表示順指定
    public function narrowing(Request $request)
    {
        // 候補一覧ページから品種IDを取得し、その品種IDを持ち、かつ入力されたplace_idを持つ候補を表示したい。→一覧表示画面で、品種IDを入力させ、それを受け取ることで取得する。しかし、ユーザーに品種IDを入力させるわけにはいかない・・・
        // →品種IDの入力フォームの値をこちらで決定し、このフォームをを隠せないか。→Form::hiddenがあるので用いる。value属性に候補一覧ページに飛ばされた品種IDを当てはめておくことで、品種IDを自動的に取得することができる。
        $variety_id = $request->input('variety_id');
        // dd($variety_id); // 中身を確認する関数。これ以降の処理を止めて中身を表示。
        
        $place_address1 = $request->input('place_address1');
        $place_address2 = $request->input('place_address2');
        $place_address3 = $request->input('place_address3');
        $gender = $request->input('gender');
        $price = $request->input('price');
        $age = $request->input('age');
        $coupon = $request->input('coupon');
        $birthday = $request->input('birthday');
        $id = $request->input('id');
        $sort = $request->input('sort');
        
        $variety = Variety::find($variety_id);
        // dd($variety);
  
        $query = Candidate::query();
        $query->where('variety_id',$variety_id);
        
        if(!empty($place_address1) && empty($place_address2)){
            $query->where('place_address','LIKE',"%{$place_address1}%");
        }
        
        if(!empty($place_address1) && !empty($place_address2)){
            $query->where('place_address','LIKE',"%{$place_address1}%")
              ->orWhere('place_address','LIKE',"%{$place_address2}%");
        }
        
        if(!empty($place_address1) && !empty($place_address2 &&!empty($place_address3))){
            $query->where('place_address','LIKE',"%{$place_address1}%")
                ->orWhere('place_address','LIKE',"%{$place_address2}%")
                ->orWhere('place_address','LIKE',"%{$place_address3}%");
        }
        
        if(!empty($gender)){
            $query->where('gender',$gender);
        }
        
        if(!empty($price)){
            $query->where('price','<=',$price);
        }
        
        if(!empty($age)){
            $query->where('age','<=',$age);
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
        
        if($sort == '記載日降順'){
            $query->orderBy('created_at','desc');
        }elseif($sort == '値段降順'){
            $query->orderBy('price','desc');
        }elseif($sort == '値段昇順'){
            $query->orderBy('price','asc');
        }elseif($sort == '年齢降順'){
            $query->orderBy('age','desc');
        }elseif($sort == '年齢昇順'){
            $query->orderBy('age','asc');
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
