<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Blog;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ProcessResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories=Category::all();
        $name = ($request->name) ? $request->name : '';
            $description = ($request->description) ? $request->description : '';
            $categories = Category::search('name', $name)
                ->orderBy('created_at', 'desc')->with(['blogs.tags'])->withCount(['blogs'])
                ->search('description', $description)->paginate(10);

       return $this->processResponse($categories,'success');
        //return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        if(!$request->has('id')){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required'|'max:255'
          
        ]);
        $categories=new Category;
        $categories->user_id = 2;
        $categories->slug = $this->slugify($request->name, 'categories');
        }
        else{

            $categories = Category::find($request->id);
            if($request->has('slug'))
            $categories->slug = $this->slugify($request->name, 'categories');
        }
        
        $categories->name=$request->name;
        $categories->description=$request->description;
        $categories->created_at=$request->created_at;
        $categories->updated_at=$request->updated_at;
        $categories->save();
        if(!$request->has('id'))
        return $this->processResponse($categories,'success','category created successfully');
        else
        return $this->processResponse($categories,'success','category updated successfully');
    }
*/
    
public function store(Category $category)
    {
        if(!$request->has('id')) {
            $request->validate([
                'name' => 'required|unique:categories,name',
                'description' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required|unique:categories,name,'.$request->id,
                'description' => 'required',
            ]);
        }

        if($request->has('slug'))
        {
            $slug = $this->slugify($request->name, 'categories');
        };

        $category = Category::updateOrCreate(
            ['id' => $request->id],
            [
            'user_id' => 1,
            'slug' => ($request->has('slug')) ? $this->slugify($request->slug, 'categories') : Category::find($request->id)->slug,
            'name' => $request->name,
            'description' => $request->description
            ]
        );

        if(!$request->has('id'))
        return $this->processResponse($categories,'success','category created successfully');
        else
        return $this->processResponse($categories,'success','category updated successfully');
     
    

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
              $category=Category::find($id);
              if($category){
        if($category->blogs->count() > 0){
            return $this->processResponse(null,'error', 'This category has linked blogs, cannot be deleted');
        }
        else{
        $category->delete();
        return $this->processResponse(null,'success', 'This category has deleted');
        }

        }
        else  
        return $this->processResponse(null,'error', 'This category has linked blogs, cannot be deleted');  
    }
}
