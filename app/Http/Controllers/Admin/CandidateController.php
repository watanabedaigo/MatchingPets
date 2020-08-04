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
        // /variety/1 普通の場合
        
        // /variety-narrowing?place_id=1&variety_id=1
        
        // /variety/1?place_id=1 一旦候補一覧の画面にきて、検索ボタンを押した場合
        
        $place_address = $request->input('place_address');
        
        $variety = Variety::find($id);
        
        $candidates = [];
        if (!empty($place_address)) {
            // 検索ボタンを押した場合
            $candidates = $variety->candidates()->where('place_address','LIKE',"%{$place_address}%")->orderBy('created_at','asc')->paginate(10);
        } else {
            // 普通の場合
            $candidates = $variety->candidates()->orderBy('created_at','asc')->paginate(10);   
        }
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function created_at_desc($id, Request $request)
    {
        $candidate_ids = $request->input('candidate_ids');
        
        $variety = Variety::find($id);
        
        $candidates = $variety->candidates()->orderBy('created_at','desc')->paginate(10);
    
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
        
        $candidates = $variety->candidates()->orderBy('price','asc')->paginate(10);
        
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
        
        $candidates = $variety->candidates()->orderBy('price','desc')->paginate(10);
   
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
        
        $candidates = $variety->candidates()->orderBy('age','asc')->paginate(10);
        
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
        
        $candidates = $variety->candidates()->orderBy('age','desc')->paginate(10);
        
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
        
        $variety = Variety::find($variety_id);
  
        $query = Candidate::query();
        if(!empty($place_address)){
            $query->where('place_address','LIKE',"%{$place_address}%")
                    ->where('variety_id',$variety_id);
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        if(!empty($gender)){
            $query->where('gender',$gender)
                    ->where('variety_id',$variety_id);
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        if(!empty($price)){
            $query->where('price','<=',$price)
                    ->where('variety_id',$variety_id)->orderBy('price','asc');
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        if(!empty($age)){
            $query->where('age','<=',$age)
                    ->where('variety_id',$variety_id)->orderBy('age','asc');
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        if(!empty($coupon)){
            $query->where('coupon','!=',NULL)
                    ->where('variety_id',$variety_id);
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        if(!empty($birthday)){
            $query->where('birthday',$birthday)
                    ->where('variety_id',$variety_id);
        }else{
            $query->where('variety_id',$variety_id);
        }
        
        $candidates = $query->paginate(10);
        
        // 検索を押したら同時に並び替えを実施バージョン
        // if (!empty($place_address)) {
        //     // 検索ボタンを押した場合
        //     $candidates = $variety->candidates()->where('place_address','LIKE',"%{$place_address}%")->orderBy('created_at','desc')->get();
        // } else{
        //     $candidates = $variety->candidates()->orderBy('created_at','asc')->get();;
        // }
        
        // if (!empty($gender)) {
        //     // 検索ボタンを押した場合
        //     $candidates = $variety->candidates()->where('gender',$gender)->orderBy('created_at','desc')->get();
        // } else{
        //     $candidates = $variety->candidates()->orderBy('created_at','asc')->get();;
        // }
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'candidates' => $candidates,
            'variety' => $variety,
            'candidatephotos' => $candidatephotos,
        ]);
    }
// 条件つき絞り込み

}
