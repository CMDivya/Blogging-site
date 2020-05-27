@extends('layouts.app')
@section('content')


<div class="jumbotron"style="background-color:#ccebff;">
<form action="{{route('role.update', $role)}}" method="POST"  enctype="multipart/form-data">
@csrf()
@method('PUT')

<div class="form-group">
      <h2><label for="Name">Update role</label></h2>

  </div>
    <div class="form-group">
      <label for="Name">Edit Title</label>
      <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}"placeholder=" Role ">

  </div>
  <div class="form-group">
    <label for="description">Edit role</label>
  </div>
  <div class="form-group">
    <textarea rows="5" cols="184" name="description"  id="description" placeholder="Edit role Description">{{$role->description}}</textarea>
  </div>
 
<div class="form-group">
    <label for="permission">Select permission</label>
  </div>
<div>

<select class="mdb-select md-form colorful-select dropdown-danger" name="permission_id[]" multiple>
@foreach($permissions as $permission)
  <option 
  @foreach($role->permissions as $role_permission)
  @if($permission->id==$role_permission->id)
    selected
  @endif 
  @endforeach
  value="{{$permission->id}} "> {{$permission->name}} </option>
@endforeach
</select>
</div>
<div>
  <button href="" type="Submit" class="btn btn-primary">Update</button>
  </div>

</form>
</div>
@endsection

