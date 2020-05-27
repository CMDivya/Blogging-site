<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<h2>Show Blog Details</h2>
<div class="jumbotron"  style="background-color:#ccebff; margin-top:50px;">
<table class="table table-dark" >
<tr>
<th>Blog Title</th>
<th>Description</th>
<th>Category Name</th>
<th>Tag Name </td>
</tr>
<tr>
<td>{{$blog->title}}</td>
<td>{{$blog->description}}</td>
<td>{{$blog->category->name}}</td>
@if($blog->tags->count()>0)
@foreach($blog->tags as  $tag)
<td>{{$tag->name}}</td>
@endforeach
@endif
</tr>
<tr>
<td><a class='btn btn-primary' href="/blog">Go Back To Blog List</a></td>
</tr>
</table>
</div>
<h2>Comments Section</h2>
<div class="jumbotron"  style="background-color:#ccebff; margin-top:20px;">
<form method="POST" action="{{route('blogs.cstore',$blog->id)}}">
@csrf
@method('put') 
    <div class="form-group">
      <label for="comment">Write Comment</label>
      <input type="text" class="form-control" name="comment" id="comment" placeholder=" Write a comment ">
</div>
<button type="submit" class="btn btn-primary">Save Comment</button>
</form>

<div>
<h2>Show All Comments on the Blog</h2>
<table class="table table-dark" >
<tr>
<th>Comment Id</th>
<th>Comment </th>
<th>Created By </th>
<th>Created At </th>
</tr>
@if($blog->comments->count()>0)
@foreach($blog->comments as  $comment)
<tr>
<td>{{$comment->id}}</td>
<td>{{$comment->comment}}</td>
<td> @if($comment->user_id)
{{$comment->user->name}}
 @endif
 </td>
 <td>{{$comment->created_at->diffForHumans()}}</td>
 </tr>
@endforeach
@endif
</table>
</div>

</div>
</body>
</html>
