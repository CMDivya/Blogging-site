@extends('layouts.app')
@section('content')
<div class="jumbotron" style="background-color:#ccebff;">
<form >
<div class="row">
<div class="col-md-5">
<input class="form-control my-0 py-1 lime-border" name="title" type="text" placeholder="Blog Title" aria-label="Search">
</div>
<div class="col-md-5">
<input class="form-control my-0 py-1 lime-border" name="category_id" type="text" placeholder="Category Id" aria-label="Search">
</div>
<div class="col-md-2">
<div class="input-group-append">
  <button type='submit' class='btn' style="margin-left:5px; background-color:grey;"><i class="fa fa-thumbs-o-up"></i></button>
  </div>
  </div>
</div>
</form>

<div>
<h2>Blog List</h2>
<td><a href="/blog/create"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
</div>

<div>
<table class="table table-dark">
<tr>
<th>Sl. No.</th>
<th>Title</th>
<th>Image</th>
<th> CategoryId</th>
<th> Action</th>

</tr>
@foreach($blogs as $index => $blog)
<tr>
<td>{{$index+$blogs->firstItem()}}</td>
<td>{{$blog->title}}</td>
<td>
  @if($blog->image)
   <img class="img-thumbnail" src="{{asset($blog->image)}}" width="100px" height="auto" >
     @else
     No Image
     @endif
    </td>
<!--<td>{{$blog->category->name}}</td>-->
<td>{{$blog->category_id}}</td>
@permission('read-blogs')
<td><a href="/blog/{{$blog->id}}"><i class="fa fa-eye" style="color:#00ccff;" aria-hidden="true"></i>
</a></td>
@endpermission 
@permission('update-blogs')
<td><a href="/blog/{{$blog->id}}/edit"><i class="fa fa-pencil" style="color:lime;margin-right:20px;" aria-hidden="true"></i></a></td>
@endpermission
@permission('delete-blogs')
<td>
<form  action='/blog/{{$blog->id}}/delete' method='POST'>
@csrf()
@method('delete')
<button><i class="fa fa-trash" style="color:#ff3300;" aria-hidden="true"></i></button>
</form>
</td>
@endpermission

</tr>
@endforeach
</table>
</div>
{{$blogs->appends($_GET)->links()}}

</div>
@endsection