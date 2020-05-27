@extends('layouts.app')
@section('content')


<div class="jumbotron"style="background-color:#ccebff;">
<form action="{{route('blog.update', $blog)}}" method="POST"  enctype="multipart/form-data">
@csrf()
@method('PUT')

<div class="form-group">
      <h2><label for="Name">Update Blog</label></h2>

  </div>
    <div class="form-group">
      <label for="Name">Edit Title</label>
      <input type="text" class="form-control" name="title" id="name" value="{{$blog->title}}"placeholder=" Blog Title ">

  </div>
  <div class="form-group">
    <label for="description">Edit Blog</label>
  </div>
  <div class="form-group">
    <textarea rows="5" cols="184" name="description"  id="description" placeholder="Edit Blog Description">{{$blog->description}}</textarea>
  </div>
 
  <div class="form-group">
      <label for="image">Image</label>
      <input name="image" type="file" class="form-control" id="image" value="{{$blog->image}}">
     <img class="img-thumbnail" src="{{asset($blog->image)}}" width="250px" height="250px" >
       </div>

  <div class="form-group">
    <label for="category">Update Category</label>
  </div>
  <div>
  <select class="browser-default custom-select" name="category_id">
  
  @foreach($categories as $category)
  <option
    @if($category->id==$blog->category_id)
    selected
    @endif value="{{$category->id}}">{{$category->name}}</option>
  @endforeach
</select>
</div>
<div class="form-group">
    <label for="tag">Select Tag</label>
  </div>
<div>
<select class="mdb-select md-form colorful-select dropdown-danger" name="tag_id[]" multiple>
@foreach($tags as $tag)
  <option 
  @foreach($blog->tags as $blog_tag)
  @if($tag->id==$blog_tag->id)
    selected
  @endif 
  @endforeach
  value="{{$tag->id}} "> {{$tag->name}} </option>
@endforeach
</select>
</div>
<div>
  <button href="" type="Submit" class="btn btn-primary">Update</button>
  </div>

</form>
</div>
@endsection

