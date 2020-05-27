<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userindex(Request $request)
    {
        $name=$request->name ? $request->name:'';
        $categories =Category::where('name', 'like','%'.$name.'%' )->paginate(config('setting.pages'));
        return view('users.categories.index')->withCategories($categories);
    }

    public function index(Request $request)
    { 
        abort_if(!Auth::user()->hasPermission('read-categories'), 403);
        $name = ($request->name) ? $request->name : '';
        $description = ($request->description) ? $request->description : '';
        $categories = Category::search('name', $name)->search('description', $description)->paginate(10);
        return view('category/index')->withcategories($categories)->withName($name)->withDescription($description);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);
        return view('category/create');
        //dd($request);
       // dd($request->name);
        //dd($request->description);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required'|'max:255'
            
        ]);
            
        $categories=new Category;
        $categories->name=$request->name;
        $categories->slug = $this->slugify($request->name, 'categories');
        $categories->description=$request->description;
        $category->user_id = Auth::user()->id;
        $categories->created_at=$request->created_at;
        $categories->updated_at=$request->updated_at;
        $categories->save();
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        abort_if(!Auth::user()->hasPermission('read-categories'), 403);
        $category = Category::where('slug', $slug)->first();
        return view('category.show')->withCategory($category);
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    { 
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);
        $category = Category::where('slug', $slug)->first();
        //$category= Category::find($slug);
        return view('category/edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
       
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);
        $categories = Category::where('slug', $slug)->first();
        $categories->name=$request->name;
        $categories->slug = $this->slugify($request->name, 'categories');
        $categories->description=$request->description;
        $categories->created_at=$request->created_at;
        $categories->updated_at=$request->updated_at;
       
        $categories->save();
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        abort_if(!Auth::user()->hasPermission('delete-categories'), 403);
        $category= Category::find($slug);

        if($category->blogs->count()<=0)
        $category->delete();
        
        return redirect('category');
    }
}
