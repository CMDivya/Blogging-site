@extends('layouts.app')
@section('content')


<div class="jumbotron" style="background-color:#ccebff;">
<form>
<div class="row">
<div class="col-md-6">
<input class="form-control my-0 py-1 lime-border" name="name" type="text" placeholder="Tag name" aria-label="Search">
<h2>Tag List</h2>
</div>

<div class="col-md-2">
<div class="input-group-append">
  <button type='submit' class='btn' style="margin-left:5px; background-color:grey;"><i class="fa fa-thumbs-o-up"></i></button>
  </div>
</div>

</form >

<table class="table table-dark">
<tr>
<th>Tag Name</th>
<th>Blog Title</th>
<th>Action</th>
</tr>
@foreach($tags as $tag)
<tr>
<td>{{$tag->name}}</td>
<td>
@foreach($tag->blogs as $blog)
- {{$blog->title}}<br>
@endforeach
</td>
<td><a href="/tag/create" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
@permission('read-tags')
<td><a href="/tag/{{$tag->id}}" style="background-color:green;" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></a></td>
@endpermission
@permission('update-tags')
<td><a href="/tag/{{$tag->id}}/edit" style="background-color:#ffa31a;" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></a></td>
@endpermission
<td>
<form  action='/tag/{{$tag->id}}/delete' method='POST'>
@csrf()
@method('delete')
<button style="background-color:red;" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
@endsection