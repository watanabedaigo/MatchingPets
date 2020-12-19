<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Variety;
use App\Candidate;
use App\Varietyphoto;
use App\Categoryphoto;
use App\Candidatephoto;
use DateTime;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        $categoryphotos = Categoryphoto::all();
        
        $popularityvarieties = Variety::orderBy('view_count','desc')->take(3)->get();
        $popularityvarietyphotos = Varietyphoto::all();
           
        $newcandidates = Candidate::orderBy('created_at','desc')->take(5)->get();
        $newcandidatephotos = Candidatephoto::all();
        
        $getnames = Variety::all();

        return view('welcome',[
            'categories' => $categories,
            'categoryphotos' => $categoryphotos,
            'popularityvarieties' => $popularityvarieties,
            'popularityvarietyphotos' => $popularityvarietyphotos,
            'newcandidates' => $newcandidates,
            'newcandidatephotos' => $newcandidatephotos,
            'getnames' => $getnames,
        ]);
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        
        $varieties = $category->varieties()->orderBy('name','asc')->get();
        
        $varietyphotos = Varietyphoto::all();
        
        return view('varieties',[
            'category' => $category,
            'varieties' => $varieties,
            'varietyphotos' => $varietyphotos,
        ]);
    }

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
        $category->save();
        
        $categoryphoto = new Categoryphoto;
        
        return view('admin.categoryphoto',[
            'category' => $category,
            'categoryphoto' => $categoryphoto,
        ]);
    }
    
    
    public function edit($id)
    {
        $category = Category::find($id);
        
        return view('admin.categoryedit',[
            'category' => $category,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        
        $category->name = $request->name;
        $category->save();

        return redirect('/');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back();
    }
    
}
