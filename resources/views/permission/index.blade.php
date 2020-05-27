@extends('layouts.app')
@section('content')
<div class="jumbotron" style="background-color:#ccebff;">
<form>
<div class="row">
<div class="col-md-5">
<input class="form-control my-0 py-1 lime-border" name="name" type="text" placeholder="Permission Name" aria-label="Search">
</div>
<div class="col-md-2">
<div class="input-group-append">
  <button type='submit' class='btn' style="margin-left:5px; background-color:grey;"><i class="fa fa-thumbs-o-up"></i></button>
  </div>
  </div>
</div>


<div>
<h2>View Permissions</h2>
</div>

<div>
<table class="table table-dark">
<tr>
<th>Sl No.</th>
<th>Name</th>
<th>Display Name</th>
<th>Description</th>
<th>Created At</th>
</tr>
@foreach($permissions as $index => $permission)
<tr>
<td>{{$index+$permissions->firstItem()}}</td>
<td>{{$permission->name}}</td>
<td>{{$permission->display_name}}</td>
<td>{{$permission->description}}</td>
<td>{{$permission->created_at}}</td>
<tr>
@endforeach
</table>
</div>
{{$permissions->appends($_GET)->links()}}
<form>
</div>
@endsection
