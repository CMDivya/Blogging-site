<?php

namespace App\Http\Controllers\API;
use Config;
use App\Blog;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Validator;
use Intervention\Image\Facades\Image as Photo;
class BlogController extends Controller
{
    use ProcessResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs=Blog::all();
        $name=($request->name)?($request->name):'';
        $description=($request->description)?($request->description):'';
        $blogs=Blog::search('name', $name)
        ->orderBy('created_at', 'desc')->with(['tags'])->withCount(['tags'])
        ->search('description', $description)->paginate(config('settings.pages'));

        return $this->blogProcessResponse($blogs,'success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         if(!$request->has('id')) {
           $request->validate([
             'title' => 'required',
              'description' => 'required',
           ]);
         } 
/*
        if($request->has('slug'))
        {
            $slug = $this->slugify($request->title, 'blogs');
        };
*/
        $blog = Blog::updateOrCreate(
            ['id' => $request->id],
            [
            
            //'slug' => ($request->has('slug')) ? $this->slugify($request->slug, 'categories') : Blog::find($request->id)->slug,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
           
           
            ]
        );
            
 
        if($request->has('id'))
        {
        if($request->file('image'))
            {
                $filename = $this->upoadImage($request->file('image'));
    
                $blog->image = $filename;
            }
        }
        else
        {

            if($request->file('image'))
        {
            if($blog->image !== null){
                $this->deleteImage($blog->image);
            }

            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }

         }
         $blog->tags()->sync($request->tag_id);

        if(!$request->has('id'))
        {
           
             
        return $this->processResponse($blog,'success','Blog created successfully');}
        else
        {  
           
          
        return $this->processResponse($blog,'success','Blog updated successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /* public function store(Request $request)
{
    $input = $request->all();


    $validator = Validator::make($input, [
        'title'=>'required|unique:blogs,title',
           'description'=>'required',
            'category_id'=>'required',
    ]);


    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }


    $blog = Blog::create($input);


    return $this->blogProcessResponse($blog,'success','Blogs created successfully');  
    // $request = Validator::make($request,[
    //         'title'=>'required|unique:blogs,title',
           
    //         'description'=>'required',
            
    //         'category_id'=>'required',
           
    //        // 'tag_id'=>'required'
        
    //          ]);
    //          dd($validator);
    //          if($request->fails()){
    //             return $this->blogProcessResponse($request,'error','Validation error');    
    //         }
    
    //     $blog=new Blog;
    //     $blog->title=$request->title;
    //     $blog->description=$request->description;
    //     $blog->category_id=$request->category_id;
    //     if($request->file('image'))
    //     {
    //         $filename = $this->upoadImage($request->file('image'));

    //         $blog->image = $filename;
    //     }
    //     $blog->save();

    //     //$blog->tags()->sync($request->tag_id);
    //     return $this->blogProcessResponse($blogs,'success','Blog created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request)
    {

        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $blog->title=$input['title'];
        $blog->description=$input['description'];
        $blog->category_id=$input['category_id'];
        if($request->file('image'))
        {
            if($blog->image !== null){
                $this->deleteImage($blog->image);
            }

            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }


        $blog->save();
       // $blog->tags()->sync($request->tag_id);
        return blogProcessResponse($blog,'success','Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $blog=Blog::find($id);
        
        if($blog)
        {
        $blog->delete();
        if($blog->image)
        {
            $this->deleteImage($blog->image);
        }
        return $this->blogProcessResponse(null,'success','Blog Deleted Successfully');
    }
    else  
    return $this->blogProcessResponse(null,'error', 'Blog Does Not Exist');  
    }

    public function upoadImage($image){

        //generating random string from current time
        $random_name = time();

        //getting image extension
        $extension = $image->getClientOriginalExtension();

        //generating new image name
        $filename = time() . '.' . $extension;

        //Saving image here
        Photo::make($image)->save(public_path('/' . $filename));

        return $filename;
    }

    public function deleteImage($image)
    {
        abort_if(!Auth::user()->hasPermission('delete-blogs'), 403);
        $filename = public_path() . '/' . $image;

        unlink($filename);

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    
}
