<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function create()
    {
        $category = new Category;
        
        return view('admin.category',[
            'category' => $category,
        ]);
    }
    
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->admin_id = $request->user()->id;
        // $category->admin_id = \Auth::user()->id;
        // $category->admin_id = \Auth::id();
        $category->save();
        
        return back();
    }
}
