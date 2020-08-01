<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Variety;
use App\Candidatephoto;

class VarietyController extends Controller
{
    public function show($id)
    {
        $variety = Variety::find($id);
    
        $candidates = $variety->candidates()->paginate(10);
        
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
            return back();
        }
        
    }
    
    // public function feature($id)
    // {
    //     $variety = Variety::find($id);
        
    //     return view('varietyfeature',[
    //         'variety' => $variety,
    //     ]);
    // }

}
