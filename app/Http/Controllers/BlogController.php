<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use App\Comment;
use App\Category;
use App\Blog;
use App\Tag;
use Intervention\Image\Facades\Image as Photo;

class BlogController extends Controller
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
    {
        abort_if(!Auth::user()->hasPermission('read-blogs'), 403);

        $title=$request->title ? $request->title :'';
        $category_id=$request->category_id ? $request->category_id :'';
        $blogs = Blog::search('title', $title )->search('category_id', $category_id)->paginate(config('setting.pages'));
        return view('blog.index')->withBlogs($blogs)->withTitle($title)->withCategory_id($category_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        abort_if(!Auth::user()->hasPermission('create-blogs'), 403);
        $tags=Tag::all();
        $categories=Category::all();
        return view('blog/create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('create-blogs'), 403);
        $request->validate([
            'title'=>'required|unique:blogs,title',
            'description'=>'required|max:300',
            'category_id'=>'required',
            'tag_id'=>'required'
 
             ]);

        $blog=new Blog;
        $blog->description=$request->description;
        $blog->title=$request->title;
        $blog->category_id=$request->category_id;
        if($request->file('image'))
        {
            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }

        $blog->save();

        $blog->tags()->sync($request->tag_id);
        return redirect()->route('blog.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth::user()->hasPermission('read-blogs'), 403);
        $blog=Blog::find($id);
        
        return view('blog/show')->withBlog($blog);
       
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth::user()->hasPermission('update-blogs'), 403);
        $categories=Category::all();
        $tags=Tag::all();
        $blog=Blog::find($id);
        return view('blog.edit')->withCategories($categories)->withBlog($blog)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
     {
        abort_if(!Auth::user()->hasPermission('update-blogs'), 403);
        $blog= Blog::find($id);
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->category_id;
        if($request->file('image'))
        {
            if($blog->image !== null){
                $this->deleteImage($blog->image);
            }

            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }


        $blog->save();
        $blog->tags()->sync($request->tag_id);
        return redirect('blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth::user()->hasPermission('delete-blogs'), 403);
        $blog= Blog::find($id);
        $blog->delete();
        if($blog->image)
        {
            $this->deleteImage($blog->image);
        }
        return redirect('blog');
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
    

   public function commentstore(Request $request, $id)
   {
       $request->validate([
           'comment'=>'required|unique:comments,comment',
            ]);
       //$blog= Blog::find($id);
       $comments=new Comment;
       $comments->comment=$request->comment;
       $comments->blog_id=$id;
       $comments->user_id=Auth::user()->id;
       $comments->save();
       return redirect()->route('blog.show',$id);
   }
    
}
