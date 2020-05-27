
@extends('layouts.app')
@section('content')
<div class="jumbotron" style="background-color:#ccebff;">
<form >
<div class="row">
<div class="col-md-5">
<input class="form-control my-0 py-1 lime-border" name="name" type="text" placeholder="Role Name" aria-label="Search">
</div>
<div class="col-md-5">
<input class="form-control my-0 py-1 lime-border" name="permission_id" type="text" placeholder="Permission Id" aria-label="Search">
</div>
<div class="col-md-2">
<div class="input-group-append">
  <button type='submit' class='btn' style="margin-left:5px; background-color:grey;"><i class="fa fa-thumbs-o-up"></i></button>
  </div>
  </div>
</div>
</form>

<div>
<h2>role List</h2>
<td><a href="/role/create"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
</div>

<div>
<table class="table table-dark">
<tr>
<th>Sl. No.</th>
<th>Name</th>
<th>Permission Allowed</th>
<th>Created_at</th>
<th>Updated_at</th>
<th> Action</th>

</tr>
@foreach($roles as $index => $role)
<tr>
<td>{{$index+$roles->firstItem()}}</td>
<td>{{$role->name}}</td>
<td>
@foreach($role->permissions as $t=>$permission)

{{++$t."-".$permission->name}}

@endforeach
</td>
<td>{{$role->created_at}}</td>
<td>
@if($role->updated_at)
{{$role->updated_at->diffForHumans()}}
@endif
</td>

@permission('read-roles')
<td><a href="/role/{{$role->id}}"><i class="fa fa-eye" style="color:#00ccff;" aria-hidden="true"></i>
</button></a></td>
@endpermission 
@permission('update-roles')
<td><a href="/role/{{$role->id}}/edit"><i class="fa fa-pencil" style="color:lime;margin-right:20px;" aria-hidden="true"></i>
</button></a></td>
@endpermission


@permission('delete-roles')
<td>
<form  action='/role/{{$role->id}}/delete' method='POST'>
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
{{$roles->appends($_GET)->links()}}
</div>
@endsection