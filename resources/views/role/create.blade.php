<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<form action="{{route('role.store')}}" method="POST" enctype="multipart/form-data">
@csrf()
<div class="jumbotron"style="background-color:#ccebff;">
<div class="form-group">
      <h2><label for="Name">Create Roles</label></h2>
  </div>
 

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role Name">
  </div>
  @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
      <label for="display_ame">Display Name</label>
      <input type="text" class="form-control" name="display_name" id="name" placeholder="Enter Role Display Name">
  </div>
  @error('display_name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

  <div class="form-group">
    <label for="description">Description</label>
  </div>
  <div class="form-group">
    <textarea rows="5" cols="184" name="description" id="description" placeholder="Enter blog Description"></textarea>
  </div>
  @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror


<div class="form-group">
    <label for="tag">Select Permissions</label>
  </div>
<div>
<select class="mdb-select md-form colorful-select dropdown-danger" name="permission_id[]" multiple>
  <option value="" disabled selected>Choose permissions</option>
  @foreach($permissions as $permission)
<option value="{{$permission->id}} "> {{$permission->name}} </option>
@endforeach
</select>
</div>
@error('permission_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div>
<button type="Submit" class="btn btn-primary">Save Role</button>
</div>
</form>
</body>
</html>