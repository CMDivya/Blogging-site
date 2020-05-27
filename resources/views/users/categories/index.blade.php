@extends('layouts.app')

@section('content')
<div class="jumbotron" style="background-color:#ccebff;">
<form>
<div class="row">
<div class="col-md-6">
<input class="form-control my-0 py-1 lime-border" name="name" type="text" placeholder="Category name" aria-label="Search">
<h2>All Categories</h2>
<a href="/category/create"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
</div>

<div class="col-md-2">
<div class="input-group-append">
  <button type='submit' class='btn' style="margin-left:5px; background-color:grey;"><i class="fa fa-thumbs-o-up"></i></button>
  </div>
  

</div>
</form>


<table class="table table-stripped">
<tr>
<th>Sl_no</th>
<th>Ctegory_Id</th>
<th>Category Name</th>
<th>Created By</th>
<th>Created</th>
<th>Updated</th>
<th>Action</th>
</tr>
@foreach($categories as $index => $category)
<tr>
<td>{{$index+$categories->firstItem()}}</td>
<td>{{$category->id}}</td>
<td>{{$category->name}}</td>

<td>
@if($category->user_id)
{{$category->user->name}}
@else
None
@endif
</td>

<td>{{$category->created_at}}</td>
<td>{{$category->updated_at->diffForHumans()}}</td>

<td><a href="/category/{{$category->id}}"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
<td><a href="/category/{{$category->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
<td>
<form  action='/category/{{$category->id}}/delete' method='POST'>
@csrf()
@method('delete')
<button style="background-color:red;" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
</form>
</td>
</tr>
@endforeach
</table>
{{$categories->appends($_GET)->links()}}
</div>

@endsection