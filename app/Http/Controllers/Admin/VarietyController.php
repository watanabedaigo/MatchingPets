<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Variety;
use App\Candidate;
use App\Candidatephoto;

class VarietyController extends Controller
{
    public function show($id,Request $request)
    {
        $variety = Variety::find($id);
        
        $variety->view_count = $variety->view_count + 1;
        $variety->save();
        
        $place_address1 = $request->input('place_address1');
        $place_address2 = $request->input('place_address2');
        $place_address3 = $request->input('place_address3');
        $gender = $request->input('gender');
        $price = $request->input('price');
        $coupon = $request->input('coupon');
        $birthday = $request->input('birthday');
        $id = $request->input('id');
        $sort = $request->input('sort');
        
        $query = Candidate::query();
        $query->where('variety_id',$variety->id);
        
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
        }elseif($sort == '値段昇順'){
            $query->orderBy('price','asc');
        }elseif($sort == '誕生日昇順'){
            $query->orderBy('birthday','asc');
        }elseif($sort == '閲覧数降順'){
            $query->orderBy('view_count','desc');
        }
        
        $candidates = $query->paginate(10);
        
        $candidatephotos = Candidatephoto::all();
        
        return view('candidates',[
            'variety' => $variety,
            'candidates' => $candidates,
            'candidatephotos' => $candidatephotos,
        ]);
    }
    
    public function create()
    {
        $variety = new Variety;
        
        return view('admin.variety',[
            'variety' => $variety,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        
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
    
    public function edit($id)
    {
        $variety = Variety::find($id);
        
        return view('admin.varietyedit',[
            'variety' => $variety,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $variety = Variety::find($id);
        
        $variety->name = $request->name;
        $variety->category_id= $request->category_id;
        $variety->feature = $request->feature;
        $variety->lifespan = $request->lifespan;
        $variety->breedingtool = $request->breedingtool;
        $variety->cost = $request->cost;
        $variety->save();

        return redirect('/');
    }
    
    public function destroy($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->delete();

        return back();
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        
        $query = Variety::query();
        
        // 引っかかる候補を変えたければLIKEの後ろを変えて、抽象度を変える。
        // 引っかからなければトップページへ、かつエラーメッセージ表示
        if(!empty($name)){
            $query->where('name','LIKE',"%{$name}%");
        }
        
        $variety = $query->get()->first();
        
        if($variety != NULL){
            return redirect('variety/' . $variety->id);
        }else{
            return back()->with('message','該当する品種が存在しませんでした。申し訳ないのですが、入力内容を変えて再度検索をお願い致します。');
        }
        
    }
}
