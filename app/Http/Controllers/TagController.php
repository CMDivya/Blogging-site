<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TagController extends Controller
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

    


    public function index(Request $request)
   
    {    abort_if(!Auth::user()->hasPermission('read-tags'), 403);
        $name=$request->name?$request->name:'';
        $tags=Tag::where('name','like','%'.$name.'%')->paginate(config('setting.pages'));
        return view('tag.index')->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasPermission('create-tags'), 403);
    return view('tag/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        abort_if(!Auth::user()->hasPermission('create-tags'), 403);
        $request->validate([
            'name'=>'required|unique:tags,name|max:255'
        ]);
        $tag=new Tag;
        $tag->name=$request->name;
        $tag->save();
      
        return redirect('tag')->with('success', 'Blog created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth::user()->hasPermission('read-tags'), 403);
    $tag=Tag::find($id);
    return view('tag/show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth::user()->hasPermission('update-tags'), 403);
        $tag=tag::find($id);
        return view('tag.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        abort_if(!Auth::user()->hasPermission('update-tags'), 403);
        $tag=Tag::find($id);
        $tag->name=$request->name;
        $tag->save();
        return redirect('tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth::user()->hasPermission('delete-tags'), 403);
        $tag=Tag::find($id);
        $tag->delete();
        return redirect('tag');
    }
}
